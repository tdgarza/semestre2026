<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla final</title>
</head>
<body>
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
        }
        h1{
            font-family: 'NEON CLUB MUSIC', sans-serif;
            color: var(--color-extra);
            text-align: center;                                                                        
        }  
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid var(--color-extra);
        }

        th {
        background-color: var(--color-de-botones);
        color: #282a36;
        }

        tr:nth-child(even) {
        background-color: var(--color-de-letras);
    }

tr:nth-child(odd) {
    background-color: #6272a4;
}
    </style>
    <?php
    //Estas dos lineas son para mostrar errores (como mi ex)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $username = "root";
    $password = "";
    $server = "localhost";
    $database = "batman"; //<-en un futuro esta se cambia por otra base de datos
    $conexion = new mysqli($server, $username, $password, $database);
    if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
    }
    if(isset($_POST['id'])){
        $id = (int) $_POST['id'];
        //Consulta para extrar los datos del personaje de la tabla
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
            $creacion = $fetch['creation'];
            $biografia = $fetch['biografia'];
            $imagen = base64_encode($fetch['imagen']);     
        }else {
        echo "<p>No se encontró el personaje con el ID proporcionado.</p>";
        exit;
         }} else {
             echo "<p>No se recibió un ID válido.</p>";
             exit;}
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
    <?php
   

$conexion->close();
?>


</div>
</body>
</html>