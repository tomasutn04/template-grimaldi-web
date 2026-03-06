<?php
/**
 * API Endpoint PÚBLICO: Documentación Oficial
 * GET /public/api/documentos.php
 * Regla de negocio: Devuelve la lista en tiempo real de los PDF o Docs oficiales clasificados
 */

require_once dirname(__DIR__, 2) . '/core/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método HTTP no permitido.']);
    exit;
}

try {
    $stmt = $pdo->query("SELECT nombre_documento, categoria, file_path, peso_bytes, fecha_update FROM public_documents ORDER BY categoria ASC, fecha_update DESC");
    $docs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar por categoría
    $categorias = [];
    foreach ($docs as $d) {
        $cat = $d['categoria'];
        if (!isset($categorias[$cat])) {
            $categorias[$cat] = [];
        }
        $categorias[$cat][] = [
            'nombre' => $d['nombre_documento'],
            'url' => $d['file_path'], // Relativa, e.g. /assets/docs/form.pdf
            'peso_bytes' => (int)$d['peso_bytes'],
            'fecha' => date('d/m/Y', strtotime($d['fecha_update']))
        ];
    }

    echo json_encode([
        'status' => 'ok',
        'data' => $categorias
    ], JSON_UNESCAPED_UNICODE);

} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'error' => 'Error de conexión con el repositorio de documentos.']);
}
?>
