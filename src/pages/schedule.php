<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Schedules | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Fechas estimadas de arribo y salida (ETA/ETS) de los buques del Grupo Grimaldi desde y hacia Argentina.">
    <meta name="keywords"
        content="Grimaldi, schedule, cronograma de buques, ETA, ETS, Zárate, puertos, llegada de barcos">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Schedules | Grimaldi Agencies Argentina">
    <meta property="og:description" content="Fechas estimadas de arribo y salida de buques Grimaldi.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/schedule">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/schedule">

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/schedule.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="schedule.title">Schedules</h1>
                <p class="cuerpo-principal" data-i18n="schedule.description" style="max-width: 800px; margin: 0 auto;">
                    Visualice la ETS/ETA de su mercadería o planifique cuál de nuestros buques transportará su carga.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper" aria-labelledby="schedule-titulo" style="min-height: 50vh;">
            <div class="contenedor-principal">

                <!-- Controls -->
                <div class="schedule-controls" id="schedule-ui" style="display: none;">
                    <div class="schedule-select-wrapper">
                        <label for="route-select"><strong data-i18n="services_page.routes_title">Nuestras
                                Rutas:</strong></label>
                        <select id="route-select">
                            <!-- Options injected via JS -->
                        </select>
                    </div>

                    <button id="btn-export-excel" class="boton-primario">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"
                            style="vertical-align: sub; margin-right: 0.5rem;">
                            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                        </svg>
                        <span data-i18n="schedule.btn_export">Exportar Vista a Excel</span>
                    </button>
                </div>

                <!-- Loading State -->
                <div id="schedule-loading" class="alerta-estado text-center">
                    <i class="fas fa-spinner fa-spin"></i> <span data-i18n="schedule.loading">Cargando tabla de
                        schedule...</span>
                </div>

                <!-- Table Area -->
                <div class="table-responsive animate-fade-in" id="table-container" style="display: none;">
                    <table class="grimaldi-table" id="schedule-table">
                        <thead id="schedule-head">
                            <!-- Columns injected via JS -->
                        </thead>
                        <tbody id="schedule-body">
                            <!-- Rows injected via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Info Panel -->
                <div class="info-panel">
                    <div>
                        <h4 class="titulo-contenido" data-i18n="schedule.hours_title">Horarios de Atención</h4>
                        <p class="texto-info" data-i18n="schedule.hours_desc">Lunes a Viernes: 9:00 - 17:00</p>
                    </div>
                    <div>
                        <h4 class="titulo-contenido" data-i18n="schedule.update_title">Última Actualización</h4>
                        <p class="texto-destacado" id="last-update"
                            style="color: var(--grimaldi-dark); font-weight: bold;">--</p>
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

    <!-- Page Specific JS: Mock Table Rendering & Excel Export -->
    <script src="<?php echo JS_URL; ?>/schedule.js" defer></script>
</body>

</html>
