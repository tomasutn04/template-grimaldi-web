<?php
// dashboard.php - Ruteador Principal del Portal

require_once 'includes/auth.php';

// Exigir login para ver esta página
require_login();

// Obtener sección actual desde query param
$section = $_GET['section'] ?? '';

// Definir permisos por rol (RBAC)
$permissions = [
    'caja' => ['caja'],
    'cs' => ['cs'],
    'rrhh' => ['rrhh'],
    'documentacion' => ['docs'],
    'admin_global' => ['caja', 'cs', 'rrhh', 'docs'] // El admin accede a todo
];

$user_role = $_SESSION['user_role'] ?? 'invitado';

if ($section && in_array($section, $permissions[$user_role])) {
    $view = $section;
} else {
    // Vista por defecto basada en el rol
    if ($user_role === 'caja') $view = 'caja';
    elseif ($user_role === 'cs') $view = 'cs';
    elseif ($user_role === 'rrhh') $view = 'rrhh';
    elseif ($user_role === 'documentacion') $view = 'docs';
    else $view = 'bienvenida'; // Vista fallback
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Grimaldi Agencies</title>
    <link rel="stylesheet" href="../../public/assets/css/admin-dashboard.css">
</head>
<body>

    <!-- Sidebar de Navegación Basado en Rol -->
    <aside class="sidebar">
        <h3>Portal Grimaldi</h3>
        <ul>
            <?php if (has_role('caja')): ?>
                <li><a href="?section=caja" class="<?php echo $view === 'caja' ? 'active' : ''; ?>">Tipo de Cambio</a></li>
            <?php endif; ?>
            
            <?php if (has_role('cs')): ?>
                <li><a href="?section=cs" class="<?php echo $view === 'cs' ? 'active' : ''; ?>">Schedules (Excel)</a></li>
            <?php endif; ?>

            <?php if (has_role('rrhh')): ?>
                <li><a href="?section=rrhh" class="<?php echo $view === 'rrhh' ? 'active' : ''; ?>">Gestión de RRHH</a></li>
            <?php endif; ?>

            <?php if (has_role('documentacion')): ?>
                <li><a href="?section=docs" class="<?php echo $view === 'docs' ? 'active' : ''; ?>">Documentación Oficial</a></li>
            <?php endif; ?>
            
            <?php if ($user_role === 'admin_global'): ?>
                <!-- El admin ve todas -->
                <li><a href="?section=caja" class="<?php echo $view === 'caja' ? 'active' : ''; ?>">Tipo de Cambio</a></li>
                <li><a href="?section=cs" class="<?php echo $view === 'cs' ? 'active' : ''; ?>">Schedules</a></li>
                <li><a href="?section=rrhh" class="<?php echo $view === 'rrhh' ? 'active' : ''; ?>">RRHH</a></li>
                <li><a href="?section=docs" class="<?php echo $view === 'docs' ? 'active' : ''; ?>">Documentación</a></li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Área de Contenido -->
    <main class="main-content">
        <header class="header">
            <div class="user-info">
                Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 
                <small>(Rol: <?php echo htmlspecialchars($user_role); ?>)</small>
            </div>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </header>

        <div class="view-container">
            <?php
            // Ruteador para inyectar la vista correspondiente
            $view_file = 'views/' . $view . '.php';
            if (file_exists($view_file)) {
                include $view_file;
            } else {
                echo "<h3>Bienvenido al Portal</h3>";
                echo "<p>Seleccione una opción del menú lateral para comenzar.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
