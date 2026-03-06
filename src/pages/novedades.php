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
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">
        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="news_page.title">Novedades Corporativas</h1>
                <p class="cuerpo-principal" data-i18n="news_page.description" style="max-width: 800px; margin: 0 auto;">
                    Manténgase informado con nuestra revista trimestral y las últimas actualizaciones de servicio.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper" aria-labelledby="news-page-title" style="min-height: 50vh;">
            <div class="contenedor-principal">
                
                <div id="full-news-container" class="cards-contenedor">
                    <div class="alerta-estado text-center" style="width: 100%;">
                        <i class="fas fa-spinner fa-spin"></i> <span data-i18n="contact.loading">Cargando novedades...</span>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript Base -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>

    <!-- Script de carga de mock news -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const container = document.getElementById('full-news-container');
            
            try {
                // Fetch de mock data por ahora (será reemplazado por la BD)
                const response = await fetch('/src/data/mock_news.json');
                const news = await response.json();
                
                container.innerHTML = '';
                
                if(news.length === 0) {
                    container.innerHTML = '<p class="texto-info text-center">No hay novedades publicadas por el momento.</p>';
                    return;
                }
                
                news.forEach(item => {
                    // Validar si es revista o noticia común
                    const isMagazine = item.pdf_path && item.pdf_path !== "";
                    
                    const card = document.createElement('article');
                    card.className = 'card-grimaldi';
                    
                    // Render de la imagen top
                    const imgHtml = item.imagen_path ? `<img src="${item.imagen_path}" alt="Imagen de ${item.titulo}" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius-md) var(--radius-md) 0 0; margin: calc(var(--space-xl) * -1) calc(var(--space-xl) * -1) var(--space-md) calc(var(--space-xl) * -1); border-bottom: 3px solid var(--grimaldi-accent);">` : '';
                    
                    // Render de PDF btn
                    const pdfBtnHtml = isMagazine ? `<a href="${item.pdf_path}" target="_blank" class="boton-primario" style="width: 100%; margin-top: auto; font-size: 0.9rem;">Descargar Revista (PDF)</a>` : '';
                    
                    // Formatear fecha
                    const dateObj = new Date(item.fecha_publicacion);
                    const formattedDate = dateObj.toLocaleDateString('es-AR', { year: 'numeric', month: 'long', day: 'numeric' });

                    card.innerHTML = `
                        ${imgHtml}
                        <div style="display: flex; flex-direction: column; flex-grow: 1;">
                            <span class="texto-info" style="font-size: 0.8rem; text-transform: uppercase; color: var(--grimaldi-accent); font-weight: bold;">${formattedDate}</span>
                            <h3 class="titulo-contenido" style="font-size: 1.25rem;">${item.titulo}</h3>
                            <h4 class="texto-destacado" style="font-size: 0.9rem; margin-bottom: 0.5rem; display: block; background: none; padding: 0;">${item.subtitulo}</h4>
                            <p class="texto-info">${item.cuerpo}</p>
                            <div style="margin-top: auto; padding-top: 1rem;">
                                ${pdfBtnHtml}
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(card);
                });
            } catch (err) {
                console.error("Error loading news: ", err);
                container.innerHTML = '<div class="alerta-error">Error al conectar con la base de novedades.</div>';
            }
        });
    </script>
</body>
</html>
