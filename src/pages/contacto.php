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

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/contacto.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="contact.title">Contactos de Empleados</h1>
                <p class="cuerpo-principal" data-i18n="contact.description" style="max-width: 800px; margin: 0 auto;">
                    Encuentre rápidamente a la persona de contacto en el departamento correspondiente.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper" aria-labelledby="contactos-titulo">
            <div class="contenedor-principal">

                <div style="text-align: center;">
                    <div class="filtro-sectores" id="filtro-container" style="display: none;">
                        <label for="sector-select"><strong data-i18n="contact.filter_label">Filtrar por
                                sector:</strong></label>
                        <select id="sector-select">
                            <option value="todos" data-i18n="contact.filter_all">Todos</option>
                            <!-- Dynamic options injected here -->
                        </select>
                    </div>
                </div>

                <div id="gme-contactos-contenido" aria-live="polite">
                    <div class="alerta-estado text-center">
                        <i class="fas fa-spinner fa-spin"></i> <span data-i18n="contact.loading">Cargando listado de
                            contactos...</span>
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

    <!-- Page Specific JS: Fetching and Rendering Contacts -->
    <script>
        const ASSETS_URL = "<?php echo ASSETS_URL; ?>";
    </script>
    <script src="<?php echo JS_URL; ?>/contacto.js" defer></script>
</body>

</html>
