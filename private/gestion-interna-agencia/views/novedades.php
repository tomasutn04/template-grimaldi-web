<?php
if (!defined('is_logged_in')) require_once '../includes/auth.php';
require_once dirname(__DIR__) . '/includes/db.php';
require_role('cs'); 

// views/novedades.php
// Esta vista se carga dentro de dashboard.php

$mockFile = __DIR__ . '/../../../src/data/mock_news.json';
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_news') {
    $titulo = trim($_POST['titulo'] ?? '');
    $subtitulo = trim($_POST['subtitulo'] ?? '');
    $cuerpo = trim($_POST['cuerpo'] ?? '');
    
    if ($titulo && $cuerpo) {
        $newsData = [];
        if (file_exists($mockFile)) {
            $jsonData = file_get_contents($mockFile);
            $newsData = json_decode($jsonData, true) ?: [];
        }
        
        $newId = count($newsData) > 0 ? max(array_column($newsData, 'id')) + 1 : 1;
        
        // Simular subida (paths harcodeados o vacíos para demo FrontEnd)
        $imagen_path = "/assets/img/GGroupCMYK.png"; // Placeholder
        $pdf_path = "";
        
        // If file attachment was named (mock approach)
        if (!empty($_FILES['pdf_file']['name'])) {
            $pdf_path = "/assets/docs/" . basename($_FILES['pdf_file']['name']);
        }
        
        $nuevoRegistro = [
            "id" => $newId,
            "titulo" => $titulo,
            "subtitulo" => $subtitulo,
            "cuerpo" => $cuerpo,
            "imagen_path" => $imagen_path,
            "pdf_path" => $pdf_path,
            "fecha_publicacion" => date('Y-m-d H:i:s')
        ];
        
        // Agregar al inicio del array (novedad más reciente primera)
        array_unshift($newsData, $nuevoRegistro);
        
        if (file_put_contents($mockFile, json_encode($newsData, JSON_PRETTY_PRINT))) {
            $successMsg = "Noticia corporativa publicada exitosamente en el feed local.";
        } else {
            $errorMsg = "Error al intentar guardar en la base de datos distribuida (mock JSON). Verifique si la carpeta permite I/O operations.";
        }
    } else {
        $errorMsg = "Por favor complete los campos obligatorios para conformar una pieza periodística válida.";
    }
}
?>

<style>
    .ga-alert { padding: 1rem 1.5rem; border-radius: var(--ga-radius-md); margin-bottom: 1.5rem; font-weight: 500; font-size: 0.95rem; line-height: 1.4; }
    .ga-alert--success { background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
    .ga-alert--error { background-color: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
    .ga-alert--warning { background-color: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; }
</style>

<div style="margin-bottom: 2rem;">
    <!-- Shared Sub-header nav logic to look like a cohesive module -->
    <div style="display: flex; gap: 0.5rem; background: var(--ga-bg-subtle); padding: 0.25rem; border-radius: var(--ga-radius-md); box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 1.5rem; width: fit-content;">
        <a href="?section=cs" class="ga-btn ga-btn--outline" style="border: none; background: transparent; color: var(--ga-text-soft);">Importador Lotes (Schedule)</a>
        <a href="?section=novedades" class="ga-btn ga-btn--primary" style="border: none;">Publicador de Noticias</a>
    </div>

    <h2 style="font-size: 1.75rem; color: var(--ga-accent); margin-bottom: 0.5rem;">Periódicos Externos e Inteligencia</h2>
    <p style="color: var(--ga-text-soft);">Publique revistas trimestrales, novedades corporativas y cambios estructurales para abonar el front-page de los clientes.</p>
</div>

<?php if ($successMsg): ?>
    <div class="ga-alert ga-alert--success"><?php echo htmlspecialchars($successMsg); ?></div>
<?php endif; ?>
<?php if ($errorMsg): ?>
    <div class="ga-alert ga-alert--error"><?php echo htmlspecialchars($errorMsg); ?></div>
<?php endif; ?>

<div class="ga-card ga-card--light" style="max-width: 900px;">
    <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Carga de Artículos Editoriales</h3>
    <p style="color: var(--ga-text-soft); font-size: 0.95rem; margin-bottom: 2rem;">Llene el formulario con el contenido extraído de Sede Central. Al emitir, estará visible en la solapa rotativa de Index.php inmediatamente.</p>
    
    <form method="POST" action="dashboard.php?section=novedades" enctype="multipart/form-data" class="ga-form">
        <input type="hidden" name="action" value="create_news">
        
        <div class="ga-field">
            <label for="titulo">Titular Noticioso (Máximo Impacto) *</label>
            <input type="text" id="titulo" name="titulo" class="ga-input" required placeholder="Ej: Las embarcaciones RoRo adoptan nuevos estándares anticontaminación EU." style="font-size: 1.1rem; font-weight: 500;">
        </div>
        
        <div class="ga-field">
            <label for="subtitulo">Copete o Bajada Informativa</label>
            <input type="text" id="subtitulo" name="subtitulo" class="ga-input" placeholder="Ej: Operativas extendidas en Terminal Zárate garantizarán flujo fluido...">
        </div>
        
        <div class="ga-field">
            <label for="cuerpo">Cuerpo de la Nota Periodística *</label>
            <textarea id="cuerpo" name="cuerpo" rows="8" class="ga-input" required placeholder="Escriba aquí el contenido detallado a manifestar..."></textarea>
        </div>
        
        <div class="ga-grid ga-grid--2">
            <div class="ga-field" style="padding: 1.5rem; border: 1px dashed var(--ga-border-subtle); border-radius: var(--ga-radius-md); background: rgba(0,0,0,0.01);">
                <label for="img_file" style="margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--ga-blue);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Medios Digitales (Carátula)</span>
                </label>
                <input type="file" id="img_file" name="img_file" class="ga-input" accept="image/*" style="border: none; padding-left: 0; background: transparent;">
                <span style="font-size: 0.8rem; color: var(--ga-text-soft); display: block; margin-top: 0.5rem;">Archivos .jpg, .png en ratio 16:9 preferentemente.</span>
            </div>
            
            <div class="ga-field" style="padding: 1.5rem; border: 1px dashed var(--ga-border-subtle); border-radius: var(--ga-radius-md); background: rgba(0,0,0,0.01);">
                <label for="pdf_file" style="margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #EF4444;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Suplemento Descargable Grimaldi News (PDF)</span>
                </label>
                <input type="file" id="pdf_file" name="pdf_file" class="ga-input" accept=".pdf" style="border: none; padding-left: 0; background: transparent;">
                <span style="font-size: 0.8rem; color: var(--ga-text-soft); display: block; margin-top: 0.5rem;">Opcional: Si reviste carácter Oficial, esto imprimirá el botón rojo "DOWNLOAD ISSUE PDF" en el artículo.</span>
            </div>
        </div>
        
        <div style="margin-top: 2.5rem; display: flex; justify-content: flex-end; align-items: center; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid var(--ga-border-subtle);">
            <button type="reset" class="ga-btn ga-btn--outline" style="color: var(--ga-text-soft); border-color: transparent;">Blanquear</button>
            <button type="submit" class="ga-btn ga-btn--primary" style="padding: 0.75rem 2.5rem; box-shadow: 0 4px 6px -1px rgba(43, 85, 140, 0.2);">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" style="margin-right: 0.5rem;"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                Compilar & Publicar en Mainframe
            </button>
        </div>
    </form>
</div>
