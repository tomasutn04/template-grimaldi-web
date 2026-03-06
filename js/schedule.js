document.addEventListener('DOMContentLoaded', () => {
    const loading = document.getElementById('schedule-loading');
    const tableContainer = document.getElementById('table-container');
    const controlsUI = document.getElementById('schedule-ui');
    const routeSelect = document.getElementById('route-select');

    const thead = document.getElementById('schedule-head');
    const tbody = document.getElementById('schedule-body');

    let scheduleData = null;

    fetch('../data/schedule.mock.json')
        .then(res => res.json())
        .then(data => {
            scheduleData = data;
            document.getElementById('last-update').innerText = data.ultima_actualizacion;

            // Populate Select
            data.rutas.forEach((ruta, idx) => {
                const opt = document.createElement('option');
                opt.value = idx;
                opt.textContent = ruta.nombre;
                routeSelect.appendChild(opt);
            });

            // Hide Loading, Show UI
            loading.style.display = 'none';
            controlsUI.style.display = 'flex';
            tableContainer.style.display = 'block';

            // Initial Render
            renderTable(0);

            // Re-render on route change
            routeSelect.addEventListener('change', (e) => {
                renderTable(e.target.value);
            });
        })
        .catch(err => {
            console.error('Error fetching schedules:', err);
            loading.innerHTML = '<span class="texto-error">Error al cargar la tabla. Intente nuevamente.</span>';
        });

    function renderTable(routeIdx) {
        const ruta = scheduleData.rutas[routeIdx];
        if (!ruta || ruta.viajes.length === 0) return;

        // Dynamically build TH based on keys of the first voyage
        const keys = Object.keys(ruta.viajes[0]);

        let headHtml = '<tr>';
        keys.forEach(key => {
            // Prettify column labels
            let label = key.toUpperCase().replace('_', ' ');
            if (label.includes('ZARATE')) {
                headHtml += `<th style="color: var(--grimaldi-blue);">${label}</th>`;
            } else {
                headHtml += `<th>${label}</th>`;
            }
        });
        headHtml += '</tr>';
        thead.innerHTML = headHtml;

        // Build Body
        let bodyHtml = '';
        ruta.viajes.forEach(v => {
            bodyHtml += '<tr>';
            keys.forEach(k => {
                const val = v[k];
                if (k === 'buque' || k === 'viaje') {
                    bodyHtml += `<td class="highlight">${val}</td>`;
                } else {
                    bodyHtml += `<td>${val}</td>`;
                }
            });
            bodyHtml += '</tr>';
        });
        tbody.innerHTML = bodyHtml;
    }

    // Export to CSV/Excel functionality
    document.getElementById('btn-export-excel').addEventListener('click', () => {
        const routeName = routeSelect.options[routeSelect.selectedIndex].text;
        let csvContent = "";

        // Get Headers
        const ths = thead.querySelectorAll('th');
        const headerRow = Array.from(ths).map(th => `"${th.innerText}"`).join(',');
        csvContent += headerRow + "\r\n";

        // Get Data
        const trs = tbody.querySelectorAll('tr');
        trs.forEach(tr => {
            const tds = tr.querySelectorAll('td');
            const rowData = Array.from(tds).map(td => `"${td.innerText}"`).join(',');
            csvContent += rowData + "\r\n";
        });

        // Create Blob and trigger download
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.setAttribute('download', `Grimaldi_Schedule_${routeName.replace(/ /g, '_')}.csv`);
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
});
