<?php
// views/caja.php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php'; // Requerimos la conexión a BD

// Validar que el usuario tenga el rol requerido
require_role('caja');

$mensaje = '';

// Procesamiento de formulario (Guardar en MySQL)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dolar_valor'])) {
    $csrf = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf)) {
        $mensaje = "<div style='color:red;'>Token de seguridad inválido.</div>";
    } else {
        $nuevo_dolar = filter_input(INPUT_POST, 'dolar_valor', FILTER_VALIDATE_FLOAT);
        $nuevo_euro = filter_input(INPUT_POST, 'euro_valor', FILTER_VALIDATE_FLOAT);
        $nuevos_datos_bancarios = $_POST['datos_bancarios'] ?? '';
        
        if ($nuevo_dolar !== false && $nuevo_dolar > 0) {
            try {
                $pdo->beginTransaction();

                // 1. Insertar el nuevo tipo de cambio en el histórico
                $stmt = $pdo->prepare("INSERT INTO exchange_rates (moneda, valor, fecha_cotizacion, usuario_id) VALUES ('USD', :valord, CURDATE(), :uid)");
                $stmt->execute(['valord' => $nuevo_dolar, 'uid' => $_SESSION['user_id']]);

                if ($nuevo_euro) {
                    $stmt = $pdo->prepare("INSERT INTO exchange_rates (moneda, valor, fecha_cotizacion, usuario_id) VALUES ('EUR', :valore, CURDATE(), :uid)");
                    $stmt->execute(['valore' => $nuevo_euro, 'uid' => $_SESSION['user_id']]);
                }

                // 2. Actualizar la tabla de un solo registro para detalles bancarios
                $stmt = $pdo->prepare("UPDATE bank_details SET contenido_html = :contenido, actualizado_por = :uid WHERE id = 1");
                $stmt->execute([
                    'contenido' => htmlspecialchars($nuevos_datos_bancarios, ENT_QUOTES, 'UTF-8'),
                    'uid' => $_SESSION['user_id']
                ]);

                $pdo->commit();
                $mensaje = "<div style='color:green; padding: 10px; border: 1px solid green; border-radius: 4px; background: #e6ffe6;'>Cotización actualizada e impactada en la base de datos pública.</div>";

            } catch (\PDOException $e) {
                $pdo->rollBack();
                error_log($e->getMessage());
                $mensaje = "<div style='color:red;'>Error de base de datos al guardar la cotización.</div>";
            }
        } else {
            $mensaje = "<div style='color:red;'>Valor ingresado inválido. (Use \".\" para decimales)</div>";
        }
    }
}

// Cargar estado actual de BD para poblar el formulario
$data_actual = ['dolar_valor' => '', 'euro_valor' => '', 'datos_bancarios' => '', 'ultima_actualizacion' => '-'];

try {
    // Buscar dolar de hoy
    $stmtD = $pdo->query("SELECT valor FROM exchange_rates WHERE moneda = 'USD' AND fecha_cotizacion = CURDATE() ORDER BY creado_en DESC LIMIT 1");
    if ($row = $stmtD->fetch()) $data_actual['dolar_valor'] = $row['valor'];

    // Buscar euro de hoy
    $stmtE = $pdo->query("SELECT valor FROM exchange_rates WHERE moneda = 'EUR' AND fecha_cotizacion = CURDATE() ORDER BY creado_en DESC LIMIT 1");
    if ($row = $stmtE->fetch()) $data_actual['euro_valor'] = $row['valor'];

    // Buscar datos bancarios (fila 1 obligatoria)
    $stmtB = $pdo->query("SELECT contenido_html, ultima_actualizacion FROM bank_details WHERE id = 1");
    if ($row = $stmtB->fetch()) {
        $data_actual['datos_bancarios'] = htmlspecialchars_decode($row['contenido_html'], ENT_QUOTES);
        $data_actual['ultima_actualizacion'] = $row['ultima_actualizacion'];
    }

} catch (\PDOException $e) {
    $mensaje = "<div style='color:red;'>Advertencia: Las tablas de la base de datos no han sido creadas. Ejecute el <code>schema.sql</code>.</div>";
}

// Paginador e Histórico
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($page < 1) $page = 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$filtro_moneda = $_GET['moneda'] ?? '';
$where = "1=1";
$params = [];
if ($filtro_moneda === 'USD' || $filtro_moneda === 'EUR') {
    $where .= " AND e.moneda = :moneda";
    $params['moneda'] = $filtro_moneda;
}

// Contar totales para paginación
$historico = [];
$total_rows = 0;
try {
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM exchange_rates e WHERE $where");
    $stmtCount->execute($params);
    $total_rows = $stmtCount->fetchColumn();

    $sqlHist = "SELECT e.id, e.moneda, e.valor, e.fecha_cotizacion, e.creado_en, u.nombre AS autor 
                FROM exchange_rates e 
                LEFT JOIN usuarios_admin u ON e.usuario_id = u.id 
                WHERE $where 
                ORDER BY e.creado_en DESC LIMIT $limit OFFSET $offset";
    $stmtHist = $pdo->prepare($sqlHist);
    $stmtHist->execute($params);
    $historico = $stmtHist->fetchAll();
} catch (\PDOException $e) {
    // Silencioso; si no existe la tabla ya lo advirtió arriba.
}
$total_pages = ceil($total_rows / $limit);
?>

