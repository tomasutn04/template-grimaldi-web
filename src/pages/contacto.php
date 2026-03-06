<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Directorio de Contactos | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Encuentre rápidamente al empleado de contacto en el departamento correspondiente de Grimaldi Agencies Argentina.">
    <meta name="keywords"
        content="Grimaldi contacto, directorio empleados, comercial, importación, exportación, finanzas">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Contactos | Grimaldi Agencies Argentina">
    <meta property="og:description" content="Directorio de contactos de Grimaldi Agencies Argentina.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/contacto">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/contacto">

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/contacto.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="contact-hero">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="contact.title">Directorio de Contactos</h1>
                <p class="cuerpo-principal" data-i18n="contact.description">
                    Encuentre rápidamente a la persona de contacto en el departamento correspondiente.
                </p>

                <!-- Quick Contact Info -->
                <div class="contact-hero__info">
                    <div class="contact-hero__item">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span>25 de Mayo 702, 1er Piso, CABA</span>
                    </div>
                    <div class="contact-hero__item">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <a href="tel:+541143126886">+54 11 4312-6886</a>
                    </div>
                    <div class="contact-hero__item">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <span>Lunes a Viernes: 9:00 - 17:00</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- FILTER & SEARCH BAR -->
        <section class="contact-toolbar">
            <div class="contenedor-principal">
                <div class="toolbar-inner">
                    <div class="toolbar-search" id="search-container" style="display: none;">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="var(--grimaldi-text-muted)">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <input type="text" id="search-input" placeholder="Buscar por nombre o correo..." aria-label="Buscar contactos">
                    </div>
                    <div class="toolbar-filter" id="filtro-container" style="display: none;">
                        <label for="sector-select" data-i18n="contact.filter_label">Departamento:</label>
                        <select id="sector-select">
                            <option value="todos" data-i18n="contact.filter_all">Todos los departamentos</option>
                            <!-- Dynamic options injected here -->
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper contact-directory" aria-labelledby="contactos-titulo">
            <div class="contenedor-principal">

                <div id="gme-contactos-contenido" aria-live="polite">
                    <div class="contact-loading">
                        <div class="contact-loading__spinner"></div>
                        <span data-i18n="contact.loading">Cargando directorio de contactos...</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- CTA Section -->
        <section class="contact-cta">
            <div class="contenedor-principal">
                <div class="cta-card">
                    <div class="cta-content">
                        <h2>No encuentra lo que busca?</h2>
                        <p>Envíenos un mensaje general y lo redireccionaremos al departamento correspondiente.</p>
                    </div>
                    <a href="mailto:info@grimaldi-bue.com.ar" class="boton-primario">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        Contacto General
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript Base -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>

    <!-- Page Specific JS: Fetching and Rendering Contacts -->
    <script>
        const ASSETS_URL = "<?php echo ASSETS_URL; ?>";
    </script>
    <script src="<?php echo JS_URL; ?>/contacto.js" defer></script>

    <!-- Search functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const searchContainer = document.getElementById('search-container');
            
            // Show search when contacts load
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.addedNodes.length) {
                        searchContainer.style.display = 'flex';
                    }
                });
            });
            
            const container = document.getElementById('gme-contactos-contenido');
            observer.observe(container, { childList: true });

            // Search functionality
            searchInput?.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.contact-card');
                
                cards.forEach(card => {
                    const name = card.querySelector('.nombre')?.textContent.toLowerCase() || '';
                    const email = card.querySelector('.email')?.textContent.toLowerCase() || '';
                    const position = card.querySelector('.posicion')?.textContent.toLowerCase() || '';
                    
                    if (name.includes(term) || email.includes(term) || position.includes(term)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Hide empty sections
                document.querySelectorAll('.sector-bloque').forEach(section => {
                    const visibleCards = section.querySelectorAll('.contact-card:not([style*="display: none"])');
                    section.style.display = visibleCards.length ? 'block' : 'none';
                });
            });
        });
    </script>
</body>

</html>
