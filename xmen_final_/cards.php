<?php 
require_once 'db.php';
include 'header.php'; 

// Consultamos todos los personajes usando un LEFT JOIN para traer el nombre del equipo
try {
    $sql = "SELECT m.*, e.nombre_equipo 
            FROM mutantes m 
            LEFT JOIN equipos e ON m.equipo_id = e.id 
            ORDER BY m.id DESC";
    $stmt = $pdo->query($sql);
    $personajes = $stmt->fetchAll();
} catch (PDOException $e) {
    $personajes = [];
}
?>

<div class="container-fluid">
    <h1>Galería de Mutantes</h1>
    <p style="text-align: center; color: var(--color-de-letras);">Consulta de Registros Relacionados - Base de Datos Pro</p>

    <div class="cards-grid">
        <?php foreach ($personajes as $p): ?>
            <div class="x-card">
                <div class="card-header">
                    <?php echo htmlspecialchars($p['nombre_clave']); ?>
                </div>
                
                <div class="card-img-container">
                    <?php if ($p['imagen']): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($p['imagen']); ?>" class="card-img">
                    <?php else: ?>
                        <div style="text-align:center; padding-top: 80px;">Sin Imagen</div>
                    <?php endif; ?>
                </div>
                
                <div class="card-body">
                    <p><span class="stat-label">Equipo:</span> <?php echo htmlspecialchars($p['nombre_equipo'] ?? 'Independiente'); ?></p>
                    <p><span class="stat-label">Nombre Real:</span> <?php echo htmlspecialchars($p['nombre_real']); ?></p>
                    <p><span class="stat-label">Poderes:</span> <?php echo htmlspecialchars($p['poderes']); ?></p>
                    <p><span class="stat-label">Altura:</span> <?php echo htmlspecialchars($p['altura']); ?></p>
                    <hr>
                    <p class="small"><em><?php echo nl2br(htmlspecialchars($p['bio'])); ?></em></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
