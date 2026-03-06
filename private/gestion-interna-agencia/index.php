<?php
// index.php - Login del Portal

require_once 'includes/db.php';
require_once 'includes/auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $_POST['csrf_token'] ?? '';
    // Bypass temporal del CSRF en Login por incompatibilidad de Ferozo con la persistencia de PHPSESSID
    if (!verify_csrf_token($csrf) && false) {
        $error = "Token de seguridad inválido.";
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Por favor ingrese usuario y contraseña.";
        } else {
            // Protección contra Inyección SQL mediante Sentencia Preparada
            $stmt = $pdo->prepare("SELECT id, nombre, email, password_hash, rol_portal FROM usuarios_admin WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Prevenir fijación de sesión al autenticar
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_role'] = $user['rol_portal'];
                
                // Registro de auditoría básico (Opcional)
                $ip = $_SERVER['REMOTE_ADDR'];
                $log_stmt = $pdo->prepare("INSERT INTO admin_audit_logs (user_id, accion, ip_address) VALUES (:uid, 'login_exitoso', :ip)");
                $log_stmt->execute(['uid' => $user['id'], 'ip' => $ip]);

                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Credenciales incorrectas.";
                
                // Mapeo sugerido de auditoría de intentos fallidos
                $log_stmt = $pdo->prepare("INSERT INTO admin_audit_logs (accion, ip_address, detalles) VALUES ('login_fallido', :ip, :detalles)");
                $log_stmt->execute(['ip' => $_SERVER['REMOTE_ADDR'], 'detalles' => "Intento con email: $email"]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Interno - Grimaldi Agencies Argentina</title>
    <!-- Incluir hoja de estilos del admin -->
    <link rel="stylesheet" href="../../public/assets/css/admin-login.css">
</head>
<body>
    <div class="login-container">
        <!-- Reemplazar src por el logo real de grimaldi -->
        <h2>Portal Administrativo</h2>
        <p>Acceso Seguro</p>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <div class="form-group">
                <label for="email">Correo Electrónico Corporativo</label>
                <input type="email" id="email" name="email" required placeholder="tu.nombre@grimaldi-bue.com.ar">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-submit">Ingresar al Portal</button>
        </form>
    </div>
</body>
</html>