<div class="layout-flexible" style="display:flex; gap: 20px;">
    <!-- Formulario Principal -->
    <div class="card" style="flex: 1;">
        <h2>Gestión de Tipo de Cambio</h2>
        <p>Solo visible entre 09:00 y 17:00 hs (Lunes a Viernes) para el público.</p>
        
        <?php echo $mensaje; ?>

        <form method="POST" action="?section=caja">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div style="margin-bottom: 15px;">
                <label for="dolar_valor" style="display:block; margin-bottom:5px; font-weight: 600;">Cotización DÓLAR para hoy (<?php echo date('d/m/Y'); ?>):</label>
                <input type="number" step="0.01" id="dolar_valor" name="dolar_valor" value="<?php echo htmlspecialchars($data_actual['dolar_valor']); ?>" required style="padding: 10px; width: 100%; border-radius:4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="euro_valor" style="display:block; margin-bottom:5px; font-weight: 600;">Cotización EURO (Opcional):</label>
                <input type="number" step="0.01" id="euro_valor" name="euro_valor" value="<?php echo htmlspecialchars($data_actual['euro_valor']); ?>" style="padding: 10px; width: 100%; border-radius:4px; border: 1px solid #ccc;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="datos_bancarios" style="display:block; margin-bottom:5px; font-weight: 600;">Datos Bancarios / Instrucciones:</label>
                <textarea id="datos_bancarios" name="datos_bancarios" required style="padding: 10px; width: 100%; height: 100px; border-radius:4px; border: 1px solid #ccc; font-family: inherit;"><?php echo htmlspecialchars($data_actual['datos_bancarios']); ?></textarea>
            </div>

            <button type="submit" style="background-color: var(--secondary-blue); color: white; padding: 12px; width:100%; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Publicar Cotización
            </button>
        </form>
        
        <div style="margin-top:20px; font-size: 0.85rem; color: #666;">
            Última actualización general: <?php echo htmlspecialchars($data_actual['ultima_actualizacion']); ?>
        </div>
    </div>

    <!-- Histórico Data Table -->
    <div class="card" style="flex: 2;">
        <h3>Histórico de Cargas</h3>
        
        <!-- Filtros Rápidos -->
        <form method="GET" action="dashboard.php" style="margin-bottom: 15px; display:flex; gap: 10px; align-items:center;">
            <input type="hidden" name="section" value="caja">
            <select name="moneda" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                <option value="">Todas las Divisas</option>
                <option value="USD" <?php echo $filtro_moneda === 'USD' ? 'selected' : ''; ?>>Dólar (USD)</option>
                <option value="EUR" <?php echo $filtro_moneda === 'EUR' ? 'selected' : ''; ?>>Euro (EUR)</option>
            </select>
            <button type="submit" style="background:var(--secondary-blue); color:white; border:none; padding:8px 15px; border-radius:4px;">Filtrar</button>
        </form>

        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #ccc; background: #f9f9f9;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Moneda</th>
                    <th style="padding: 10px;">Valor</th>
                    <th style="padding: 10px;">Fecha Cot.</th>
                    <th style="padding: 10px;">Cargado (Hora)</th>
                    <th style="padding: 10px;">Responsable</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historico)): ?>
                    <tr><td colspan="6" style="padding: 15px; text-align:center;">No hay registros históricos.</td></tr>
                <?php else: ?>
                    <?php foreach ($historico as $h): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">#<?php echo $h['id']; ?></td>
                        <td style="padding: 10px;"><strong style="color: <?php echo $h['moneda'] === 'USD' ? '#28a745' : '#17a2b8'; ?>;"><?php echo $h['moneda']; ?></strong></td>
                        <td style="padding: 10px; font-family: monospace;">$<?php echo number_format($h['valor'], 2); ?></td>
                        <td style="padding: 10px;"><?php echo date('d/m/Y', strtotime($h['fecha_cotizacion'])); ?></td>
                        <td style="padding: 10px; font-size: 0.85em; color: #555;"><?php echo date('d/m/Y H:i', strtotime($h['creado_en'])); ?></td>
                        <td style="padding: 10px;"><?php echo htmlspecialchars($h['autor'] ?? 'Desconocido'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Paginación Simple -->
        <?php if ($total_pages > 1): ?>
        <div style="margin-top: 15px; display:flex; gap: 5px; justify-content:center;">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?section=caja&moneda=<?php echo $filtro_moneda; ?>&p=<?php echo $i; ?>" style="padding: 5px 10px; background: <?php echo $i == $page ? 'var(--secondary-blue)' : '#eee'; ?>; color: <?php echo $i == $page ? '#fff' : '#333'; ?>; text-decoration:none; border-radius:3px;">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>

    </div>
</div>
