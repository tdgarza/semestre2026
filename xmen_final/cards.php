<?php
require_once 'db.php';

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
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivo de Mutantes - Tarjetas Coleccionables</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="padding: 20px; text-align: center;">
        <h1 style="color: var(--x-yellow); margin-bottom: 20px;">Archivo Mutante: Colección 1990s</h1>
        <div class="nav-links">
            <a href="index.php" class="btn">Inicio</a>
            <a href="form.php" class="btn" style="background: var(--x-blue); color: white;">Nuevo Mutante</a>
        </div>
    </div>

    <!-- 
        EXPLICACIÓN:
        Usamos una cuadrícula (CSS Grid) para organizar las tarjetas.
        'cards-grid' tiene configurado 3 columnas por fila en el CSS.
    -->
    <div class="cards-grid">
        <?php if (empty($personajes)): ?>
            <p style="grid-column: span 3; text-align: center; color: #666;">
                No hay mutantes registrados aún en Cerebro.
            </p>
        <?php else: ?>
            <?php foreach ($personajes as $p): ?>
                <!-- TARJETA ESTILO 90s -->
                <div class="x-card">
                    <div class="card-header">
                        <?php echo htmlspecialchars($p['nombre']); ?>
                    </div>
                    
                    <div class="card-img-container">
                        <?php 
                        // Convertimos los datos binarios de la imagen a base64 para mostrarla en el <img>
                        if ($p['imagen']) {
                            $base64 = base64_encode($p['imagen']);
                            echo '<img src="data:image/jpeg;base64,' . $base64 . '" class="card-img" alt="Foto">';
                        } else {
                            echo '<div style="color:white; padding: 20px;">Sin Foto</div>';
                        }
                        ?>
                    </div>
                    
                    <div class="card-body">
                        <div class="card-stat">
                            <span class="stat-label">Equipo:</span> 
                            <span><?php echo htmlspecialchars($p['nombre_equipo'] ?? 'Independiente'); ?></span>
                        </div>
                        <div class="card-stat">
                            <span class="stat-label">Identidad:</span> 
                            <span><?php echo htmlspecialchars($p['nombrereal']); ?></span>
                        </div>
                        <div class="card-stat">
                            <span class="stat-label">Poderes:</span> 
                            <span><?php echo htmlspecialchars($p['poderes']); ?></span>
                        </div>
                        <div class="card-stat">
                            <span class="stat-label">Altura:</span> 
                            <span><?php echo htmlspecialchars($p['altura'] ?? 'N/A'); ?></span>
                        </div>
                        
                        <div class="card-bio">
                            <span class="stat-label">Bio:</span><br>
                            <?php echo nl2br(htmlspecialchars($p['bio'])); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
