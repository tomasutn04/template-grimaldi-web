<?php
// views/rrhh_vacantes.php
if (!defined('is_logged_in')) exit;

// Borrar Vacante
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if (!verify_csrf_token($_GET['csrf'] ?? '')) {
        $_SESSION['msj'] = 'Error: Token CSRF inválido al eliminar.';
    } else {
        try {
            $stmt = $pdo->prepare("DELETE FROM vacancies WHERE id = ?");
            $stmt->execute([$_GET['delete']]);
            $_SESSION['msj'] = 'Vacante eliminada permanentemente.';
        } catch (\PDOException $e) {
            $_SESSION['msj'] = 'Error de base de datos SQL al eliminar. Probablemente existan postulantes adheridos a ella.';
        }
    }
    header("Location: dashboard.php?section=rrhh&action=vacantes");
    exit;
}

// Toggle Estado (Abrir/Cerrar)
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    if (!verify_csrf_token($_GET['csrf'] ?? '')) {
        $_SESSION['msj'] = 'Error: Token CSRF inválido.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE vacancies SET estado = NOT estado WHERE id = ?");
            $stmt->execute([$_GET['toggle']]);
            $_SESSION['msj'] = 'Estado de vacante alterado con éxito.';
        } catch (\PDOException $e) {
             $_SESSION['msj'] = 'Error al cambiar estado.';
        }
    }
    header("Location: dashboard.php?section=rrhh&action=vacantes");
    exit;
}

// Listar
$vacantes = [];
try {
    $vacantes = $pdo->query("SELECT * FROM vacancies ORDER BY creado_en DESC")->fetchAll();
} catch (\PDOException $e) { }

?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Gestión de Vacantes Web</h3>
        <a href="?section=rrhh&action=vacantes_form" style="background:var(--secondary-blue); color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">+ Nueva Búsqueda</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f9f9f9; border-bottom: 2px solid #ccc;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Título</th>
                <th style="padding: 10px;">Depto.</th>
                <th style="padding: 10px;">Ubicación</th>
                <th style="padding: 10px;">Estado Público</th>
                <th style="padding: 10px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($vacantes)): ?>
                <tr><td colspan="6" style="padding: 15px; text-align:center;">No hay vacantes registradas.</td></tr>
            <?php else: ?>
                <?php foreach ($vacantes as $v): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">#<?php echo $v['id']; ?></td>
                    <td style="padding: 10px; font-weight: 500; color: var(--primary-blue);"><?php echo htmlspecialchars($v['titulo']); ?></td>
                    <td style="padding: 10px;"><?php echo htmlspecialchars($v['departamento']); ?></td>
                    <td style="padding: 10px;"><?php echo htmlspecialchars($v['ubicacion']); ?></td>
                    <td style="padding: 10px;">
                        <?php if ($v['estado']): ?>
                            <span style="background: #e6ffe6; color: #28a745; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; font-weight: bold;">ABIERTA</span>
                        <?php else: ?>
                            <span style="background: #ffe6e6; color: #d9534f; padding: 4px 8px; border-radius: 12px; font-size: 0.8em; font-weight: bold;">CERRADA</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 10px; font-size: 0.9em;">
                        <a href="?section=rrhh&action=vacantes_form&edit=<?php echo $v['id']; ?>" style="color: #17a2b8; text-decoration: none; margin-right: 10px;">Editar</a>
                        <a href="?section=rrhh&action=vacantes&toggle=<?php echo $v['id']; ?>&csrf=<?php echo generate_csrf_token(); ?>" style="color: #666; text-decoration: none; margin-right: 10px;">Alternar Estado</a>
                        <a href="?section=rrhh&action=vacantes&delete=<?php echo $v['id']; ?>&csrf=<?php echo generate_csrf_token(); ?>" onclick="return confirm('¿Seguro que desea eliminar esta vacante?');" style="color: #d9534f; text-decoration: none;">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
