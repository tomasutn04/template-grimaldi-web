<?php
/**
 * API Endpoint PÚBLICO: Contactos (Staff Interno)
 * GET /public/api/contactos.php
 * Remplaza al archivo legacy que usaba wp_empleados
 */

require_once dirname(__DIR__, 2) . '/core/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método HTTP no permitido.']);
    exit;
}

try {
    // Configuración de Mapeo (Legacy Frontend mapping)
    // El frontend agrupa los empleados según un ID de sector y Nombre.
    // Usaremos los slugs definidos en el form como "id" para no romper el CSS del frontend y mapearemos nombres.
    
    $deptosMapping = [
        'gerencia-general' => 'Dirección General',
        'comercial' => 'Departamento Comercial',
        'exportacion' => 'Operaciones Exportación',
        'importacion' => 'Documentación Importación',
        'operaciones' => 'Operaciones Portuarias',
        'administracion' => 'Administración y Finanzas',
        'recepcion' => 'Centro de Atención'
    ];

    // Consultamos todos los empleados de la nueva tabla
    $stmt = $pdo->query("SELECT * FROM employees ORDER BY jerarquia ASC, apellido ASC");
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $deptosActivos = [];
    $contactosFormat = [];

    foreach ($empleados as $emp) {
        $slug = strtolower($emp['departamento']);
        
        // Formateo del objeto Contacto para el JS de la vista pública (casteo para preservar nombres legados)
        $contactosFormat[] = [
            'id' => $emp['id'],
            'nombre' => $emp['nombre'],
            'apellido' => $emp['apellido'],
            'posicion' => $emp['puesto'],
            'departamento' => $slug,
            'email' => $emp['email'],
            'telefono' => $emp['telefono'],
            'jerarquia' => (int)$emp['jerarquia']
        ];

        // Añadimos el departamento activo si no estaba
        if (!isset($deptosActivos[$slug])) {
            $nombre_bonito = isset($deptosMapping[$slug]) ? $deptosMapping[$slug] : ucfirst($slug);
            $deptosActivos[$slug] = [
                'id' => $slug,
                'nombre' => $nombre_bonito
            ];
        }
    }

    // Reordenamos los departamentos según la prelación jerárquica histórica
    $ordenDeptsRef = ['gerencia-general', 'comercial', 'exportacion', 'importacion', 'operaciones', 'administracion', 'recepcion'];
    usort($deptosActivos, function($a, $b) use ($ordenDeptsRef) {
        $posA = array_search($a['id'], $ordenDeptsRef);
        $posB = array_search($b['id'], $ordenDeptsRef);
        $posA = $posA === false ? 999 : $posA;
        $posB = $posB === false ? 999 : $posB;
        return $posA - $posB;
    });

    // Respuesta JSON
    echo json_encode([
        'status' => 'ok',
        'data' => [
            'departamentos' => array_values($deptosActivos), // Reiniciar indices
            'contactos' => $contactosFormat
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'error' => 'Error de conexión con la base del directorio corporativo.']);
}
?>
