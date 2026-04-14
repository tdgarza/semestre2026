<?php
// process.php - Manejo de la lógica de inserción
require_once 'db.php';

/* 
EXPLICACIÓN DE SEGURIDAD:
Usamos sentencias preparadas (PDO::prepare) para evitar "Inyecciones SQL". 
Esto significa que los datos del usuario nunca se ejecutan directamente como código SQL.
*/

if (isset($_POST['submit'])) {
    
    // 1. Recoger datos de texto
    $nombre = $_POST['nombre'] ?? '';
    $nombrereal = $_POST['nombrereal'] ?? '';
    $poderes = $_POST['poderes'] ?? '';
    $altura = $_POST['altura'] ?? '';
    $bio = $_POST['bio'] ?? '';
    
    // 2. Procesar la Imagen
    // Verificamos si se subió un archivo sin errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        
        $img_tmp_name = $_FILES['imagen']['tmp_name'];
        $img_name = $_FILES['imagen']['name'];
        
        // Obtenemos el contenido binario de la imagen para guardarlo en la DB (BLOB)
        $img_content = file_get_contents($img_tmp_name);
        
        // También la guardamos en una carpeta física por si acaso (buena práctica profesional)
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($img_tmp_name, $upload_dir . $img_name);
        
    } else {
        die("Error al subir la imagen.");
    }

    try {
        $sql = "INSERT INTO mutantes (nombre_clave, nombre_real, poderes, altura, bio, imagen) 
                VALUES (:nombre, :nombrereal, :poderes, :altura, :bio, :imagen)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':nombrereal', $nombrereal);
        $stmt->bindParam(':poderes', $poderes);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':imagen', $img_content, PDO::PARAM_LOB); // LOB para datos binarios grandes
        
        $stmt->execute();
        
        // REDIRECCIÓN: Después de guardar, mandamos al usuario a la página de tarjetas
        header("Location: cards.php?success=1");
        exit();

    } catch (PDOException $e) {
        // Si la tabla no existe o falta la columna, mostraremos el error de forma clara
        die("Error en la Base de Datos: " . $e->getMessage() . 
            "<br><br>💡 Asegúrate de que tu tabla 'equipoazul' tenga la columna 'altura'. 
            Puedes agregarla con: ALTER TABLE equipoazul ADD COLUMN altura VARCHAR(50);");
    }
} else {
    // Si alguien intenta entrar a process.php sin enviar el formulario, lo mandamos de vuelta
    header("Location: form.php");
    exit();
}
?>
