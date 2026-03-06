<?php
/**
 * API Endpoint PÚBLICO: Tipo de Cambio
 * GET /public/api/tipo_cambio.php
 * Regla de negocio: Solo devuelve datos si es L-V, entre 09:00 y 17:00, y si el valor de "hoy" existe
 */

require_once dirname(__DIR__, 2) . '/core/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método HTTP no permitido.']);
    exit;
}

// 1. Validación de Horario Comercial (Lunes a Viernes, 09:00 a 17:00 hs)
$hora_actual = (int)date('H');
$dia_semana = (int)date('N'); // 1 = Lunes, 7 = Domingo

if ($dia_semana >= 6 || $hora_actual < 9 || $hora_actual >= 17) {
    echo json_encode([
        'status' => 'cerrado', 
        'mensaje' => 'El servicio de consulta de tipo de cambio opera de lunes a viernes de 09:00 a 17:00 hs.',
        'data' => null
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // 2. Extraer datos del día EN CURSO de MySQL
    
    // Obtener último USD de hoy
    $stmtUSD = $pdo->query("SELECT valor, creado_en FROM exchange_rates WHERE moneda = 'USD' AND fecha_cotizacion = CURDATE() ORDER BY creado_en DESC LIMIT 1");
    $usd_row = $stmtUSD->fetch();

    if (!$usd_row) {
        // No hay dólar publicado hoy
        echo json_encode([
            'status' => 'no_disponible', 
            'mensaje' => 'Tipo de cambio para el día de la fecha aún no disponible.',
            'data' => null
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $dolar_valor = $usd_row['valor'];
    $ultima_actualizacion = $usd_row['creado_en']; // Usamos la hora a la que se cargó el dólar

    // Obtener último EUR de hoy (opcional)
    $stmtEUR = $pdo->query("SELECT valor FROM exchange_rates WHERE moneda = 'EUR' AND fecha_cotizacion = CURDATE() ORDER BY creado_en DESC LIMIT 1");
    $eur_row = $stmtEUR->fetch();
    $euro_valor = $eur_row ? $eur_row['valor'] : '';

    // Obtener datos bancarios
    $stmtBank = $pdo->query("SELECT contenido_html FROM bank_details WHERE id = 1");
    $bank_row = $stmtBank->fetch();
    $datos_bancarios = $bank_row ? htmlspecialchars_decode($bank_row['contenido_html'], ENT_QUOTES) : '';

    // 3. Responder al frontend con la misma estructura para no romper la UI pública
    echo json_encode([
        'status' => 'ok',
        'mensaje' => 'Cotización válida.',
        'data' => [
            'dolar_valor' => $dolar_valor,
            'euro_valor' => $euro_valor,
            'datos_bancarios' => $datos_bancarios,
            'ultima_actualizacion' => $ultima_actualizacion
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'mensaje' => 'Error de conexión con la base de datos financiera.']);
}
?>
