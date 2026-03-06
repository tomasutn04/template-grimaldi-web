document.addEventListener('DOMContentLoaded', () => {
    const loading = document.getElementById('tc-loading');
    const content = document.getElementById('tc-content');
    const alertCont = document.getElementById('tc-alert-container');

    // For testing purposes: Set to true to bypass time limitations locally
    const isTestMode = false;

    // Time gating check
    function isWithinBusinessHours() {
        if (isTestMode) return true;

        const now = new Date();
        const day = now.getDay(); // 0 is Sunday, 6 is Saturday
        const hour = now.getHours();

        // Weekday between 9:00 and 16:59
        return (day >= 1 && day <= 5 && hour >= 9 && hour < 17);
    }

    // Date validation check
    function isDateValid(dateStr) {
        if (isTestMode) return true;

        const today = new Date().toISOString().split('T')[0];
        return dateStr === today; // format: YYYY-MM-DD
    }

    // Fetch real exchange rate data from Caja API
    fetch('/api/tipo_cambio.php')
        .then(res => res.json())
        .then(result => {
            loading.style.display = 'none';

            // Extract data from API response wrapper
            const data = (result.status === 'ok') ? result.data : {};

            // Derive fecha_cotizacion from ultima_actualizacion
            if (data.ultima_actualizacion && !data.fecha_cotizacion) {
                data.fecha_cotizacion = data.ultima_actualizacion.split(' ')[0];
            }

            if (!isWithinBusinessHours()) {
                alertCont.innerHTML = `
                    <div class="gated-overlay">
                        <div class="alerta-error text-center" style="font-size: 1.2rem; padding: 2.5rem; border:none; box-shadow: var(--grimaldi-shadow-lg);">
                            <i class="fas fa-clock fa-2x" style="display:block; margin-bottom: 1rem; color: var(--grimaldi-error);"></i>
                            <span data-i18n="exchange.out_of_hours" style="color: var(--grimaldi-text);">Fuera de horario de atención (09:00 a 17:00hs)</span>
                        </div>
                    </div>
                `;
                if (window.i18nManager) window.i18nManager.updateDOM();
                return; // Stop execution
            }

            if (!isDateValid(data.fecha_cotizacion)) {
                alertCont.innerHTML = `
                    <div class="alerta-estado text-center">
                        <span data-i18n="exchange.no_data_today">No hay cotización para el día de la fecha. Por favor, póngase en contacto con Caja.</span>
                    </div>
                `;
                if (window.i18nManager) window.i18nManager.updateDOM();
                return;
            }

            // Render Data
            document.getElementById('val-usd').innerText = '$' + parseFloat(data.dolar_valor).toFixed(2);
            document.getElementById('val-eur').innerText = '€' + parseFloat(data.euro_valor).toFixed(2);
            document.getElementById('bank-data').innerHTML = data.datos_bancarios;
            document.getElementById('last-update').innerText = data.ultima_actualizacion;

            const dateDisplay = new Date().toLocaleDateString();
            document.querySelectorAll('.tc-date-display').forEach(el => el.innerText = dateDisplay);

            content.style.display = 'block';

            // PDF Generation Setup
            setupPdfExport(data);
        })
        .catch(err => {
            console.error('Error fetching exchange rate:', err);
            loading.innerHTML = '<span class="texto-error">Error al conectar con la base de datos.</span>';
        });

    function setupPdfExport(data) {
        document.getElementById('btn-descargar-pdf').addEventListener('click', async function () {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando PDF...';
            this.disabled = true;

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // PDF Grimaldi Style
            const blue = [0, 51, 153];
            const yellow = [255, 204, 0];

            doc.setFont("helvetica", "bold");
            doc.setFontSize(22);
            doc.setTextColor(blue[0], blue[1], blue[2]);
            doc.text("GRIMALDI AGENCIES ARGENTINA S.A.", 105, 30, null, null, "center");

            doc.setDrawColor(yellow[0], yellow[1], yellow[2]);
            doc.setLineWidth(1);
            doc.line(20, 35, 190, 35);

            doc.setFontSize(14);
            doc.setTextColor(50, 50, 50);
            doc.text("COTIZACIÓN OFICIAL", 105, 50, null, null, "center");

            doc.setFont("helvetica", "normal");
            doc.setFontSize(12);
            doc.text(`Fecha de Emisión: ${new Date().toLocaleDateString()}`, 20, 70);
            doc.text(`Última Actualización: ${data.ultima_actualizacion}`, 20, 80);

            // Values Box
            doc.setDrawColor(blue[0], blue[1], blue[2]);
            doc.setFillColor(245, 245, 245);
            doc.roundedRect(20, 95, 170, 40, 3, 3, 'FD');

            doc.setFont("helvetica", "bold");
            doc.setFontSize(16);
            doc.text(`Dólar (USD): $ ${parseFloat(data.dolar_valor).toFixed(2)}`, 40, 110);
            doc.text(`Euro (EUR): € ${parseFloat(data.euro_valor).toFixed(2)}`, 40, 125);

            // Disclaimer
            doc.setFont("helvetica", "italic");
            doc.setFontSize(9);
            doc.setTextColor(100, 100, 100);
            doc.text("Documento generado automáticamente a través de la interfaz oficial grimaldi-bue.com.ar", 105, 280, null, null, "center");

            // Save PDF
            doc.save(`Grimaldi_Cotizacion_${data.fecha_cotizacion}.pdf`);

            // Reset button
            this.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" style="vertical-align: sub; margin-right: 0.5rem;"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg> Descargar PDF';
            this.disabled = false;
        });
    }
});
