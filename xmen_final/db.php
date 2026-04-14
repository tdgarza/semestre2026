<?php
// db.php - Configuración de la conexión a la base de datos
// Usamos PDO porque es más seguro (permite sentencias preparadas contra inyecciones SQL)
// y más profesional que el antiguo mysqli_connect.

$host = "localhost";
$dbname = "xmen_pro";
$username = "root";
$password = "";

try {
    // Creamos la conexión con el driver de MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuramos para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Definimos el modo de obtención de datos por defecto como array asociativo
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Si hay un error, lo mostramos y detenemos la ejecución
    die("Error de conexión: " . $e->getMessage());
}
?>
