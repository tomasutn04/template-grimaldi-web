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

<div class="stats-cards">
    <div class="stat-card stat-card--info">
        <h3>Staff Activo</h3>
        <div class="stat-value"><?php echo $stats['empleados']; ?></div>
        <a href="?section=rrhh&action=empleados">Ver Directorio</a>
    </div>

    <div class="stat-card">
        <h3>Vacantes Abiertas</h3>
        <div class="stat-value"><?php echo $stats['vacantes']; ?></div>
        <a href="?section=rrhh&action=vacantes">Gestionar Vacantes</a>
    </div>

    <div class="stat-card stat-card--success">
        <h3>Nuevos CVs Recibidos</h3>
        <div class="stat-value"><?php echo $stats['postulantes']; ?></div>
        <a href="?section=rrhh&action=postulantes">Revisar Postulantes</a>
    </div>
</div>
