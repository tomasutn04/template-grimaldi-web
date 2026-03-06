<?php
/**
 * ============================================================
 *  Grimaldi Agencies Argentina — 500 Error Interno
 * ============================================================
 */
require_once __DIR__ . '/src/config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Error del Servidor | Grimaldi Agencies Argentina</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/img/grimaldi_bandera_azul.png">
    
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/variables.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/styles.css">
    <style>
        body, html { height: 100%; margin: 0; }
        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background-color: var(--ga-bg-subtle);
            padding: 2rem;
        }
        .error-code {
            font-size: 6rem;
            font-weight: 700;
            color: #EF4444; /* Rojo error */
            line-height: 1;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 1.5rem;
            color: var(--ga-text);
            margin-bottom: 0.5rem;
        }
        .error-desc {
            color: var(--ga-text-soft);
            max-width: 400px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div style="margin-bottom: 2rem;">
            <span class="ga-logo-flag" aria-hidden="true" style="font-size: 2rem; width: 48px; height: 48px;">G</span>
            <div style="display: inline-block; text-align: left; vertical-align: middle; margin-left: 0.5rem;">
                <div style="font-weight: 700; color: var(--ga-blue); font-size: 1.1rem; line-height: 1.1;">Grimaldi Agencies Argentina</div>
            </div>
        </div>
        
        <div class="error-code">500</div>
        <h1 class="error-title">Error Interno del Servidor</h1>
        <p class="error-desc">Ha ocurrido un problema inesperado en nuestros sistemas. Nuestro equipo técnico ha sido notificado para resolverlo lo antes posible.</p>
        
        <a href="<?php echo BASE_URL; ?>" class="ga-btn ga-btn--outline">Intentar Volver al Inicio</a>
    </div>
</body>
</html>
