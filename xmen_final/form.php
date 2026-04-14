<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Mutante - Cerebro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 30px;">Ingreso de Datos</h2>
        
        <!-- 
            EXPLICACIÓN:
            1. method="POST": Usamos POST para enviar datos de forma segura, especialmente archivos.
            2. enctype="multipart/form-data": OBLIGATORIO cuando el formulario incluye campos de tipo 'file'. 
               Sin esto, la imagen no se enviará al servidor.
            3. action="process.php": Indica el archivo PHP que recibirá y procesará los datos.
        -->
        <form action="process.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="nombre">Nombre de Héroe/Clave:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ej. Wolverine" required>
            </div>

            <div class="form-group">
                <label for="nombrereal">Nombre Real:</label>
                <input type="text" name="nombrereal" id="nombrereal" placeholder="Ej. Logan" required>
            </div>

            <div class="form-group">
                <label for="poderes">Poderes:</label>
                <input type="text" name="poderes" id="poderes" placeholder="Ej. Regeneración, Garras de Adamantium" required>
            </div>

            <div class="form-group">
                <label for="altura">Altura (cm/pies):</label>
                <input type="text" name="altura" id="altura" placeholder="Ej. 1.60m" required>
            </div>

            <div class="form-group">
                <label for="bio">Biografía / Descripción:</label>
                <textarea name="bio" id="bio" rows="4" placeholder="Breve historia del personaje..." required></textarea>
            </div>

            <div class="form-group">
                <label for="imagen">Fotografía del Sujeto:</label>
                <!-- accept="image/*" restringe el explorador de archivos a solo imágenes -->
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
            </div>

            <div style="text-align: center;">
                <button type="submit" name="submit" class="btn">Protocolo de Registro</button>
            </div>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="color: var(--x-yellow); text-decoration: none;">← Volver al Inicio</a>
        </p>
    </div>
</body>
</html>
