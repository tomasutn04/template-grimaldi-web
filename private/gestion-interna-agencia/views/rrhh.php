<?php
// views/rrhh.php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php';
require_role('rrhh');

$action = $_GET['action'] ?? 'dashboard';

// Helper de mensajes
$msj = '';
if (isset($_SESSION['msj'])) {
    $tipo = strpos($_SESSION['msj'], 'Error') !== false ? 'red' : 'green';
    $msj = "<div style='color:{$tipo}; padding: 10px; border: 1px solid {$tipo}; border-radius: 4px; background: " . ($tipo === 'green' ? '#e6ffe6' : '#ffe6e6') . "; margin-bottom: 20px;'>{$_SESSION['msj']}</div>";
    unset($_SESSION['msj']);
}
?>

<div class="rrhh-hub">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Módulo de Recursos Humanos (RRHH)</h2>
        <div>
            <a href="?section=rrhh&action=dashboard" style="background:#0b2240; color:white; padding:8px 15px; text-decoration:none; border-radius:4px; margin-right: 5px;">Dashboard</a>
            <a href="?section=rrhh&action=empleados" style="background:#17a2b8; color:white; padding:8px 15px; text-decoration:none; border-radius:4px; margin-right: 5px;">Directorio (Staff)</a>
            <a href="?section=rrhh&action=vacantes" style="background:#00458a; color:white; padding:8px 15px; text-decoration:none; border-radius:4px; margin-right: 5px;">Vacantes</a>
            <a href="?section=rrhh&action=postulantes" style="background:#28a745; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">Postulaciones</a>
        </div>
    </div>
    
    <?php echo $msj; ?>

    <?php
    // =============== RUTEO DE SUB-SECCIONES RRHH ===============
    $allowed_actions = ['dashboard', 'empleados', 'empleados_form', 'vacantes', 'vacantes_form', 'postulantes'];
    if (in_array($action, $allowed_actions)) {
        $view_file = __DIR__ . '/rrhh_' . $action . '.php';
        if (file_exists($view_file)) {
            include $view_file;
        } else {
            echo "<div class='card'>La sub-sección solicitada no está implementada aún.</div>";
        }
    } else {
        echo "<div class='card'>Acción inválida.</div>";
    }
    ?>
</div>
