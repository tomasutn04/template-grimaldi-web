<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Servicios Logísticos | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Servicios logísticos integrados de Grimaldi Agencies Argentina. Conoce nuestras rutas, tipos de carga y a nuestro equipo comercial especializado.">
    <meta name="keywords"
        content="Grimaldi, servicios logísticos, carga rodante, project cargo, contenedores, rutas marítimas, Terminal Zárate">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Servicios Logísticos | Grimaldi Agencies Argentina">
    <meta property="og:description"
        content="Servicios logísticos integrados. Transporte de vehículos, carga ro-ro, contenedores y carga proyecto.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/servicios">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">
    <meta property="og:locale" content="es_AR">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/servicios">

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/servicios.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="services_page.title">Nuestros Servicios Logísticos</h1>
                <p class="cuerpo-principal" data-i18n="services_page.description"
                    style="max-width: 800px; margin: 0 auto;">
                    Somos una agencia marítima dedicada a servicios logísticos integrados. Transportamos automóviles,
                    carga rodada, contenedores y carga proyecto para conectar Argentina con el mundo.
                </p>
            </div>
        </header>

        <!-- SERVICES CARDS -->
        <section class="section-wrapper">
            <div class="contenedor-principal">
                <div class="layout-flexible" style="justify-content: center; gap: 2rem;">

                    <!-- Card 1: Rolling Cargo -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon" style="margin-bottom: 1rem;">
                            <!-- Car/RoRo Icon -->
                            <svg viewBox="0 0 24 24" width="48" height="48" fill="var(--grimaldi-blue)"
                                aria-hidden="true">
                                <path
                                    d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" data-i18n="services_preview.card_1_title">Carga Rodante</h3>
                        <p class="texto-info" data-i18n="services_preview.card_1_desc">Vehículos y Maquinaria:
                            Transporte especializado para todo tipo de rodados.</p>
                    </div>

                    <!-- Card 2: Project Cargo -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon" style="margin-bottom: 1rem;">
                            <!-- Project Cargo Icon -->
                            <svg viewBox="0 0 24 24" width="48" height="48" fill="var(--grimaldi-blue)"
                                aria-hidden="true">
                                <path
                                    d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" data-i18n="services_preview.card_2_title">Carga Proyecto</h3>
                        <p class="texto-info" data-i18n="services_preview.card_2_desc">Equipos y Estructuras: Soluciones
                            para cargas sobredimensionadas.</p>
                    </div>

                    <!-- Card 3: Containers -->
                    <div class="card-grimaldi service-card">
                        <div class="service-card__icon" style="margin-bottom: 1rem;">
                            <!-- Container Icon -->
                            <svg viewBox="0 0 24 24" width="48" height="48" fill="var(--grimaldi-blue)"
                                aria-hidden="true">
                                <path
                                    d="M20.5 11H19V7c0-1.1-.9-2-2-2h-4V3.5C13 2.12 11.88 1 10.5 1S8 2.12 8 3.5V5H4c-1.1 0-1.99.9-1.99 2v3.8H3.5c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7H2V20c0 1.1.9 2 2 2h3.8v-1.5c0-1.49 1.21-2.7 2.7-2.7 1.49 0 2.7 1.21 2.7 2.7V22H17c1.1 0 2-.9 2-2v-4h1.5c1.38 0 2.5-1.12 2.5-2.5S21.88 11 20.5 11z" />
                            </svg>
                        </div>
                        <h3 class="titulo-contenido" data-i18n="services_preview.card_3_title">Contenedores</h3>
                        <p class="texto-info" data-i18n="services_preview.card_3_desc">20ft Dry / Tank y 40ft High Cube:
                            Opciones versátiles para su carga.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ROUTES SECTION -->
        <section class="section-wrapper section-wrapper--alt">
            <div class="contenedor-principal">
                <div class="layout-50-50" style="align-items: center; gap: 4rem;">
                    <div class="layout-mitad">
                        <h2 class="titulo-principal" data-i18n="services_page.routes_title">Nuestras Rutas</h2>
                        <p class="cuerpo-contenido" data-i18n="services_page.routes_desc_1">
                            Nuestros buques "multipropósito" están diseñados para la carga simultánea de contenedores,
                            carga proyecto y automóviles.
                        </p>
                        <p class="texto-info" data-i18n="services_page.routes_desc_2">
                            En Argentina, operamos en <strong>Terminal Zárate</strong>. Desde allí, conectamos con
                            puertos clave en <strong>Brasil, Uruguay, Noroeste de África y Norte de Europa</strong>,
                            ofreciendo también trasbordos para extender nuestras rutas.
                        </p>
                        <div style="margin-top: 2rem;">
                            <!-- Embedded Map Image -->
                            <img src="<?php echo ASSETS_URL; ?>/img/GAA_routes.jpg"
                                alt="Mapa de rutas marítimas de Grimaldi Agencies Argentina" loading="lazy" width="100%"
                                height="auto"
                                style="border-radius: var(--radius-lg); box-shadow: var(--grimaldi-shadow-md);">
                        </div>
                    </div>

                    <div class="layout-mitad">
                        <!-- Route Explorer UI Component -->
                        <div class="route-explorer">
                            <div class="route-regions" role="tablist">
                                <button class="boton-secundario route-region-btn active" role="tab" aria-selected="true"
                                    data-region="sa" data-i18n="services_page.region_sa">América del Sur</button>
                                <button class="boton-secundario route-region-btn" role="tab" aria-selected="false"
                                    data-region="eu" data-i18n="services_page.region_eu">Europa</button>
                                <button class="boton-secundario route-region-btn" role="tab" aria-selected="false"
                                    data-region="af" data-i18n="services_page.region_af">África</button>
                            </div>

                            <div class="route-ports">
                                <div id="ports-sa" class="port-list active" role="tabpanel">
                                    <ul>
                                        <li><i>⚓</i> Zárate</li>
                                        <li><i>⚓</i> Montevideo</li>
                                        <li><i>⚓</i> Paranagua</li>
                                        <li><i>⚓</i> Santos</li>
                                        <li><i>⚓</i> Rio de Janeiro</li>
                                        <li><i>⚓</i> Vitoria</li>
                                        <li><i>⚓</i> Suape</li>
                                    </ul>
                                </div>

                                <div id="ports-eu" class="port-list" role="tabpanel">
                                    <ul>
                                        <li><i>⚓</i> Amberes (Antwerp)</li>
                                        <li><i>⚓</i> Rotterdam</li>
                                        <li><i>⚓</i> Hamburgo (Hamburg)</li>
                                        <li><i>⚓</i> Tilbury</li>
                                        <li><i>⚓</i> Vigo</li>
                                    </ul>
                                </div>

                                <div id="ports-af" class="port-list" role="tabpanel">
                                    <ul>
                                        <li><i>⚓</i> Santa Cruz de Tenerife</li>
                                        <li><i>⚓</i> Abidjan</li>
                                        <li><i>⚓</i> Tema</li>
                                        <li><i>⚓</i> Cotonou</li>
                                        <li><i>⚓</i> Lagos (PTML)</li>
                                        <li><i>⚓</i> Dakar</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMMERCIAL TEAM -->
        <section class="section-wrapper">
            <div class="contenedor-principal" style="text-align: center;">
                <h2 class="titulo-principal" data-i18n="services_page.team_title">Nuestro Equipo Comercial</h2>
                <p class="cuerpo-principal" data-i18n="services_page.team_desc"
                    style="max-width: 800px; margin: 0 auto 3rem;">
                    Para solicitar una cotización, encuentre a la persona de contacto o envíe su consulta al correo
                    electrónico correspondiente a su tipo de carga.
                </p>

                <a href="contacto" class="boton-primario">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"
                        style="vertical-align: middle; margin-right: 0.5rem;">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    Ver Contactos Comerciales
                </a>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript Base -->
    <script src="<?php echo JS_URL; ?>/i18n.js"></script>
    <script src="<?php echo JS_URL; ?>/main.js"></script>

    <!-- Page Specific JS -->
    <script src="<?php echo JS_URL; ?>/servicios.js" defer></script>
</body>

</html>
