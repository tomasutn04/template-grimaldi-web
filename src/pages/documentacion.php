<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Documentación y Procedimientos | Grimaldi Agencies Argentina</title>
    <meta name="description"
        content="Guía de documentación, modelos de cartas y contactos clave para importación, exportación y reclamos en Grimaldi Agencies Argentina.">
    <meta name="keywords"
        content="Grimaldi, documentación, BL, conocimientos de embarque, importación, exportación, cartas de garantía, reclamos">
    <meta name="author" content="Grimaldi Agencies Argentina S.A.">
    <meta name="robots" content="index, follow">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Documentación | Grimaldi Agencies Argentina">
    <meta property="og:description"
        content="Guía de documentación, formularios y contactos para operaciones marítimas.">
    <meta property="og:image" content="/assets/img/GGroupCMYK.png">
    <meta property="og:url" content="https://grimaldi-bue.com.ar/documentacion">
    <meta property="og:site_name" content="Grimaldi Agencies Argentina">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/G-blu-scaled.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://grimaldi-bue.com.ar/documentacion">

    <!-- CSS Design System (modular loading via JS / PHP) -->

    <!-- Specific CSS for Internal Pages -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/documentacion.css">
</head>

<body>
    <!-- HEADER -->
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main id="main-content" role="main">

        <!-- PAGE HEADER -->
        <header class="page-header">
            <div class="contenedor-principal">
                <h1 class="titulo-principal" data-i18n="documentation.title">Guía de Documentación y Procedimientos</h1>
                <p class="cuerpo-principal" data-i18n="documentation.description"
                    style="max-width: 800px; margin: 0 auto;">
                    Encuentra los documentos modelo, guías de procedimiento y los contactos clave para cada etapa, desde
                    la solicitud de gastos hasta la gestión de reclamos.
                </p>
            </div>
        </header>

        <!-- MAIN CONTENT (DOCS) -->
        <section class="section-wrapper">
            <div class="contenedor-principal">

                <!-- Filters -->
                <div class="filter-container">
                    <label data-i18n="documentation.filter_procedures">Filtrar procedimientos por:</label>
                    <button class="filter-btn active" data-filter="all" data-i18n="documentation.filter_all">Mostrar
                        Todos</button>
                    <button class="filter-btn" data-filter="impo"
                        data-i18n="documentation.filter_impo">Importación</button>
                    <button class="filter-btn" data-filter="expo"
                        data-i18n="documentation.filter_expo">Exportación</button>
                    <button class="filter-btn" data-filter="claims"
                        data-i18n="documentation.filter_claims">Reclamos</button>
                </div>

                <!-- Doc Grid -->
                <div class="doc-grid" id="procedures-grid">

                    <!-- Doc 1: Declaración de Embarque -->
                    <article class="doc-card" data-category="expo">
                        <div class="doc-card__category" data-i18n="global_terms.export_label">EXPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.doc_1_title">Declaración de Embarque</h3>
                        <div class="doc-card__content" data-i18n="documentation.doc_1_desc"></div>
                        <div>
                            <a href="<?php echo ASSETS_URL; ?>/docs/Declaracion-de-Embarque.pdf" target="_blank"
                                class="boton-secundario" data-i18n="documentation.doc_btn_form">Descargar Formulario</a>
                        </div>
                    </article>

                    <!-- Proc 1: Retiro de BLs Originales -->
                    <article class="doc-card" data-category="impo">
                        <div class="doc-card__category" data-i18n="global_terms.import_label">IMPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.proc_1_title">Retiro de BLs Originales</h3>
                        <div class="doc-card__content" data-i18n="documentation.proc_1_desc"></div>
                        <div>
                            <a href="<?php echo ASSETS_URL; ?>/docs/Carta_Retiro_BL_Original.pdf" target="_blank"
                                class="boton-secundario" data-i18n="documentation.doc_btn_model">Descargar Carta
                                Modelo</a>
                        </div>
                    </article>

                    <!-- Doc 2: Emisión de BLs Destino -->
                    <article class="doc-card" data-category="expo">
                        <div class="doc-card__category" data-i18n="global_terms.export_label">EXPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.doc_2_title">Emisión de BLs en Destino</h3>
                        <div class="doc-card__content" data-i18n="documentation.doc_2_desc"></div>
                        <div>
                            <a href="<?php echo ASSETS_URL; ?>/docs/Emision_BL_en_Destino.pdf" target="_blank" class="boton-secundario"
                                data-i18n="documentation.doc_btn_model">Descargar Carta
                                Modelo</a>
                        </div>
                    </article>

                    <!-- Proc 2: Firma ATA -->
                    <article class="doc-card" data-category="impo expo">
                        <div class="doc-card__category" data-i18n="global_terms.import_export_label">IMPORTACIÓN &
                            EXPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.proc_2_title">Firma ATA</h3>
                        <div class="doc-card__content" data-i18n="documentation.proc_2_desc"></div>
                    </article>

                    <!-- Doc 3: LOI Telex Release -->
                    <article class="doc-card" data-category="expo">
                        <div class="doc-card__category" data-i18n="global_terms.export_label">EXPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.doc_3_title">LOI Télex Release</h3>
                        <div class="doc-card__content" data-i18n="documentation.doc_3_desc"></div>
                        <div>
                            <a href="<?php echo ASSETS_URL; ?>/docs/LOI_Telex_Release.pdf" target="_blank" class="boton-secundario"
                                data-i18n="documentation.doc_btn_loi">Descargar LOI</a>
                        </div>
                    </article>

                    <!-- Proc 3: Solicitud de Gastos Locales -->
                    <article class="doc-card" data-category="impo expo">
                        <div class="doc-card__category" data-i18n="global_terms.import_export_label">IMPORTACIÓN &
                            EXPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.proc_3_title">Solicitud de Gastos Locales
                        </h3>
                        <div class="doc-card__content" data-i18n="documentation.proc_3_desc"></div>
                    </article>

                    <!-- Doc 4: Carta de Garantía Contenedores -->
                    <article class="doc-card" data-category="impo">
                        <div class="doc-card__category" data-i18n="global_terms.import_label">IMPORTACIÓN</div>
                        <h3 class="doc-card__title" data-i18n="documentation.doc_4_title">Carta de Garantía
                            (Contenedores)</h3>
                        <div class="doc-card__content" data-i18n="documentation.doc_4_desc"></div>
                        <div>
                            <a href="<?php echo ASSETS_URL; ?>/docs/Carta_Garantia_Contenedores.pdf" target="_blank"
                                class="boton-secundario" data-i18n="documentation.doc_btn_letter">Descargar Carta</a>
                        </div>
                    </article>

                    <!-- Proc 4: Reclamos e Inspección -->
                    <article class="doc-card" data-category="claims">
                        <div class="doc-card__category" data-i18n="global_terms.claims_label">RECLAMOS E INSPECCIÓN
                        </div>
                        <h3 class="doc-card__title" data-i18n="documentation.proc_4_title">Inicio de Reclamo o
                            Inspección</h3>
                        <div class="doc-card__content" data-i18n="documentation.proc_4_desc"></div>
                    </article>

                </div>
            </div>
        </section>

        <!-- CONTACTS BANNER -->
        <section class="contacts-banner">
            <div class="contenedor-principal">
                <h2 class="titulo-principal" style="color: white; margin-bottom: 0.5rem;">Directorio Administrativo</h2>
                <p>Encuentre los correos electrónicos clave para acelerar sus trámites.</p>

                <div class="contact-grid">
                    <div class="contact-box">
                        <h3 data-i18n="documentation.contact_doc_impo">Contacto Documentación Importación</h3>
                        <p data-i18n="documentation.contact_doc_impo_desc">Para consultas o envíos sobre documentación
                            de importación:</p>
                        <a href="mailto:doc.import@grimaldi-bue.com.ar">doc.import@grimaldi-bue.com.ar</a>
                    </div>

                    <div class="contact-box">
                        <h3 data-i18n="documentation.contact_doc_expo">Contacto Documentación Exportación</h3>
                        <p data-i18n="documentation.contact_doc_expo_desc">Para consultas o envíos sobre documentación
                            de exportación:</p>
                        <a href="mailto:doc.export@grimaldi-bue.com.ar">doc.export@grimaldi-bue.com.ar</a>
                    </div>

                    <div class="contact-box">
                        <h3 data-i18n="documentation.contact_finance">Contacto Caja</h3>
                        <p data-i18n="documentation.contact_finance_desc">Para solicitar gastos locales a:</p>
                        <a href="mailto:finance@grimaldi-bue.com.ar">finance@grimaldi-bue.com.ar</a>
                    </div>

                    <div class="contact-box">
                        <h3 data-i18n="documentation.contact_equipment">Contacto Equipment & Claims</h3>
                        <p data-i18n="documentation.contact_equipment_desc">Para solicitud de inspección o iniciar
                            reclamo por daños:</p>
                        <a href="mailto:claims@grimaldi-bue.com.ar">claims@grimaldi-bue.com.ar</a>
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

    <!-- Page Specific JS: Filtering -->
    <script src="<?php echo JS_URL; ?>/documentacion.js" defer></script>
</body>

</html>
