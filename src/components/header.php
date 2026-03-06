<?php require_once __DIR__ . '/../config/config.php'; ?>
<!-- CSS Inyectado dinámicamente usando las rutas base calculadas -->
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/variables.css">
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/base.css">
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/layout.css">
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/components.css">
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/header.css">
<link rel="stylesheet" href="<?php echo CSS_URL; ?>/footer.css">

<!-- GRIMALDI HEADER COMPONENT -->
<header class="grimaldi-header" role="banner">
  <div class="header-inner">
    <div class="header-logo">
      <a href="<?php echo BASE_URL; ?>" aria-label="Grimaldi Agencies Argentina - Inicio">
        <img src="<?php echo ASSETS_URL; ?>/img/GGroup-orizzontale-blu.png" alt="Grimaldi Group Logo" width="180" height="42">
      </a>
    </div>

    <button class="nav-toggle" aria-label="Abrir menú de navegación" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="header-nav" role="navigation" aria-label="Navegación principal">
      <a href="<?php echo BASE_URL; ?>" class="active" data-i18n="nav.home">Inicio</a>
      <a href="<?php echo BASE_URL; ?>tipo-de-cambio" data-i18n="nav.exchange">Tipo de Cambio</a>
      <a href="<?php echo BASE_URL; ?>schedule" data-i18n="nav.schedule">Schedule</a>
      <a href="<?php echo BASE_URL; ?>documentacion" data-i18n="nav.documentation">Documentación</a>
      <a href="<?php echo BASE_URL; ?>servicios" data-i18n="nav.services">Servicios y Comercial</a>
      <a href="<?php echo BASE_URL; ?>institucional" data-i18n="nav.institutional">Institucional</a>
      <a href="<?php echo BASE_URL; ?>contacto" data-i18n="nav.contact">Contacto</a>

      <div class="lang-selector" aria-label="Selector de idioma">
        <button data-lang="es" class="active" title="Español">ES</button>
        <button data-lang="en" title="English">EN</button>
        <button data-lang="it" title="Italiano">IT</button>
        <button data-lang="pt" title="Português">PT</button>
      </div>
    </nav>
  </div>
  <div class="nav-overlay" aria-hidden="true"></div>
</header>
