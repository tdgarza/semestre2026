<?php 
require_once 'db.php';
include 'header.php'; 

// Obtenemos los equipos de la base de datos para el menú desplegable
try {
    $stmtTeams = $pdo->query("SELECT * FROM equipos ORDER BY nombre_equipo ASC");
    $equiposList = $stmtTeams->fetchAll();
} catch (PDOException $e) {
    $equiposList = [];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel Estilo Unidad 2 -->
            <div class="panel panel-primary" style="border-color: var(--color-de-barra); margin-top: 30px; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                <div class="panel-heading" style="background-color: var(--color-de-barra); border-color: var(--color-de-barra);">
                    <h2 class="panel-title" style="font-family: 'NEON CLUB MUSIC', sans-serif; font-size: 24px; text-align: center;">
                        Registro de Mutante - Unidad 2
                    </h2>
                </div>
                <div class="panel-body" style="background-color: white; padding: 40px;">
                    
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="row">
                            <!-- Columna 1 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-user"></span> Nombre de Héroe:</label>
                                    <input type="text" name="nombre" class="form-control" placeholder="Ej. Wolverine" required style="border-color: var(--color-de-fondo);">
                                </div>
                            </div>
                            <!-- Columna 2 - Selección de Equipo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-eye-open"></span> Asignar Equipo:</label>
                                    <select name="equipo_id" class="form-control" style="border-color: var(--color-de-fondo);">
                                        <option value="">Independiente / Ninguno</option>
                                        <?php foreach ($equiposList as $eq): ?>
                                            <option value="<?php echo $eq['id']; ?>">
                                                <?php echo htmlspecialchars($eq['nombre_equipo']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-tag"></span> Nombre Real:</label>
                                    <input type="text" name="nombrereal" class="form-control" placeholder="Ej. Logan" required style="border-color: var(--color-de-fondo);">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-flash"></span> Poderes:</label>
                                    <input type="text" name="poderes" class="form-control" placeholder="Ej. Regeneración" required style="border-color: var(--color-de-fondo);">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-resize-full"></span> Altura:</label>
                                    <input type="text" name="altura" class="form-control" placeholder="Ej. 1.60m" required style="border-color: var(--color-de-fondo);">
                                </div>
                            </div>
                        </div>

                        <!-- Fila Completa -->
                        <div class="form-group">
                            <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-book"></span> Biografía / Historia:</label>
                            <textarea name="bio" class="form-control" rows="4" placeholder="Escribe la historia del mutante..." required style="border-color: var(--color-de-fondo); resize: none;"></textarea>
                        </div>

                        <div class="form-group">
                            <label style="color: var(--color-de-letras);"><span class="glyphicon glyphicon-picture"></span> Fotografía del Sujeto:</label>
                            <div class="well well-sm" style="background-color: var(--color-de-fondo); border: 2px dashed var(--color-de-botones);">
                                <input type="file" name="imagen" class="form-control" accept="image/*" required style="background: transparent; border: none; box-shadow: none;">
                            </div>
                        </div>

                        <hr style="border-color: var(--color-de-fondo);">

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit" class="btn btn-lg" style="background-color: var(--color-de-botones); color: white; width: 60%; font-weight: bold; border: none; box-shadow: 0 4px 0 #145a68;">
                                    <span class="glyphicon glyphicon-save"></span> REGISTRAR EN CEREBRO
                                </button>
                                <br><br>
                                <a href="index.php" style="color: var(--color-extra); text-decoration: none;">&larr; Volver al Inicio</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Efecto hover suave en los inputs */
    .form-control:focus {
        border-color: var(--color-de-barra) !important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(163, 22, 33, 0.3) !important;
    }
</style>

</body>
</html>
