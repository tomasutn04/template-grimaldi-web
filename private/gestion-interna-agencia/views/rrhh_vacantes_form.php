<?php
// views/rrhh_vacantes_form.php
if (!defined('is_logged_in')) exit;

$id = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$vacante = [
    'titulo' => '',
    'departamento' => '',
    'ubicacion' => '',
    'descripcion' => '',
    'requisitos' => '',
    'estado' => 1
];
$accion = 'Crear';

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM vacancies WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $vacante = $row;
            $accion = 'Editar';
        } else {
            $_SESSION['msj'] = 'Error: Vacante no encontrada.';
            header("Location: dashboard.php?section=rrhh&action=vacantes");
            exit;
        }
    } catch (\PDOException $e) {}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = "Token CSRF inválido.";
    } else {
        $titulo = trim($_POST['titulo']);
        $departamento = trim($_POST['departamento']);
        $ubicacion = trim($_POST['ubicacion']);
        $descripcion = trim($_POST['descripcion']);
        $requisitos = trim($_POST['requisitos']);
        $estado = isset($_POST['estado']) ? 1 : 0;

        try {
            if ($id > 0) {
                // Update
                $stmt = $pdo->prepare("UPDATE vacancies SET titulo=?, departamento=?, ubicacion=?, descripcion=?, requisitos=?, estado=? WHERE id=?");
                $stmt->execute([$titulo, $departamento, $ubicacion, $descripcion, $requisitos, $estado, $id]);
                $_SESSION['msj'] = 'Vacante actualizada con éxito.';
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO vacancies (titulo, departamento, ubicacion, descripcion, requisitos, estado) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$titulo, $departamento, $ubicacion, $descripcion, $requisitos, $estado]);
                $_SESSION['msj'] = 'Nueva vacante publicada con éxito.';
            }
            header("Location: dashboard.php?section=rrhh&action=vacantes");
            exit;
        } catch (\PDOException $e) {
            $error = "Error al guardar en la base de datos.";
        }
    }
}
?>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3><?php echo $accion; ?> Vacante</h3>
        <a href="?section=rrhh&action=vacantes" style="color: #666; text-decoration: none;">Volver al listado</a>
    </div>

    <?php if (isset($error)): ?>
        <div style="color:red; padding: 10px; border: 1px solid red; background:#ffe6e6; margin-bottom:15px;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        
        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 2;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Título de la Búsqueda *</label>
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($vacante['titulo']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-weight: bold; margin-bottom: 5px;">Departamento *</label>
                <input type="text" name="departamento" value="<?php echo htmlspecialchars($vacante['departamento']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight: bold; margin-bottom: 5px;">Ubicación (Ej. CABA, Retiro) *</label>
            <input type="text" name="ubicacion" value="<?php echo htmlspecialchars($vacante['ubicacion']); ?>" required style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight: bold; margin-bottom: 5px;">Descripción General del Puesto *</label>
            <textarea name="descripcion" required rows="5" style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc; font-family: inherit;"><?php echo htmlspecialchars($vacante['descripcion']); ?></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight: bold; margin-bottom: 5px;">Requisitos Excluyentes (Opcional)</label>
            <textarea name="requisitos" rows="3" style="padding: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc; font-family: inherit;"><?php echo htmlspecialchars($vacante['requisitos']); ?></textarea>
        </div>

        <div style="margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" id="estado" name="estado" value="1" <?php echo $vacante['estado'] ? 'checked' : ''; ?> style="width: 20px; height: 20px;">
            <label for="estado" style="font-weight: bold; cursor: pointer;">Publicar inmediatamente (Visible en la web)</label>
        </div>

        <button type="submit" style="background-color: var(--secondary-blue); color: white; padding: 12px 25px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
            <?php echo $accion === 'Crear' ? 'Crear Vacante' : 'Guardar Cambios'; ?>
        </button>
    </form>
</div>
