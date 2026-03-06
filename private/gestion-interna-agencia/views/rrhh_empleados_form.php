<?php
// views/rrhh_empleados_form.php
if (!defined('is_logged_in')) exit;

$id = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$empleado = [
    'nombre' => '',
    'apellido' => '',
    'puesto' => '',
    'departamento' => '',
    'email' => '',
    'telefono' => '',
    'jerarquia' => 10
];
$accion = 'Alta';

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $empleado = $row;
            $accion = 'Modificar';
        } else {
            $_SESSION['msj'] = 'Error: Empleado no encontrado.';
            header("Location: dashboard.php?section=rrhh&action=empleados");
            exit;
        }
    } catch (\PDOException $e) {}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = "Token CSRF inválido.";
    } else {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $puesto = trim($_POST['puesto']);
        $departamento = trim($_POST['departamento']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $jerarquia = (int)$_POST['jerarquia'];

        try {
            if ($id > 0) {
                // Update
                $stmt = $pdo->prepare("UPDATE employees SET nombre=?, apellido=?, puesto=?, departamento=?, email=?, telefono=?, jerarquia=? WHERE id=?");
                $stmt->execute([$nombre, $apellido, $puesto, $departamento, $email, $telefono, $jerarquia, $id]);
                $_SESSION['msj'] = 'Datos del empleado actualizados en la estructura pública.';
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO employees (nombre, apellido, puesto, departamento, email, telefono, jerarquia) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nombre, $apellido, $puesto, $departamento, $email, $telefono, $jerarquia]);
                $_SESSION['msj'] = 'Directorio actualizado. El empleado ya aparece en la web pública.';
            }
            header("Location: dashboard.php?section=rrhh&action=empleados");
            exit;
        } catch (\PDOException $e) {
            $error = "Error al guardar en la base de datos.";
        }
    }
}
?>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3><?php echo $accion; ?> Empleado (Staff)</h3>
        <a href="?section=rrhh&action=empleados" style="color: #666; text-decoration: none;">Volver al Directorio</a>
    </div>

    <?php if (isset($error)): ?>
        <div style="color:red; padding: 10px; border: 1px solid red; background:#ffe6e6; margin-bottom:15px;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        
        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Nombre/s *</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Apellido/s *</label>
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($empleado['apellido']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 2;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Puesto Administrativo *</label>
                <input type="text" name="puesto" value="<?php echo htmlspecialchars($empleado['puesto']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Departamento *</label>
                <select name="departamento" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
                    <?php 
                        $deptos = ['gerencia-general' => 'Gerencia General', 'comercial' => 'Comercial', 'exportacion' => 'Exportación', 'importacion' => 'Importación', 'operaciones' => 'Operaciones', 'administracion' => 'Administración / Legales', 'recepcion' => 'Recepción'];
                        foreach ($deptos as $slug => $nom) {
                            $sel = ($empleado['departamento'] == $slug) ? 'selected' : '';
                            echo "<option value=\"$slug\" $sel>$nom</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Teléfono Web (Conmutador/Interno)</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($empleado['telefono']); ?>" placeholder="Ej: +54 11 4310-4400" style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Email Corporativo *</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
        </div>
        
        <div style="margin-bottom: 25px;">
            <label style="display:block; font-weight: bold; margin-bottom: 5px;">Orden de Jerarquía Visual</label>
            <input type="number" name="jerarquia" value="<?php echo htmlspecialchars($empleado['jerarquia']); ?>" required style="padding: 10px; width: 150px; border-radius: 4px; border: 1px solid #ccc;">
            <span style="font-size:0.85em; color:#666; margin-left: 10px;">Menor número aparece primero en la página de Contactos (Ej: 1 = Gral. Manager, 10 = Empleado base).</span>
        </div>

        <button type="submit" style="background-color: var(--secondary-blue); color: white; padding: 12px 25px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
            <?php echo $accion === 'Alta' ? 'Dar de Alta' : 'Guardar Cambios'; ?>
        </button>
    </form>
</div>
