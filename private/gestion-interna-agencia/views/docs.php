<?php
// views/docs.php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php';
require_role('documentacion');

$mensaje = '';
$docs_dir = dirname(__DIR__, 2) . '/assets/docs/';

// Asegurar que exista el directorio
if (!is_dir($docs_dir)) {
    mkdir($docs_dir, 0755, true);
}

// Lógica de Eliminación
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if (!verify_csrf_token($_GET['csrf'] ?? '')) {
        $mensaje = "<div style='color:red;'>Token CSRF inválido al eliminar.</div>";
    } else {
        try {
            // Buscar archivo para borrarlo del disco
            $stmt = $pdo->prepare("SELECT file_path FROM public_documents WHERE id = ?");
            $stmt->execute([$_GET['delete']]);
            $doc = $stmt->fetch();

            if ($doc) {
                $full_path = dirname(__DIR__, 2) . $doc['file_path']; // Ej: /assets/docs/archivo.pdf -> c:/.../assets/docs/archivo.pdf
                if (file_exists($full_path)) {
                    unlink($full_path);
                }

                $stmt = $pdo->prepare("DELETE FROM public_documents WHERE id = ?");
                $stmt->execute([$_GET['delete']]);
                $mensaje = "<div style='color:green; padding: 10px; border: 1px solid green; background: #e6ffe6;'>Documento eliminado de la base de datos y del servidor.</div>";
            }
        } catch (\PDOException $e) {
            $mensaje = "<div style='color:red;'>Error al eliminar documento.</div>";
        }
    }
}

// Lógica de Subida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['documento'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $mensaje = "<div style='color:red;'>Token CSRF inválido.</div>";
    } else {
        $file = $_FILES['documento'];
        $nombre_visual = trim($_POST['nombre_documento']);
        $categoria = $_POST['categoria'];

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $permitidos = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip'];

        if (!in_array($ext, $permitidos)) {
            $mensaje = "<div style='color:red;'>Formato no permitido. Use PDF, DOC, XLS o ZIP.</div>";
        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $mensaje = "<div style='color:red;'>Error en la carga del archivo.</div>";
        } else {
            // Generar nombre seguro
            $filename_safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME)) . '_' . time() . '.' . $ext;
            $destino = $docs_dir . $filename_safe;
            $url_path = '/assets/docs/' . $filename_safe; // Ruta relativa para la web

            if (move_uploaded_file($file['tmp_name'], $destino)) {
                try {
                    $peso = filesize($destino);
                    $stmt = $pdo->prepare("INSERT INTO public_documents (nombre_documento, categoria, file_path, peso_bytes, subido_por) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$nombre_visual, $categoria, $url_path, $peso, $_SESSION['user_id']]);
                    $mensaje = "<div style='color:green; padding: 10px; border: 1px solid green; background: #e6ffe6;'>Documento subido y publicado con éxito.</div>";
                } catch (\PDOException $e) {
                    unlink($destino); // Revertir si falla BD
                    $mensaje = "<div style='color:red;'>Error de Base de Datos: " . $e->getMessage() . "</div>";
                }
            } else {
                $mensaje = "<div style='color:red;'>Fallo al mover el archivo. Verifique permisos de carpeta.</div>";
            }
        }
    }
}

// Listar Documentos
$documentos = [];
try {
    $stmt = $pdo->query("SELECT d.*, u.nombre AS autor FROM public_documents d LEFT JOIN usuarios_admin u ON d.subido_por = u.id ORDER BY d.fecha_update DESC");
    $documentos = $stmt->fetchAll();
} catch (\PDOException $e) {}

// Helper para tamaño
function formatBytes($size, $precision = 2) {
    if ($size <= 0) return '0 B';
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');   
    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
?>

<div class="layout-flexible" style="display:flex; gap: 20px;">
    
    <!-- Formulario de Subida -->
    <div class="card" style="flex: 1;">
        <h2>Subir Nuevo Documento</h2>
        <p>Los archivos subidos aquí estarán disponibles automáticamente en la web pública para descarga de clientes.</p>

        <?php echo $mensaje; ?>

        <form method="POST" action="dashboard.php?section=docs" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight: 600;">Nombre Público del Documento *</label>
                <input type="text" name="nombre_documento" required placeholder="Ej: Formulario AFIP Importadores" style="padding: 10px; width: 100%; border-radius:4px; border: 1px solid #ccc;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight: 600;">Categoría *</label>
                <select name="categoria" required style="padding: 10px; width: 100%; border-radius:4px; border: 1px solid #ccc;">
                    <option value="importacion">Importación</option>
                    <option value="exportacion">Exportación</option>
                    <option value="formularios">Formularios Oficiales</option>
                    <option value="legal">Legales / Compliance</option>
                </select>
            </div>

            <div style="border: 2px dashed #00458a; padding: 20px; text-align: center; border-radius: 8px; margin-bottom: 20px; background: #f4f8ff;">
                <label for="documento" style="font-weight:bold; cursor:pointer; color: #00458a; display:block; margin-bottom:10px;">Seleccionar Archivo (PDF, DOC/X, XLS/X, ZIP)</label>
                <input type="file" id="documento" name="documento" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" required style="width:100%;">
            </div>
            
            <button type="submit" style="background-color: var(--secondary-blue); color: white; padding: 12px 20px; width: 100%; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                Subir y Publicar Archivo
            </button>
        </form>
    </div>

    <!-- Listado Existente -->
    <div class="card" style="flex: 2;">
        <h3>Repositorio Público (<?php echo count($documentos); ?> activos)</h3>
        
        <table style="width: 100%; text-align: left; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="border-bottom: 2px solid #ccc; background: #f9f9f9;">
                    <th style="padding: 10px;">Documento</th>
                    <th style="padding: 10px;">Categoría</th>
                    <th style="padding: 10px;">Tamaño</th>
                    <th style="padding: 10px;">Fecha / Autor</th>
                    <th style="padding: 10px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($documentos)): ?>
                    <tr><td colspan="5" style="padding: 15px; text-align:center;">El repositorio está vacío.</td></tr>
                <?php else: ?>
                    <?php foreach ($documentos as $doc): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">
                            <strong style="color:var(--primary-blue);"><?php echo htmlspecialchars($doc['nombre_documento']); ?></strong><br>
                            <a href="<?php echo htmlspecialchars('..' . $doc['file_path']); ?>" target="_blank" style="font-size:0.85em; color:#17a2b8; text-decoration:none;">Ver Archivo</a>
                        </td>
                        <td style="padding: 10px;">
                            <span style="background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 10px; font-size: 0.85em; text-transform:uppercase;">
                                <?php echo htmlspecialchars($doc['categoria']); ?>
                            </span>
                        </td>
                        <td style="padding: 10px; font-size: 0.9em; color:#666;">
                            <?php echo formatBytes($doc['peso_bytes']); ?>
                        </td>
                        <td style="padding: 10px; font-size: 0.85em;">
                            <?php echo date('d/m/Y H:i', strtotime($doc['fecha_update'])); ?><br>
                            <span style="color:#888;">(<?php echo htmlspecialchars($doc['autor']); ?>)</span>
                        </td>
                        <td style="padding: 10px;">
                            <a href="?section=docs&delete=<?php echo $doc['id']; ?>&csrf=<?php echo generate_csrf_token(); ?>" onclick="return confirm('¿Eliminar documento definitivamente? Esto romperá los enlaces si clientes lo tienen guardado.');" style="color: #d9534f; text-decoration: none; font-size:0.9em;">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
