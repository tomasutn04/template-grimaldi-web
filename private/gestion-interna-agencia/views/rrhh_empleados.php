<?php
// views/rrhh_empleados.php
if (!defined('is_logged_in')) exit;

// Borrar Empleado
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if (!verify_csrf_token($_GET['csrf'] ?? '')) {
        $_SESSION['msj'] = 'Error: Token CSRF inválido al eliminar.';
    } else {
        try {
            $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
            $stmt->execute([$_GET['delete']]);
            $_SESSION['msj'] = 'Empleado dado de baja permanentemente.';
        } catch (\PDOException $e) {
            $_SESSION['msj'] = 'Error de base de datos SQL al eliminar.';
        }
    }
    header("Location: dashboard.php?section=rrhh&action=empleados");
    exit;
}

// Listar empleados agrupados por departamento o jerarquía
$empleados = [];
try {
    $empleados = $pdo->query("SELECT * FROM employees ORDER BY departamento ASC, jerarquia ASC, apellido ASC")->fetchAll();
} catch (\PDOException $e) { }

?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Directorio de Contactos (Staff Interno)</h3>
        <a href="?section=rrhh&action=empleados_form" style="background:var(--secondary-blue); color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">+ Alta Empleado</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f9f9f9; border-bottom: 2px solid #ccc;">
                <th style="padding: 10px;">Nombre Completo</th>
                <th style="padding: 10px;">Posición</th>
                <th style="padding: 10px;">Departamento</th>
                <th style="padding: 10px;">Contacto</th>
                <th style="padding: 10px;">Jerarquía</th>
                <th style="padding: 10px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($empleados)): ?>
                <tr><td colspan="6" style="padding: 15px; text-align:center;">No hay empleados registrados en la base de datos.</td></tr>
            <?php else: ?>
                <?php foreach ($empleados as $e): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px; font-weight: bold;"><?php echo htmlspecialchars(strtoupper($e['apellido']) . ', ' . $e['nombre']); ?></td>
                    <td style="padding: 10px; color: var(--secondary-blue);"><?php echo htmlspecialchars($e['puesto']); ?></td>
                    <td style="padding: 10px;">
                        <span style="background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 10px; font-size: 0.85em;">
                            <?php echo htmlspecialchars($e['departamento']); ?>
                        </span>
                    </td>
                    <td style="padding: 10px; font-size: 0.85em;">
                        <?php echo htmlspecialchars($e['email']); ?><br>
                        <?php echo htmlspecialchars($e['telefono'] ?? ''); ?>
                    </td>
                    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($e['jerarquia']); ?></td>
                    <td style="padding: 10px; font-size: 0.9em;">
                        <a href="?section=rrhh&action=empleados_form&edit=<?php echo $e['id']; ?>" style="color: #17a2b8; text-decoration: none; margin-right: 10px;">Modificar</a>
                        <a href="?section=rrhh&action=empleados&delete=<?php echo $e['id']; ?>&csrf=<?php echo generate_csrf_token(); ?>" onclick="return confirm('ATENCIÓN: Dar de baja eliminará al empleado del organigrama público. ¿Continuar?');" style="color: #d9534f; text-decoration: none;">Baja</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
