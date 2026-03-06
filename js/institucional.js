document.addEventListener('DOMContentLoaded', () => {
    const vacContainer = document.getElementById('vacantes-container');
    const noVacContainer = document.getElementById('no-vacantes');
    const modal = document.getElementById('vacancy-modal');
    const closeBtn = document.querySelector('.close-modal');

    // Fetch active vacancies from live API
    fetch('/api/vacantes.php')
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(result => {
            const vacantes = (result.status === 'ok') ? result.data : [];
            if (vacantes && vacantes.length > 0) {
                let html = '';
                vacantes.forEach(v => {
                    html += `
                                <div class="vacation-card">
                                    <div class="vacature-info">
                                        <h3 class="titulo-contenido" style="margin: 0 0 0.5rem 0; font-size: 1.25rem;">${v.titulo}</h3>
                                        <span><i class="fas fa-map-marker-alt"></i> ${v.ubicacion}</span>
                                        <span><i class="fas fa-briefcase"></i> ${v.departamento}</span>
                                    </div>
                                    <button class="boton-secundario btn-ver-mas" 
                                            data-title="${v.titulo}" 
                                            data-loc="${v.ubicacion}" 
                                            data-dep="${v.departamento}" 
                                            data-desc="${btoa(unescape(encodeURIComponent(v.descripcion)))}"
                                            data-i18n="institutional.btn_more">
                                        Ver más
                                    </button>
                                </div>
                            `;
                });
                vacContainer.innerHTML = html;

                // Let i18n process the new attributes
                if (window.i18nManager) {
                    window.i18nManager.updateDOM();
                }

                // Add modal listeners
                document.querySelectorAll('.btn-ver-mas').forEach(btn => {
                    btn.addEventListener('click', function () {
                        document.getElementById('modal-title').innerText = this.getAttribute('data-title');
                        document.getElementById('modal-location').innerText = this.getAttribute('data-loc');
                        document.getElementById('modal-department').innerText = this.getAttribute('data-dep');

                        // Decode base64 description safely
                        const rawDesc = decodeURIComponent(escape(atob(this.getAttribute('data-desc'))));
                        document.getElementById('modal-description').innerHTML = rawDesc;

                        // Pre-fill email subject
                        const subject = encodeURIComponent('Postulación: ' + this.getAttribute('data-title'));
                        document.getElementById('modal-apply-btn').href = `mailto:cv@grimaldi-bue.com.ar?subject=${subject}`;

                        modal.classList.add('active');
                    });
                });
            } else {
                vacContainer.style.display = 'none';
                noVacContainer.style.display = 'block';
            }
        })
        .catch(err => {
            console.error('Error fetching vacancies:', err);
            vacContainer.style.display = 'none';
            noVacContainer.style.display = 'block';
        });

    // Close modal logic
    closeBtn.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
