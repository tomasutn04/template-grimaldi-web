<?php
// includes/auth.php

// Configuraciones de compatibilidad máxima para hosting Ferozo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Regenerar ID de sesión periódicamente para evitar fijación
if (!isset($_SESSION['last_regeneration'])) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} else {
    $interval = 60 * 30; // 30 minutos
    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

// Funciones de validación
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: index.php');
        exit;
    }
}

function has_role($role) {
    if (!is_logged_in()) return false;
    // Si el usuario es admin_global, tiene acceso a todo.
    if ($_SESSION['user_role'] === 'admin_global') return true;
    
    return $_SESSION['user_role'] === $role;
}

function require_role($role) {
    if (!has_role($role)) {
        header('HTTP/1.0 403 Forbidden');
        die("Acceso Denegado: No tienes los permisos necesarios para ver esta sección.");
    }
}

// Protección CSRF
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        return true;
    }
    return false;
}
?>
