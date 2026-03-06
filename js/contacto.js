document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('gme-contactos-contenido');
    const select = document.getElementById('sector-select');
    const filtroContainer = document.getElementById('filtro-container');

    // SVGs for Icons
    const iconUser = `<svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>`;
    const iconEmail = `<svg viewBox="0 0 24 24" width="16" height="16" fill="var(--grimaldi-blue)"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>`;
    const iconPhone = `<svg viewBox="0 0 24 24" width="16" height="16" fill="var(--grimaldi-blue)"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>`;

    fetch('/api/contactos.php')
        .then(res => {
            if (!res.ok) throw new Error('Error of network');
            return res.json();
        })
        .then(result => {
            if (result.status !== 'ok') throw new Error(result.error || 'API error');
            const depts = result.data.departamentos;
            const contacts = result.data.contactos;

            if (!depts || !contacts) throw new Error('Invalid JSON format');

            // 1. Populate Select Dropdown
            depts.forEach(dep => {
                const option = document.createElement('option');
                option.value = dep.id;
                option.textContent = dep.nombre;
                select.appendChild(option);
            });
            filtroContainer.style.display = 'inline-flex';

            // 2. Generate HTML by Department
            let html = '';
            depts.forEach(dep => {
                // Filter and sort contacts for this dep
                const depContacts = contacts
                    .filter(c => c.departamento === dep.id)
                    .sort((a, b) => a.jerarquia - b.jerarquia);

                if (depContacts.length === 0) return; // Skip empty depts

                html += `<div class="sector-bloque ${dep.id}" data-sector="${dep.id}">
                                    <div class="area-titulo">${dep.nombre}</div>
                                    <div class="contacto-grid">`;

                depContacts.forEach(c => {
                    let cardClass = 'contact-card';
                    if (dep.id === 'gerencia-general') cardClass += ' gerente';
                    if (dep.id === 'recepcion') cardClass += ' recepcion';

                    const fullName = `${c.apellido.toUpperCase()} ${c.nombre}`;

                    html += `
                                <div class="${cardClass}">
                                    <div class="linea-azul2"></div>
                                    <div class="icon">${iconUser}</div>
                                    <div>
                                        <div class="nombre">${fullName}</div>
                                        <div class="posicion">${c.posicion}</div>
                                        <div class="email">
                                            ${iconEmail} <a href="mailto:${c.email}">${c.email}</a>
                                        </div>
                                        <div class="telefono">
                                            ${iconPhone} <a href="tel:${c.telefono}">${c.telefono}</a>
                                        </div>
                                        <div>
                                            <img src="${ASSETS_URL}/img/grimaldi_bandera_azul.png" alt="Logo GAA" class="logo">
                                        </div>
                                    </div>
                                    <div class="linea-azul"></div>
                                </div>
                            `;
                });

                html += `    </div>
                                 </div>`;
            });

            container.innerHTML = html;
        })
        .catch(err => {
            console.error('Fetch error:', err);
            container.innerHTML = `<div class="alerta-error" data-i18n="contact.error_loading">Error al cargar los contactos. Intente recargar la página.</div>`;
            if (window.i18nManager) window.i18nManager.updateDOM();
        });

    // Filtering Logic
    select.addEventListener('change', (e) => {
        const term = e.target.value;
        const sectores = document.querySelectorAll('.sector-bloque');

        sectores.forEach(sector => {
            if (term === 'todos' || sector.getAttribute('data-sector') === term) {
                sector.style.display = 'block';
            } else {
                sector.style.display = 'none';
            }
        });
    });
});
