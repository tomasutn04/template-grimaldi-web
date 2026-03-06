<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Tipo de Cambio | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Consulte la cotización del día para el tipo de cambio oficial de Grimaldi Agencies Argentina. Descargue el comprobante en formato PDF.">
    <meta name="keywords" content="Grimaldi, tipo de cambio, cotización dólar, cotización euro, pagos, cuenta bancaria">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Tipo de Cambio | Grimaldi Agencies Argentina">
    <meta property="og:description" content="Cotización diaria oficial y datos bancarios para pagos.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/tipo-de-cambio">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/tipo-de-cambio">

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/tipo-de-cambio.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="exchange.title">Tipo de Cambio y Datos Bancarios</h1>
                <p class="cuerpo-principal" data-i18n="exchange.description" style="max-width: 800px; margin: 0 auto;">
                    Aquí podrá visualizar nuestro tipo de cambio vigente y nuestros datos bancarios para realizar sus
                    pagos.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <section class="section-wrapper" aria-labelledby="tc-titulo" style="min-height: 50vh;">
            <div class="contenedor-principal" style="position: relative;">

                <!-- Loading State -->
                <div id="tc-loading" class="alerta-estado text-center">
                    <i class="fas fa-spinner fa-spin"></i> Cargando cotización...
                </div>

                <!-- Error/Gated State -->
                <div id="tc-alert-container"></div>

                <div id="tc-content" style="display: none;" class="animate-fade-in">

                    <div class="status-header">
                        <span class="status-dot"></span>
                        <span data-i18n="exchange.active_status">Cotización en vivo</span>
                    </div>

                    <!-- Values -->
                    <div class="tc-cards">
                        <div class="tc-card">
                            <div class="tc-label" data-i18n="exchange.usd">Dólar</div>
                            <div class="tc-value" id="val-usd">$0.00</div>
                            <div class="texto-info tc-date-display">--/--/----</div>
                        </div>

                        <div class="tc-card">
                            <div class="tc-label" data-i18n="exchange.eur">Euro</div>
                            <div class="tc-value" id="val-eur">€0.00</div>
                            <div class="texto-info tc-date-display">--/--/----</div>
                        </div>
                    </div>

                    <!-- Bank Details & PDF -->
                    <div class="tc-cards">
                        <div class="tc-card tc-card--bank">
                            <h3 class="titulo-contenido" data-i18n="exchange.bank_data_title" style="margin-top: 0;">
                                Datos Bancarios (Pesos Argentinos)</h3>
                            <div class="bank-details" id="bank-data">
                                <!-- Injected via JS -->
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 2rem;">
                        <button id="btn-descargar-pdf" class="boton-primario">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"
                                style="vertical-align: sub; margin-right: 0.5rem;">
                                <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                            </svg>
                            <span data-i18n="exchange.btn_download">Descargar PDF</span>
                        </button>
                    </div>

                </div>

                <!-- Info Panel -->
                <div class="info-panel">
                    <div>
                        <h4 class="titulo-contenido" data-i18n="schedule.hours_title">Horario de Atención</h4>
                        <p class="texto-info">Lunes a Viernes: 09:00 - 17:00</p>
                    </div>
                    <div>
                        <h4 class="titulo-contenido" data-i18n="schedule.update_title">Última Actualización</h4>
                        <p class="texto-destacado" id="last-update"
                            style="color: var(--grimaldi-blue); font-weight: bold;">--</p>
                    </div>
                    <div>
                        <h4 class="titulo-contenido" data-i18n="exchange.contact_title">Contacto Caja</h4>
                        <p class="texto-info" data-i18n="exchange.contact_desc" style="margin-bottom: 0.5rem;">Para
                            consultas específicas</p>
                        <a href="mailto:tc@grimaldi-bue.com.ar" class="boton-secundario"
                            style="padding: 0.25rem 0.75rem; font-size: 0.85rem;"
                            data-i18n="exchange.btn_contact">Contactar Caja</a>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <!-- jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- JavaScript Base -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>

    <!-- Page Specific JS: Time-gating and PDF Export -->
    <script src="<?php echo JS_URL; ?>/tipo-de-cambio.js" defer></script>
</body>

</html>
