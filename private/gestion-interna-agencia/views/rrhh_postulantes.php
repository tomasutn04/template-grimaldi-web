<?php
// views/rrhh_postulantes.php
if (!defined('is_logged_in')) exit;

// Listar postulantes
$postulantes = [];
try {
    // Left Join para traer los datos de la vacante, incluso si ya no existe, aunque ON DELETE CASCADE borraría los postulantes si se borra la vacante.
    $sql = "SELECT p.*, v.titulo AS vacante_titulo, v.departamento 
            FROM applicants p 
            LEFT JOIN vacancies v ON p.vacancy_id = v.id 
            ORDER BY p.fecha_postulacion DESC";
    $postulantes = $pdo->query($sql)->fetchAll();
} catch (\PDOException $e) { }

?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Recepción de Currículums (Postulantes)</h3>
        <span style="background:var(--secondary-blue); color:white; padding:5px 15px; border-radius:20px; font-size: 0.9em;">Total: <?php echo count($postulantes); ?> cvs</span>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f9f9f9; border-bottom: 2px solid #ccc;">
                <th style="padding: 10px;">Recepción</th>
                <th style="padding: 10px;">Nombre Candidato</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Postula A (Vacante)</th>
                <th style="padding: 10px;">Estado</th>
                <th style="padding: 10px;">CV</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($postulantes)): ?>
                <tr><td colspan="6" style="padding: 15px; text-align:center;">No se han recibido postulaciones en la base de datos.</td></tr>
            <?php else: ?>
                <?php foreach ($postulantes as $p): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px; font-size: 0.85em; color: #555;"><?php echo date('d/m/Y H:i', strtotime($p['fecha_postulacion'])); ?></td>
                    <td style="padding: 10px; font-weight: bold;"><?php echo htmlspecialchars($p['nombre']); ?></td>
                    <td style="padding: 10px;"><a href="mailto:<?php echo htmlspecialchars($p['email']); ?>" style="color: #666; text-decoration:none;"><?php echo htmlspecialchars($p['email']); ?></a></td>
                    <td style="padding: 10px; color: var(--secondary-blue);">
                        <?php echo $p['vacante_titulo'] ? htmlspecialchars($p['vacante_titulo']) : '<em>Vacante Eliminada</em>'; ?>
                    </td>
                    <td style="padding: 10px;">
                        <?php 
                            $bg = ['nuevo' => '#cce5ff', 'revision' => '#fff3cd', 'descartado' => '#f8d7da', 'contratado' => '#d4edda'];
                            $col = ['nuevo' => '#004085', 'revision' => '#856404', 'descartado' => '#721c24', 'contratado' => '#155724'];
                            $estado = $p['estado'] ?? 'nuevo';
                        ?>
                        <span style="background: <?php echo $bg[$estado]; ?>; color: <?php echo $col[$estado]; ?>; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; text-transform: uppercase;">
                            <?php echo $estado; ?>
                        </span>
                    </td>
                    <td style="padding: 10px; font-size: 0.9em;">
                        <?php if ($p['cv_path']): ?>
                            <a href="<?php echo htmlspecialchars($p['cv_path']); ?>" target="_blank" style="background:var(--primary-blue); color: #fff; padding: 5px 10px; text-decoration: none; border-radius: 4px;">Ver PDF</a>
                        <?php else: ?>
                            <span style="color: #999;">Sin adjunto</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div style="margin-top:20px; font-size: 0.85rem; color: #666;">
        Nota: La tabla de postulantes no permite edición o eliminación manual desde esta interfaz para mantener el registro auditado de talentos.
    </div>
</div>
