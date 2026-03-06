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

// Mapeo de nombres de sección para mostrar
$section_names = [
    'caja' => 'Tipo de Cambio',
    'cs' => 'Customer Service',
    'rrhh' => 'Recursos Humanos',
    'docs' => 'Documentación',
    'bienvenida' => 'Dashboard'
];

// Mapeo de iconos por sección
$section_icons = [
    'caja' => '<svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>',
    'cs' => '<svg viewBox="0 0 24 24"><path d="M20 8h-3V6c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10h20V10c0-1.1-.9-2-2-2zM9 6h6v2H9V6zm11 12H4v-3h2v1h2v-1h8v1h2v-1h2v3zm0-5h-2v-1h-2v1H8v-1H6v1H4v-3h16v3z"/></svg>',
    'rrhh' => '<svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
    'docs' => '<svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>'
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $section_names[$view] ?? 'Dashboard'; ?> - Grimaldi Agencies</title>
    <link rel="stylesheet" href="../../css/variables.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
</head>
<body>

    <!-- Mobile Menu Toggle -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar de Navegación Basado en Rol -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <svg viewBox="0 0 24 24" class="logo-icon">
                    <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10h20V10c0-1.1-.9-2-2-2zM9 6h6v2H9V6zm11 12H4v-3h2v1h2v-1h8v1h2v-1h2v3z"/>
                </svg>
                <div class="logo-text">
                    <span class="logo-title">Grimaldi</span>
                    <span class="logo-subtitle">Portal Interno</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <span class="nav-section-title">Módulos</span>
                <ul class="nav-list">
                    <?php if (has_role('caja') || $user_role === 'admin_global'): ?>
                        <li>
                            <a href="?section=caja" class="nav-link <?php echo $view === 'caja' ? 'active' : ''; ?>">
                                <span class="nav-icon"><?php echo $section_icons['caja']; ?></span>
                                <span class="nav-text">Tipo de Cambio</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if (has_role('cs') || $user_role === 'admin_global'): ?>
                        <li>
                            <a href="?section=cs" class="nav-link <?php echo $view === 'cs' ? 'active' : ''; ?>">
                                <span class="nav-icon"><?php echo $section_icons['cs']; ?></span>
                                <span class="nav-text">Schedules</span>
                                <span class="nav-badge">CS</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (has_role('rrhh') || $user_role === 'admin_global'): ?>
                        <li>
                            <a href="?section=rrhh" class="nav-link <?php echo $view === 'rrhh' ? 'active' : ''; ?>">
                                <span class="nav-icon"><?php echo $section_icons['rrhh']; ?></span>
                                <span class="nav-text">Recursos Humanos</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (has_role('documentacion') || $user_role === 'admin_global'): ?>
                        <li>
                            <a href="?section=docs" class="nav-link <?php echo $view === 'docs' ? 'active' : ''; ?>">
                                <span class="nav-icon"><?php echo $section_icons['docs']; ?></span>
                                <span class="nav-text">Documentación</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div class="sidebar-footer">
            <a href="../../" class="nav-link nav-link--subtle">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24"><path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/></svg>
                </span>
                <span class="nav-text">Ir al Sitio Web</span>
            </a>
        </div>
    </aside>

    <!-- Overlay para mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Área de Contenido Principal -->
    <main class="main-content">
        <!-- Header Superior -->
        <header class="top-header">
            <div class="header-left">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <span class="breadcrumb-item">Portal</span>
                    <span class="breadcrumb-separator">/</span>
                    <span class="breadcrumb-item active"><?php echo $section_names[$view] ?? 'Dashboard'; ?></span>
                </nav>
            </div>
            <div class="header-right">
                <div class="user-dropdown">
                    <button class="user-btn" id="userDropdownBtn">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($_SESSION['user_name'], 0, 2)); ?>
                        </div>
                        <div class="user-info">
                            <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                            <span class="user-role"><?php echo ucfirst(str_replace('_', ' ', $user_role)); ?></span>
                        </div>
                        <svg class="dropdown-arrow" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div class="dropdown-menu" id="userDropdownMenu">
                        <a href="logout.php" class="dropdown-item dropdown-item--danger">
                            <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido de la Vista -->
        <div class="view-container">
            <div class="view-header">
                <h1 class="view-title"><?php echo $section_names[$view] ?? 'Dashboard'; ?></h1>
                <p class="view-subtitle">
                    <?php
                    $subtitles = [
                        'caja' => 'Gestiona las cotizaciones de divisas para el público',
                        'cs' => 'Administra itinerarios y publica noticias',
                        'rrhh' => 'Gestiona empleados, vacantes y postulantes',
                        'docs' => 'Administra los formularios disponibles para clientes',
                        'bienvenida' => 'Seleccione un módulo del menú para comenzar'
                    ];
                    echo $subtitles[$view] ?? '';
                    ?>
                </p>
            </div>

            <div class="view-content">
                <?php
                // Ruteador para inyectar la vista correspondiente
                $view_file = 'views/' . $view . '.php';
                if (file_exists($view_file)) {
                    include $view_file;
                } else {
                    ?>
                    <div class="welcome-grid">
                        <div class="welcome-card">
                            <div class="welcome-icon">
                                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            </div>
                            <h3>Bienvenido al Portal</h3>
                            <p>Sistema de gestión interna de Grimaldi Agencies Argentina</p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>

    <script>
    // Toggle Sidebar en Mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        sidebarOverlay.classList.toggle('active');
        this.classList.toggle('active');
    });

    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
        sidebarToggle.classList.remove('active');
    });

    // User Dropdown
    const userDropdownBtn = document.getElementById('userDropdownBtn');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userDropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdownMenu.classList.toggle('open');
    });

    document.addEventListener('click', function() {
        userDropdownMenu.classList.remove('open');
    });
    </script>
</body>
</html>
