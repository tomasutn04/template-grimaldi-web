<?php
// views/rrhh_dashboard.php
if (!defined('is_logged_in')) exit;

$stats = ['empleados' => 0, 'vacantes' => 0, 'postulantes' => 0];
try {
    $stats['empleados'] = $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn();
    $stats['vacantes'] = $pdo->query("SELECT COUNT(*) FROM vacancies WHERE estado = 1")->fetchColumn();
    $stats['postulantes'] = $pdo->query("SELECT COUNT(*) FROM applicants WHERE estado = 'nuevo'")->fetchColumn();
} catch (\PDOException $e) { /* Silencioso en dashboard */ }
?>
<div style="display: flex; gap: 20px;">
    <!-- Resumen -->
    <div class="card" style="flex: 1; text-align: center; border-top: 4px solid #17a2b8;">
        <h3>Staff Activo</h3>
        <p style="font-size: 2em; font-weight: bold; margin: 10px 0; color: #17a2b8;"><?php echo $stats['empleados']; ?></p>
        <a href="?section=rrhh&action=empleados" style="color: #666; text-decoration: none;">Ver Directorio</a>
    </div>

    <div class="card" style="flex: 1; text-align: center; border-top: 4px solid #00458a;">
        <h3>Vacantes Abiertas</h3>
        <p style="font-size: 2em; font-weight: bold; margin: 10px 0; color: #00458a;"><?php echo $stats['vacantes']; ?></p>
        <a href="?section=rrhh&action=vacantes" style="color: #666; text-decoration: none;">Gestionar Vacantes</a>
    </div>

    <div class="card" style="flex: 1; text-align: center; border-top: 4px solid #28a745;">
        <h3>Nuevos CVs Recibidos</h3>
        <p style="font-size: 2em; font-weight: bold; margin: 10px 0; color: #28a745;"><?php echo $stats['postulantes']; ?></p>
        <a href="?section=rrhh&action=postulantes" style="color: #666; text-decoration: none;">Revisar Postulantes</a>
    </div>
</div>
