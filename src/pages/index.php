<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Grimaldi Agencies Argentina — Transporte Marítimo y Logística</title>
    <meta name="description"
        content="Grimaldi Agencies Argentina S.A. representa al Grupo Grimaldi, multinacional italiana con más de 75 años conectando mercados a través de rutas marítimas eficientes.">
    <meta name="keywords"
        content="Grimaldi, transporte marítimo, logística, Argentina, contenedores, carga proyecto, vehículos, Terminal Zárate">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Grimaldi Agencies Argentina">
    <meta property="og:description"
        content="Soluciones de transporte marítimo y logística internacional desde y hacia Argentina.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">
    <meta property="og:locale" content="es_AR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Grimaldi Agencies Argentina">
    <meta name="twitter:description" content="Soluciones de transporte marítimo y logística internacional.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar">

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Preload hero image -->
    <link rel="preload" as="image" href="<?php echo ASSETS_URL; ?>/img/grande_amburgo.png">

    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/index.css">
</head>

<body>

    <!-- ═══════════════════════════════════ -->
    <!--        HEADER (loaded via JS)      -->
    <!-- ═══════════════════════════════════ -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>


    <main id="main-content" role="main">

        <!-- ═══════════════════════════════════ -->
        <!--        HERO BANNER (Compact)       -->
        <!-- ═══════════════════════════════════ -->
        <section class="hero-banner hero-banner--compact" aria-labelledby="hero-title" id="hero">
            <img class="hero-banner__bg" src="<?php echo ASSETS_URL; ?>/img/grande_amburgo.png"
                alt="Buque Grimaldi Grande Amburgo navegando en alta mar" width="1920" height="1080">

            <div class="contenedor-principal">
                <h1 class="titulo-principal" id="hero-title" data-i18n="hero.title">
                    Bienvenidos a Grimaldi Agencies Argentina
                </h1>
                <p class="cuerpo-principal" data-i18n="hero.subtitle">
                    Conectamos mercados a través de rutas marítimas eficientes y confiables, desde y hacia Argentina.
                </p>
                
                <!-- Quick Schedule Search Widget -->
                <div class="hero-search-widget">
                    <form class="schedule-quick-search" action="schedule" method="GET">
                        <div class="search-field">
                            <label for="hero-origin" class="sr-only">Puerto de Origen</label>
                            <select id="hero-origin" name="origin">
                                <option value="">Puerto de Origen</option>
                                <option value="zarate">Zarate, Argentina</option>
                                <option value="santos">Santos, Brasil</option>
                                <option value="montevideo">Montevideo, Uruguay</option>
                            </select>
                        </div>
                        <div class="search-field">
                            <label for="hero-destination" class="sr-only">Puerto de Destino</label>
                            <select id="hero-destination" name="destination">
                                <option value="">Puerto de Destino</option>
                                <option value="antwerp">Antwerp, Belgica</option>
                                <option value="hamburg">Hamburg, Alemania</option>
                                <option value="dakar">Dakar, Senegal</option>
                                <option value="tema">Tema, Ghana</option>
                            </select>
                        </div>
                        <button type="submit" class="boton-primario search-btn">
                            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                            Buscar Itinerarios
                        </button>
                    </form>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="hero-scroll-indicator" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" />
                </svg>
            </div>
        </section>

        <!-- ═══════════════════════════════════ -->
        <!--     DASHBOARD WIDGETS SECTION      -->
        <!-- ═══════════════════════════════════ -->
        <section class="dashboard-widgets" aria-label="Acceso rápido a servicios" id="widgets">
            <div class="contenedor-principal">
                <div class="widgets-grid">

                    <!-- Widget 1: Tipo de Cambio -->
                    <div class="widget-card widget-card--exchange">
                        <div class="widget-header">
                            <div class="widget-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                                </svg>
                            </div>
                            <h3 class="widget-title">Tipo de Cambio</h3>
                        </div>
                        <div class="widget-body">
                            <div class="exchange-rates" id="exchange-widget">
                                <div class="rate-item">
                                    <span class="rate-currency">USD</span>
                                    <span class="rate-value" id="usd-rate">--</span>
                                </div>
                                <div class="rate-item">
                                    <span class="rate-currency">EUR</span>
                                    <span class="rate-value" id="eur-rate">--</span>
                                </div>
                            </div>
                            <p class="widget-update">Actualizado: <span id="rate-date">--</span></p>
                        </div>
                        <a href="tipo-de-cambio" class="widget-link">
                            Ver detalles completos
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                        </a>
                    </div>

                    <!-- Widget 2: Documentación -->
                    <div class="widget-card widget-card--docs">
                        <div class="widget-header">
                            <div class="widget-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                </svg>
                            </div>
                            <h3 class="widget-title">Documentación</h3>
                        </div>
                        <div class="widget-body">
                            <ul class="quick-docs-list">
                                <li><a href="documentacion#export">Formularios Exportación</a></li>
                                <li><a href="documentacion#import">Formularios Importación</a></li>
                                <li><a href="documentacion#customs">Documentación Aduanera</a></li>
                            </ul>
                        </div>
                        <a href="documentacion" class="widget-link">
                            Ver todos los formularios
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                        </a>
                    </div>

                    <!-- Widget 3: Schedules -->
                    <div class="widget-card widget-card--schedules">
                        <div class="widget-header">
                            <div class="widget-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10h20V10c0-1.1-.9-2-2-2zM9 6h6v2H9V6zm11 12H4v-3h2v1h2v-1h8v1h2v-1h2v3zm0-5h-2v-1h-2v1H8v-1H6v1H4v-3h16v3z"/>
                                </svg>
                            </div>
                            <h3 class="widget-title">Próximas Salidas</h3>
                        </div>
                        <div class="widget-body">
                            <div class="next-departures" id="departures-widget">
                                <div class="departure-item">
                                    <span class="departure-vessel">Grande San Paolo</span>
                                    <span class="departure-route">ZAR → ANT</span>
                                    <span class="departure-date">Prox. Viernes</span>
                                </div>
                                <div class="departure-item">
                                    <span class="departure-vessel">Grande Francia</span>
                                    <span class="departure-route">ZAR → HAM</span>
                                    <span class="departure-date">En 10 días</span>
                                </div>
                            </div>
                        </div>
                        <a href="schedule" class="widget-link">
                            Ver itinerario completo
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                        </a>
                    </div>

                    <!-- Widget 4: Noticias -->
                    <div class="widget-card widget-card--news">
                        <div class="widget-header">
                            <div class="widget-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22 3l-1.67 1.67L18.67 3 17 4.67 15.33 3l-1.66 1.67L12 3l-1.67 1.67L8.67 3 7 4.67 5.33 3 3.67 4.67 2 3v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V3zM11 19H4v-6h7v6zm9 0h-7v-2h7v2zm0-4h-7v-2h7v2zm0-4H4V8h16v3z"/>
                                </svg>
                            </div>
                            <h3 class="widget-title">Últimas Noticias</h3>
                        </div>
                        <div class="widget-body">
                            <div class="news-preview">
                                <article class="news-item-mini">
                                    <span class="news-date">Mar 2026</span>
                                    <h4>Nuevas rutas desde Terminal Zárate</h4>
                                </article>
                                <article class="news-item-mini">
                                    <span class="news-date">Feb 2026</span>
                                    <h4>Grimaldi Group expande flota</h4>
                                </article>
                            </div>
                        </div>
                        <a href="novedades" class="widget-link">
                            Ver todas las noticias
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
                        </a>
                    </div>

                </div>
            </div>
        </section>


        <!-- ═══════════════════════════════════ -->
        <!--        ABOUT SECTION               -->
        <!-- ═══════════════════════════════════ -->
        <section class="about-section section-wrapper" aria-labelledby="about-title" id="about">
            <div class="contenedor-principal">
                <div class="layout-50-50" style="align-items: center;">
                    <div class="layout-mitad">
                        <div class="card-info" style="border-left: 4px solid var(--grimaldi-blue);">
                            <h2 class="titulo-contenido" id="about-title" data-i18n="about.title">
                                Soluciones eficaces para las necesidades de su empresa
                            </h2>
                            <p class="cuerpo-contenido" data-i18n="about.paragraph_1">
                                Grimaldi Agencies Argentina S.A. representa en Argentina al prestigioso Grupo Grimaldi,
                                una multinacional italiana con más de 75 años de experiencia en transporte marítimo y
                                logística.
                            </p>
                            <p class="cuerpo-contenido" data-i18n="about.paragraph_2">
                                Fundada en 1947, la compañía opera una de las flotas más grandes del mundo, conectando
                                más de 150 puertos en 50 países.
                            </p>
                            <ul class="lista-institucional">
                                <li data-i18n="about.list_1">Envío global</li>
                                <li data-i18n="about.list_2">Buques multipropósito</li>
                                <li data-i18n="about.list_3">Años de experiencia</li>
                            </ul>
                        </div>
                    </div>
                    <div class="layout-mitad" style="align-items: center;">
                        <img src="<?php echo ASSETS_URL; ?>/img/grande_francia_frente-1.png"
                            alt="Buque Grande Francia del Grupo Grimaldi atracado en puerto mostrando la capacidad de carga rodante y contenedores"
                            loading="lazy" width="700" height="420"
                            style="border-radius: var(--radius-lg); box-shadow: var(--grimaldi-shadow-lg);">
                    </div>
                </div>
            </div>
        </section>


        <!-- ═══════════════════════════════════ -->
        <!--      SERVICES PREVIEW              -->
        <!-- ═══════════════════════════════════ -->
        <section class="services-preview section-wrapper section-wrapper--alt" aria-labelledby="services-title"
            id="services-preview">
            <div class="contenedor-principal">
                <div class="section-header">
                    <h2 class="titulo-principal" id="services-title" data-i18n="services_preview.title">
                        Tipos de Carga que Operamos
                    </h2>
                </div>

                <div class="layout-flexible" style="justify-content: center; gap: 2rem;">

                    <!-- Card 1: Rolling Cargo -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" style="text-align: center;"
                            data-i18n="services_preview.card_1_title">Carga Rodante</h3>
                        <p class="texto-info" style="text-align: center;" data-i18n="services_preview.card_1_desc">
                            Vehículos y Maquinaria: Transporte especializado para todo tipo de rodados.</p>
                        <div class="card-footer" style="justify-content: center; border-top: none;">
                            <a href="servicios" class="boton-secundario" style="font-size: 0.875rem;">→</a>
                        </div>
                    </div>

                    <!-- Card 2: Project Cargo -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" style="text-align: center;"
                            data-i18n="services_preview.card_2_title">Carga Proyecto</h3>
                        <p class="texto-info" style="text-align: center;" data-i18n="services_preview.card_2_desc">
                            Equipos y Estructuras: Soluciones para cargas sobredimensionadas.</p>
                        <div class="card-footer" style="justify-content: center; border-top: none;">
                            <a href="servicios" class="boton-secundario" style="font-size: 0.875rem;">→</a>
                        </div>
                    </div>

                    <!-- Card 3: Containers -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M20.5 11H19V7c0-1.1-.9-2-2-2h-4V3.5C13 2.12 11.88 1 10.5 1S8 2.12 8 3.5V5H4c-1.1 0-1.99.9-1.99 2v3.8H3.5c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7H2V20c0 1.1.9 2 2 2h3.8v-1.5c0-1.49 1.21-2.7 2.7-2.7 1.49 0 2.7 1.21 2.7 2.7V22H17c1.1 0 2-.9 2-2v-4h1.5c1.38 0 2.5-1.12 2.5-2.5S21.88 11 20.5 11z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" style="text-align: center;"
                            data-i18n="services_preview.card_3_title">Contenedores</h3>
                        <p class="texto-info" style="text-align: center;" data-i18n="services_preview.card_3_desc">20ft
                            Dry / Tank y 40ft High Cube: Opciones versátiles para su carga.</p>
                        <div class="card-footer" style="justify-content: center; border-top: none;">
                            <a href="servicios" class="boton-secundario" style="font-size: 0.875rem;">→</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ═══════════════════════════════════ -->
        <!--        STATS SECTION               -->
        <!-- ═══════════════════════════════════ -->
        <section class="stats-section" aria-labelledby="stats-heading" id="stats">
            <h2 id="stats-heading" class="sr-only">Nuestros números</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" data-target="75" aria-label="75+ años de experiencia">0</div>
                    <div class="stat-label" data-i18n="stats.years">Años de Experiencia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="150" aria-label="150+ puertos conectados">0</div>
                    <div class="stat-label" data-i18n="stats.ports">Puertos Conectados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50" aria-label="50+ países">0</div>
                    <div class="stat-label" data-i18n="stats.countries">Países</div>
                </div>
            </div>
        </section>


        <!-- ═══════════════════════════════════ -->
        <!--        ROUTES MAP                  -->
        <!-- ═══════════════════════════════════ -->
        <section class="section-wrapper" aria-labelledby="routes-title" id="routes">
            <div class="contenedor-principal" style="text-align: center;">
                <h2 class="titulo-principal" id="routes-title" data-i18n="services_preview.title"
                    style="margin-bottom: 2rem;">
                    Tipos de Carga que Operamos
                </h2>
                <img src="<?php echo ASSETS_URL; ?>/img/GAA_routes.jpg"
                    alt="Mapa de rutas marítimas de Grimaldi Agencies Argentina conectando Sudamérica, Europa y África"
                    loading="lazy" width="900" height="500"
                    style="border-radius: var(--radius-lg); box-shadow: var(--grimaldi-shadow-lg); max-width: 900px; margin: 0 auto;">
            </div>
        </section>


        <!-- ═══════════════════════════════════ -->
        <!--        FAQ SECTION                 -->
        <!-- ═══════════════════════════════════ -->
        <section class="faq-section" aria-labelledby="faq-title" id="faq">

            <!-- FAQ Header -->
            <div class="faqs-header">
                <p class="texto-info subtitulo-seccion" data-i18n="faq.section_label">
                    <span>—</span> FAQs <span>—</span>
                </p>
                <h2 class="titulo-principal" id="faq-title" data-i18n="faq.title">Preguntas frecuentes</h2>
                <p class="cuerpo-principal" data-i18n="faq.subtitle">Respuestas rápidas para tus consultas cotidianas
                </p>
            </div>

            <!-- FAQ Grid (2 columns) -->
            <div class="faq-grid">

                <!-- Left Column -->
                <div class="faqs-contenedor">

                    <!-- FAQ 1 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q1">
                            Ubicación de oficina y nuestros horarios de atención
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p data-i18n="faq.a1">25 de Mayo 702, 1er Piso, CABA, Lunes a Viernes de 9:00hs a 17:00hs.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q2">
                            ¿Dónde puedo saber la fecha de arribo o salida de mi carga?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p>
                                <span data-i18n="faq.a2_pre">Nuestros schedule se actualizan todos los viernes y puedes
                                    visualizarlo haciendo click </span>
                                <a href="schedule" data-i18n="faq.a2_link">Aquí</a>
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q3">
                            ¿Qué documentación debo presentar para mi exportación?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p>
                                <span data-i18n="faq.a3_pre">Visualiza con detalle toda la documentación y como proceder
                                    en nuestra sección haciendo click </span>
                                <a href="documentacion" data-i18n="faq.a3_link">aquí</a>
                                <span data-i18n="faq.a3_post"> o mediante nuestros canales de correo electrónicos
                                    oficiales:</span>
                            </p>
                            <p>
                                <a href="mailto:doc@grimaldi-bue.com.ar">doc@grimaldi-bue.com.ar</a><br>
                                <a href="mailto:finance@grimaldi-bue.com.ar">finance@grimaldi-bue.com.ar</a>
                            </p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q4">
                            ¿Dónde consulto el tipo de cambio para mi factura a pagar?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p>
                                <span data-i18n="faq.a4_pre">Puedes verlo desde nuestra sección web haciendo click
                                </span>
                                <a href="tipo-de-cambio" data-i18n="faq.a4_link">aquí</a>
                                <span data-i18n="faq.a4_post"> o enviando un mail solicitando la cotización a nuestra
                                    casilla automática:</span>
                            </p>
                            <p><a href="mailto:tc@grimaldi-bue.com.ar">tc@grimaldi-bue.com.ar</a></p>
                        </div>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="faqs-contenedor">

                    <!-- FAQ 5 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q5">
                            ¿Cuáles son los servicios prestados y en qué puerto operan?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p data-i18n="faq.a5">Nuestros buques "multipropósito" permiten la carga de contenedores,
                                carga proyecto y automóviles. En Argentina, operamos en <strong>Terminal Zárate</strong>
                                por su posición estratégica, conectando con puertos en Brasil, Uruguay, Noroeste de
                                África y Norte de Europa, con posibilidades de trasbordo a otras rutas.</p>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q6">
                            ¿Cómo puedo cotizar una carga?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p data-i18n="faq.a6_pre">Puedes solicitar una cotización enviando un correo electrónico
                                directamente al equipo comercial correspondiente a tu tipo de carga. Los correos son:
                            </p>
                            <ul>
                                <li><strong data-i18n="faq.a6_vehicles">Vehículos:</strong> <a
                                        href="mailto:carsvans@grimaldi-bue.com.ar">carsvans@grimaldi-bue.com.ar</a></li>
                                <li><strong data-i18n="faq.a6_project">Carga Proyecto:</strong> <a
                                        href="mailto:projects@grimaldi-bue.com.ar">projects@grimaldi-bue.com.ar</a></li>
                                <li><strong data-i18n="faq.a6_containers">Contenedores:</strong> <a
                                        href="mailto:containers@grimaldi-bue.com.ar">containers@grimaldi-bue.com.ar</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- FAQ 7 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q7">
                            ¿Cómo actuar ante la necesidad de un reclamo en mi carga?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p data-i18n="faq.a7_pre">Para los reclamos se debe presentar:</p>
                            <ul>
                                <li><strong data-i18n="faq.a7_item1">Carta de protesta formal</strong></li>
                                <li><strong data-i18n="faq.a7_item2">Monto reclamado</strong></li>
                                <li><strong data-i18n="faq.a7_item3">Respaldo de factura y/o documentación
                                        correspondiente</strong></li>
                                <li><strong data-i18n="faq.a7_item4">Fotos con el fin de realizar el análisis
                                        pertinente</strong></li>
                            </ul>
                            <p data-i18n="faq.a7_post">Para mayor información o envío de solicitud enviar mail a nuestro
                                canal oficial de correo electrónico:</p>
                            <p><a href="mailto:claims@grimaldi-bue.com.ar">claims@grimaldi-bue.com.ar</a></p>
                        </div>
                    </div>

                    <!-- FAQ 8 -->
                    <div class="faq-item">
                        <button class="faq-pregunta" aria-expanded="false" data-i18n="faq.q8">
                            ¿Cómo solicitar una inspección de carga?
                            <span class="faq-icono"></span>
                        </button>
                        <div class="faq-respuesta" hidden>
                            <p data-i18n="faq.a8">En caso de precisar la inspección de carga deberá solicitarla al mail
                                de <a href="mailto:claims@grimaldi-bue.com.ar">claims@grimaldi-bue.com.ar</a> y deberá
                                tener en cuenta que la/s unidad/es NO podrán ser retiradas de Terminal Zarate hasta
                                tanto no se realice dicha inspección.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>


    <!-- ═══════════════════════════════════ -->
    <!--        FOOTER (loaded via JS)      -->
    <!-- ═══════════════════════════════════ -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>


    <!-- JavaScript (load order matters) -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>
    <script src="<?php echo JS_URL; ?>/index.js"></script>

</body>

</html>

