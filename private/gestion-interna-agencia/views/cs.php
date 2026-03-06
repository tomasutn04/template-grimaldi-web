<?php
// views/cs.php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php';
require_role('cs');

$mensaje = '';

// Autoload de librerías para Excel (Asumiendo que PhpSpreadsheet está instalado vía composer o legacy route)
$autoloader_composer = dirname(__DIR__, 2) . '/vendor/autoload.php';
$autoloader_legacy = dirname(__DIR__, 2) . '/uploads/libs/phpspreadsheet/autoload.php';

if (file_exists($autoloader_composer)) {
    require_once $autoloader_composer;
} elseif (file_exists($autoloader_legacy)) {
    require_once $autoloader_legacy;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $_POST['csrf_token'] ?? '';
    
    // Validar si la accion es purgar
    if (isset($_POST['purgar_hash'])) {
        if (!verify_csrf_token($csrf)) {
            $mensaje = "<div style='color:red;'>Token CSRF inválido.</div>";
        } else {
             try {
                 $stmt = $pdo->prepare("DELETE FROM schedules WHERE hash_importacion = ?");
                 $stmt->execute([$_POST['purgar_hash']]);
                 $mensaje = "<div style='color:green; padding: 10px; border: 1px solid green; border-radius: 4px; background: #e6ffe6;'>Importación eliminada correctamente.</div>";
             } catch (\PDOException $e) {
                 $mensaje = "<div style='color:red;'>Error al eliminar.</div>";
             }
        }
    } 
    // Procesar subida de Excel
    elseif (isset($_FILES['excel_schedules'])) {
        if (!verify_csrf_token($csrf)) {
            $mensaje = "<div style='color:red;'>Token de seguridad inválido.</div>";
        } elseif (!class_exists('\PhpOffice\PhpSpreadsheet\IOFactory')) {
            $mensaje = "<div style='color:red;'>La librería PhpSpreadsheet no está instalada o correctamente vinculada. No se puede procesar el Excel.</div>";
        } else {
            $file = $_FILES['excel_schedules'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $tipos_permitidos = ['xlsx', 'xls'];

            if (in_array($ext, $tipos_permitidos) && $file['error'] === UPLOAD_ERR_OK) {
                try {
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = $sheet->toArray(null, true, true, true);

                    $hash = substr(md5(uniqid(rand(), true)), 0, 16); // Identificador de lote
                    
                    // Extraer encabezados (Filas 1 a 4 típicas de los exceles de Grimaldi)
                    $encabezados_crudos = array_slice($data, 0, 4, true);
                    
                    // Datos comienzan en fila 5
                    $start_row = 5;
                    $registros_exitosos = 0;
                    
                    $pdo->beginTransaction();

                    while (isset($data[$start_row]) && !empty(trim($data[$start_row]['A'] ?? ''))) {
                        $fila = $data[$start_row];
                        
                        // Mapeo básico: A=Buque, B=Viaje según el archivo legacy. ETA y ETD varían por columna así que se guarda el RAW JSON
                        $buque = trim($fila['A'] ?? 'Desconocido');
                        $viaje = trim($fila['B'] ?? 'TBA');
                        
                        // Guardar la fila completa para reconstrucción en la UI pública
                        $json_extra = json_encode(['row' => $fila, 'headers' => $encabezados_crudos], JSON_UNESCAPED_UNICODE);

                        $stmt = $pdo->prepare("INSERT INTO schedules (buque, viaje, datos_extra, hash_importacion) VALUES (?, ?, ?, ?)");
                        $stmt->execute([$buque, $viaje, $json_extra, $hash]);
                        
                        $registros_exitosos++;
                        $start_row++;
                    }

                    $pdo->commit();

                    if ($registros_exitosos > 0) {
                         $mensaje = "<div style='color:green; padding: 10px; border: 1px solid green; border-radius: 4px; background: #e6ffe6;'>Schedules actualizados. Se insertaron $registros_exitosos itinerarios en MySQL.</div>";
                    } else {
                         $mensaje = "<div style='color:orange; padding: 10px; border: 1px solid orange; border-radius: 4px; background: #fff3cd;'>El archivo fue procesado pero no se encontraron filas de datos a partir de la línea 5.</div>";
                    }

                } catch (Exception $e) {
                    if ($pdo->inTransaction()) $pdo->rollBack();
                    $mensaje = "<div style='color:red;'>Error al procesar el Excel: " . htmlspecialchars($e->getMessage()) . "</div>";
                }
            } else {
                $mensaje = "<div style='color:red;'>Error al subir el archivo. Asegúrese de que sea .xlsx o .xls válido.</div>";
            }
        }
    }
}

// Histórico de importaciones
$importaciones = [];
try {
    // Agrupar por hash y contar filas
    $stmt = $pdo->query("SELECT hash_importacion, max(creado_en) as fecha_subida, count(*) as total_filas 
                         FROM schedules 
                         GROUP BY hash_importacion 
                         ORDER BY fecha_subida DESC LIMIT 10");
    $importaciones = $stmt->fetchAll();
} catch (\PDOException $e) {}

?>
<div class="layout-flexible" style="display:flex; gap: 20px;">
    <!-- Subida -->
    <div class="card" style="flex: 1;">
        <h2>Subida de Schedules</h2>
        <p>El sistema usa PhpSpreadsheet para abrir el archivo, limpiar celdas vacías, e insertar los itinerarios directamente en la base de datos.</p>

        <?php echo $mensaje; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div style="margin-bottom: 15px;">
                <label for="excel" style="display:block; margin-bottom:5px; font-weight: 600;">Archivo Excel de la Línea Marítima:</label>
                <input type="file" id="excel" name="excel_schedules" accept=".xlsx, .xls" required style="padding: 10px; width: 100%; max-width: 400px; border-radius:4px; border: 1px dashed #ccc; background: #fafafa;">
                <br><span style="font-size: 0.8em; color: #666;">El sistema lee la metadata visual de las filas 1 a 4, e importa las filas 5 en adelante como datos.</span>
            </div>
            
            <button type="submit" style="background-color: var(--secondary-blue); color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight:bold;">
                Procesar y Publicar Schedules (MySQL)
            </button>
        </form>
    </div>

    <!-- Histórico -->
    <div class="card" style="flex: 1;">
        <h3>Últimas Importaciones Activas</h3>
        
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f9f9f9; border-bottom: 2px solid #ccc;">
                    <th style="padding: 10px;">Fecha Subida</th>
                    <th style="padding: 10px;">Lote (Hash)</th>
                    <th style="padding: 10px;">Buques</th>
                    <th style="padding: 10px;">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($importaciones)): ?>
                    <tr><td colspan="4" style="padding: 15px; text-align:center;">No hay importaciones registradas.</td></tr>
                <?php else: ?>
                    <?php foreach ($importaciones as $imp): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; font-weight: bold;"><?php echo date('d/m/Y H:i', strtotime($imp['fecha_subida'])); ?></td>
                        <td style="padding: 10px; font-family: monospace; color: #666;"><?php echo $imp['hash_importacion']; ?></td>
                        <td style="padding: 10px;"><span style="background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 10px; font-weight:bold;"><?php echo $imp['total_filas']; ?></span></td>
                        <td style="padding: 10px;">
                            <form method="POST" action="" style="display:inline;" onsubmit="return confirm('¿Eliminar este lote completo de la base de datos?');">
                                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                <input type="hidden" name="purgar_hash" value="<?php echo $imp['hash_importacion']; ?>">
                                <button type="submit" style="background:none; border:none; color: #d9534f; cursor:pointer; text-decoration:underline; font-size:0.9em;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <p style="font-size: 0.8em; color: #888; margin-top: 15px;">Nota: Es posible tener múltiples lotes conviviendo, pero lo normal es eliminar el calendario de la semana anterior antes de subir uno nuevo.</p>
    </div>
</div>
