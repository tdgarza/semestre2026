<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil del Personaje</title>

<style>
:root{
    --color-de-fondo:#BFDBF7;
    --color-de-letras:#053C5E;
    --color-de-barra:#A31621;
    --color-de-botones:#1F7A8C;
    --color-extra:#DB222A;
}

body{
    background-color:#69DDFF;
    font-family: Arial, sans-serif;
    margin:0;
    padding:40px;
}

.contenedor{
    width:60%;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 5px 15px rgba(0,0,0,0.3);
}

h1{
    text-align:center;
    color:var(--color-extra);
}

.dato{
    margin:10px 0;
    font-size:16px;
}

img{
    display:block;
    margin:20px auto;
    max-width:300px;
    border-radius:10px;
}
</style>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "root";
$password = "";
$server = "localhost";
$database = "batman";

$conexion = new mysqli($server, $username, $password, $database);

if ($conexion->connect_error) {
    die("Conexion fallida: " . $conexion->connect_error);
}

if (isset($_REQUEST['id'])) {

    $id = (int) $_REQUEST['id'];

    $extraerdato = $conexion->query("SELECT * FROM personajes WHERE id = $id");

    if ($extraerdato && $extraerdato->num_rows > 0) {

        $fetch = $extraerdato->fetch_assoc();

        $nombrereal = $fetch['nombrereal'];
        $personaje = $fetch['personaje'];
        $altura = $fetch['altura'];
        $peso = $fetch['peso'];
        $poderes = $fetch['poderes'];
        $sexo = $fetch['sexo'];
        $debilidad = $fetch['debilidad'];
        $creation = $fetch['creation'];
        $biografia = $fetch['biografia'];
        $imagen = base64_encode($fetch['imagen']);
?>

<div class="contenedor">

    <h1><?php echo $personaje; ?></h1>

    <div class="dato"><strong>Nombre real:</strong> <?php echo $nombrereal; ?></div>
    <div class="dato"><strong>Altura:</strong> <?php echo $altura; ?></div>
    <div class="dato"><strong>Peso:</strong> <?php echo $peso; ?></div>
    <div class="dato"><strong>Poderes:</strong> <?php echo $poderes; ?></div>
    <div class="dato"><strong>Sexo:</strong> <?php echo $sexo; ?></div>
    <div class="dato"><strong>Debilidad:</strong> <?php echo $debilidad; ?></div>
    <div class="dato"><strong>Fecha de creación:</strong> <?php echo $creation; ?></div>
    <div class="dato"><strong>Biografía:</strong> <?php echo $biografia; ?></div>

    <img src="data:image/jpeg;base64,<?php echo $imagen; ?>">

</div>

<?php
    } else {
        echo "<h2 style='text-align:center;'>No se encontró el personaje.</h2>";
    }

} else {
    echo "<h2 style='text-align:center;'>No se recibió un ID válido.</h2>";
}

$conexion->close();
?>

</body>
</html>