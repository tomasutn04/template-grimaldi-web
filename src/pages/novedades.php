<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Revista y Novedades | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Archivo de la revista trimestral y últimas novedades operativas de Grimaldi Agencies Argentina.">
    <meta name="keywords" content="Grimaldi, revista, newsletter, novedades, noticias">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Revista y Novedades | Grimaldi Agencies Argentina">
    <meta property="og:description" content="Archivo de la revista trimestral y últimas novedades.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/novedades">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/novedades">

    <!-- Page-specific styles -->
    <style>
        /* News Page Styles */
        .news-hero {
            background: linear-gradient(135deg, var(--grimaldi-blue-darker) 0%, var(--grimaldi-blue-dark) 100%);
            padding: var(--space-3xl) 0;
            text-align: center;
            color: var(--grimaldi-white);
        }

        .news-hero .titulo-principal {
            color: var(--grimaldi-white);
            border-bottom: none;
        }

        .news-hero .cuerpo-principal {
            color: rgba(255, 255, 255, 0.85);
        }

        /* News Grid Layout */
        .news-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: var(--space-2xl);
        }

        .news-main {
            display: flex;
            flex-direction: column;
            gap: var(--space-xl);
        }

        .news-sidebar {
            display: flex;
            flex-direction: column;
            gap: var(--space-xl);
        }

        /* Featured Article */
        .news-featured {
            background: var(--grimaldi-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--grimaldi-shadow);
            overflow: hidden;
        }

        .news-featured__image {
            width: 100%;
            height: 320px;
            object-fit: cover;
        }

        .news-featured__content {
            padding: var(--space-xl);
        }

        .news-featured__meta {
            display: flex;
            align-items: center;
            gap: var(--space-md);
            margin-bottom: var(--space-md);
        }

        .news-tag {
            background: var(--grimaldi-yellow);
            color: var(--grimaldi-blue-darker);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .news-tag--magazine {
            background: var(--grimaldi-blue);
            color: var(--grimaldi-white);
        }

        .news-date {
            font-size: 0.85rem;
            color: var(--grimaldi-text-muted);
        }

        .news-featured__title {
            font-size: 1.75rem;
            color: var(--grimaldi-blue);
            margin-bottom: var(--space-md);
            line-height: 1.3;
        }

        .news-featured__excerpt {
            color: var(--grimaldi-text-light);
            line-height: 1.7;
            margin-bottom: var(--space-lg);
        }

        .news-featured__actions {
            display: flex;
            gap: var(--space-md);
        }

        /* Article Cards */
        .news-card {
            display: flex;
            gap: var(--space-lg);
            background: var(--grimaldi-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--grimaldi-shadow-sm);
            overflow: hidden;
            transition: all var(--transition-normal);
        }

        .news-card:hover {
            box-shadow: var(--grimaldi-shadow);
            transform: translateY(-2px);
        }

        .news-card__image {
            width: 200px;
            min-height: 160px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .news-card__content {
            padding: var(--space-lg);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .news-card__meta {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            margin-bottom: var(--space-sm);
        }

        .news-card__title {
            font-size: 1.1rem;
            color: var(--grimaldi-blue);
            margin-bottom: var(--space-sm);
            line-height: 1.4;
        }

        .news-card__excerpt {
            font-size: 0.9rem;
            color: var(--grimaldi-text-light);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Sidebar Widgets */
        .sidebar-widget {
            background: var(--grimaldi-white);
            border-radius: var(--radius-lg);
            box-shadow: var(--grimaldi-shadow-sm);
            padding: var(--space-lg);
        }

        .sidebar-widget__title {
            font-size: 1rem;
            color: var(--grimaldi-blue);
            margin-bottom: var(--space-lg);
            padding-bottom: var(--space-sm);
            border-bottom: 2px solid var(--grimaldi-blue-light);
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }

        .sidebar-widget__title svg {
            width: 20px;
            height: 20px;
            fill: var(--grimaldi-blue);
        }

        /* Quick Links Widget */
        .quick-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-links li {
            margin-bottom: var(--space-sm);
        }

        .quick-links a {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
            background: var(--grimaldi-gray-light);
            border-radius: var(--radius-sm);
            color: var(--grimaldi-text);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all var(--transition-fast);
        }

        .quick-links a:hover {
            background: var(--grimaldi-blue-subtle);
            color: var(--grimaldi-blue);
            transform: translateX(4px);
        }

        .quick-links svg {
            width: 16px;
            height: 16px;
            fill: var(--grimaldi-blue);
            flex-shrink: 0;
        }

        /* Magazine Archive */
        .magazine-item {
            display: flex;
            gap: var(--space-md);
            padding: var(--space-md) 0;
            border-bottom: 1px solid var(--grimaldi-gray);
        }

        .magazine-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .magazine-item__cover {
            width: 60px;
            height: 80px;
            background: linear-gradient(135deg, var(--grimaldi-blue) 0%, var(--grimaldi-blue-dark) 100%);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .magazine-item__cover svg {
            width: 24px;
            height: 24px;
            fill: var(--grimaldi-white);
        }

        .magazine-item__info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .magazine-item__title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--grimaldi-blue);
            margin-bottom: 0.25rem;
        }

        .magazine-item__date {
            font-size: 0.75rem;
            color: var(--grimaldi-text-muted);
        }

        .magazine-item a {
            font-size: 0.8rem;
            color: var(--grimaldi-blue);
            text-decoration: none;
        }

        .magazine-item a:hover {
            text-decoration: underline;
        }

        /* Loading State */
        .news-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: var(--space-3xl);
            color: var(--grimaldi-text-muted);
        }

        .news-loading__spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--grimaldi-gray);
            border-top-color: var(--grimaldi-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: var(--space-md);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .news-layout {
                grid-template-columns: 1fr;
            }

            .news-sidebar {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-lg);
            }
        }

        @media (max-width: 768px) {
            .news-card {
                flex-direction: column;
            }

            .news-card__image {
                width: 100%;
                height: 160px;
            }

            .news-sidebar {
                grid-template-columns: 1fr;
            }

            .news-featured__title {
                font-size: 1.5rem;
            }

            .news-featured__actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">
        <!-- PAGE HEADER -->
        <header class="news-hero">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="news_page.title">Novedades Corporativas</h1>
                <p class="cuerpo-principal" data-i18n="news_page.description">
                    Manténgase informado con nuestra revista trimestral y las últimas actualizaciones de Grimaldi Group.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper" aria-labelledby="news-page-title">
            <div class="contenedor-principal">
                <div class="news-layout">
                    
                    <!-- Main News Column -->
                    <div class="news-main" id="news-main-container">
                        <div class="news-loading">
                            <div class="news-loading__spinner"></div>
                            <span data-i18n="contact.loading">Cargando novedades...</span>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <aside class="news-sidebar">
                        <!-- Quick Links Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-widget__title">
                                <svg viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
                                Enlaces Rápidos
                            </h3>
                            <ul class="quick-links">
                                <li>
                                    <a href="schedule">
                                        <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg>
                                        Itinerarios (Schedules)
                                    </a>
                                </li>
                                <li>
                                    <a href="tipo-de-cambio">
                                        <svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                                        Tipo de Cambio
                                    </a>
                                </li>
                                <li>
                                    <a href="documentacion">
                                        <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                                        Documentación
                                    </a>
                                </li>
                                <li>
                                    <a href="contacto">
                                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                        Contacto
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Magazine Archive Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-widget__title">
                                <svg viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                                Archivo de Revistas
                            </h3>
                            <div id="magazine-archive">
                                <div class="magazine-item">
                                    <div class="magazine-item__cover">
                                        <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                    </div>
                                    <div class="magazine-item__info">
                                        <span class="magazine-item__title">Grimaldi News Q1 2026</span>
                                        <span class="magazine-item__date">Marzo 2026</span>
                                        <a href="#">Descargar PDF</a>
                                    </div>
                                </div>
                                <div class="magazine-item">
                                    <div class="magazine-item__cover">
                                        <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                    </div>
                                    <div class="magazine-item__info">
                                        <span class="magazine-item__title">Grimaldi News Q4 2025</span>
                                        <span class="magazine-item__date">Diciembre 2025</span>
                                        <a href="#">Descargar PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter Signup -->
                        <div class="sidebar-widget" style="background: linear-gradient(135deg, var(--grimaldi-blue) 0%, var(--grimaldi-blue-dark) 100%); color: var(--grimaldi-white);">
                            <h3 class="sidebar-widget__title" style="color: var(--grimaldi-white); border-bottom-color: rgba(255,255,255,0.2);">
                                <svg viewBox="0 0 24 24" style="fill: var(--grimaldi-white);"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                Suscríbase
                            </h3>
                            <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: var(--space-md);">Reciba las últimas novedades directamente en su correo.</p>
                            <a href="contacto" class="boton-secundario" style="width: 100%; border-color: var(--grimaldi-white); color: var(--grimaldi-white);">
                                Contactar
                            </a>
                        </div>
                    </aside>

                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript Base -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>

    <!-- Script de carga de noticias -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const container = document.getElementById('news-main-container');
            
            try {
                const response = await fetch('/src/data/mock_news.json');
                const news = await response.json();
                
                container.innerHTML = '';
                
                if(news.length === 0) {
                    container.innerHTML = `
                        <div class="sidebar-widget" style="text-align: center; padding: var(--space-3xl);">
                            <svg viewBox="0 0 24 24" width="48" height="48" fill="var(--grimaldi-text-muted)"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 9h-2V5h2v6zm0 4h-2v-2h2v2z"/></svg>
                            <p style="margin-top: var(--space-md); color: var(--grimaldi-text-muted);">No hay novedades publicadas por el momento.</p>
                        </div>
                    `;
                    return;
                }
                
                // Render featured article (first item)
                const featured = news[0];
                const featuredDate = new Date(featured.fecha_publicacion).toLocaleDateString('es-AR', { year: 'numeric', month: 'long', day: 'numeric' });
                const isFeaturedMagazine = featured.pdf_path && featured.pdf_path !== "";
                
                let html = `
                    <article class="news-featured">
                        ${featured.imagen_path ? `<img src="${featured.imagen_path}" alt="${featured.titulo}" class="news-featured__image">` : ''}
                        <div class="news-featured__content">
                            <div class="news-featured__meta">
                                <span class="news-tag ${isFeaturedMagazine ? 'news-tag--magazine' : ''}">${isFeaturedMagazine ? 'Revista' : 'Noticia'}</span>
                                <span class="news-date">${featuredDate}</span>
                            </div>
                            <h2 class="news-featured__title">${featured.titulo}</h2>
                            ${featured.subtitulo ? `<p class="news-featured__excerpt"><strong>${featured.subtitulo}</strong></p>` : ''}
                            <p class="news-featured__excerpt">${featured.cuerpo}</p>
                            <div class="news-featured__actions">
                                ${isFeaturedMagazine ? `<a href="${featured.pdf_path}" target="_blank" class="boton-primario">Descargar Revista (PDF)</a>` : ''}
                            </div>
                        </div>
                    </article>
                `;
                
                // Render remaining articles
                news.slice(1).forEach(item => {
                    const date = new Date(item.fecha_publicacion).toLocaleDateString('es-AR', { year: 'numeric', month: 'short' });
                    const isMagazine = item.pdf_path && item.pdf_path !== "";
                    
                    html += `
                        <article class="news-card">
                            ${item.imagen_path ? `<img src="${item.imagen_path}" alt="${item.titulo}" class="news-card__image">` : ''}
                            <div class="news-card__content">
                                <div class="news-card__meta">
                                    <span class="news-tag ${isMagazine ? 'news-tag--magazine' : ''}">${isMagazine ? 'Revista' : 'Noticia'}</span>
                                    <span class="news-date">${date}</span>
                                </div>
                                <h3 class="news-card__title">${item.titulo}</h3>
                                <p class="news-card__excerpt">${item.subtitulo || item.cuerpo.substring(0, 120) + '...'}</p>
                            </div>
                        </article>
                    `;
                });
                
                container.innerHTML = html;
                
            } catch (err) {
                console.error("Error loading news: ", err);
                container.innerHTML = `
                    <div class="alerta-error">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                        Error al conectar con la base de novedades. Intente nuevamente más tarde.
                    </div>
                `;
            }
        });
    </script>
</body>
</html>
