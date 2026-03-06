<?php
// views/rrhh.php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php';
require_role('rrhh');

$action = $_GET['action'] ?? 'dashboard';

// Helper de mensajes
$msj = '';
if (isset($_SESSION['msj'])) {
    $isError = strpos($_SESSION['msj'], 'Error') !== false;
    $msj = '<div class="alert ' . ($isError ? 'alert-error' : 'alert-success') . '">' . htmlspecialchars($_SESSION['msj']) . '</div>';
    unset($_SESSION['msj']);
}
?>

<div class="rrhh-hub">
    <!-- Sub-navigation for RRHH -->
    <nav class="rrhh-nav">
        <a href="?section=rrhh&action=dashboard" class="btn <?php echo $action === 'dashboard' ? 'btn-primary' : 'btn-secondary'; ?> btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
            Dashboard
        </a>
        <a href="?section=rrhh&action=empleados" class="btn <?php echo $action === 'empleados' ? 'btn-primary' : 'btn-secondary'; ?> btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            Directorio
        </a>
        <a href="?section=rrhh&action=vacantes" class="btn <?php echo $action === 'vacantes' ? 'btn-primary' : 'btn-secondary'; ?> btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z"/></svg>
            Vacantes
        </a>
        <a href="?section=rrhh&action=postulantes" class="btn <?php echo $action === 'postulantes' ? 'btn-primary' : 'btn-secondary'; ?> btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
            Postulaciones
        </a>
    </nav>
    
    <?php echo $msj; ?>

    <?php
    // =============== RUTEO DE SUB-SECCIONES RRHH ===============
    $allowed_actions = ['dashboard', 'empleados', 'empleados_form', 'vacantes', 'vacantes_form', 'postulantes'];
    if (in_array($action, $allowed_actions)) {
        $view_file = __DIR__ . '/rrhh_' . $action . '.php';
        if (file_exists($view_file)) {
            include $view_file;
        } else {
            echo '<div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                <h4>Sub-sección no disponible</h4>
                <p>Esta funcionalidad está en desarrollo.</p>
            </div>';
        }
    } else {
        echo '<div class="alert alert-error">Acción inválida.</div>';
    }
    ?>
</div>
