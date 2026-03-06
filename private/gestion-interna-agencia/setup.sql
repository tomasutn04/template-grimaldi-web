-- =================================================================================
-- Guía de Configuración Inicial - Base de Datos: l0013963_gri
-- Portal Administrativo - Grimaldi Agencies Argentina
-- =================================================================================

-- 1. Crear la tabla de usuarios administrativos
CREATE TABLE IF NOT EXISTS usuarios_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol_portal ENUM('caja', 'cs', 'rrhh', 'documentacion', 'admin_global') NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_login TIMESTAMP NULL
);

-- 2. (Opcional) Crear la tabla de auditoría para registro de acciones
CREATE TABLE IF NOT EXISTS admin_audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    accion VARCHAR(100) NOT NULL,
    detalles TEXT NULL,
    ip_address VARCHAR(45) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios_admin(id) ON DELETE SET NULL
);

-- 3. Insertar usuarios iniciales
-- NOTA: Las contraseñas aquí están hasheadas usando password_hash() en PHP con PASSWORD_DEFAULT.
-- La contraseña por defecto para todas estas cuentas de prueba es: Temporal2026!

INSERT INTO usuarios_admin (nombre, email, password_hash, rol_portal) VALUES 
('Administrador Sistema', 'info@grimaldi-bue.com.ar', '$2y$10$wKxI5g4Xo1E/rF.DzvQyWeW7w8/2S0L49LzYpDqA7gP/k1oTkWz2C', 'admin_global'),
('Operador Caja', 'finance@grimaldi-bue.com.ar', '$2y$10$wKxI5g4Xo1E/rF.DzvQyWeW7w8/2S0L49LzYpDqA7gP/k1oTkWz2C', 'caja'),
('Operador CS', 'customerservice@grimaldi-bue.com.ar', '$2y$10$wKxI5g4Xo1E/rF.DzvQyWeW7w8/2S0L49LzYpDqA7gP/k1oTkWz2C', 'cs'),
('Recursos Humanos', 'ccorletti@grimaldi-bue.com.ar', '$2y$10$wKxI5g4Xo1E/rF.DzvQyWeW7w8/2S0L49LzYpDqA7gP/k1oTkWz2C', 'rrhh'),
('Documentación', 'docs@grimaldi-bue.com.ar', '$2y$10$wKxI5g4Xo1E/rF.DzvQyWeW7w8/2S0L49LzYpDqA7gP/k1oTkWz2C', 'documentacion');

-- ---------------------------------------------------------------------------------
-- INSTRUCCIONES DE USO PARA EL DBA / SYSADMIN:
-- 1. Accede a tu entorno de MySQL / phpMyAdmin.
-- 2. Selecciona la base de datos "l0013963_gri".
-- 3. Pega y ejecuta el script completo anterior.
-- 4. Una vez creado, puedes agregar usuarios vía PHP usando la función password_hash($pass, PASSWORD_DEFAULT).
-- 5. Si tienes un sistema de Tipo de Cambio, asegúrate de tener una tabla "tipo_cambio" a actualizar.
-- ---------------------------------------------------------------------------------
