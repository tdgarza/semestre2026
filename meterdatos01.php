<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/raleway-5" rel="stylesheet">
                
    <title>Document</title>
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
        body {
        font-family: 'Arial', sans-serif;
        background-color: var(--color-de-letras); /* Fondo oscuro */
        color: #ffffff; /* Texto blanco */
    }
    h2 {
        font-family: 'Raleway', sans-serif;
        color: yellow; /* Naranja característico de Batman */
    }
    form {
    width: 50%;
    margin: auto;
    }

    label {
    display: block;
    margin-bottom: 8px;
    color: #ffffff; /* Texto blanco */
    }

    input[type="text"],
    input[type="date"],
    textarea {
    width: 60%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid var(--color-extra); /* Borde naranja */
    border-radius: 5px;
    background-color: #1f1f1f; /* Fondo oscuro */
    color: #ffffff; /* Texto blanco */
    }
    input[type="submit"] {
    background-color: yellow; /* Fondo naranja para el botón */
    color: #000; /* Texto blanco */
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    }

    /* Estilo para los campos ocultos */
    input[type="hidden"] {
    display: none;
    }

    /* Estilo para el mensaje de éxito o error */
    #mensaje {
    margin-top: 15px;
    padding: 10px;
    border-radius: 5px;
    }

    /* Estilo para el fondo de Batman */
    body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: url('superman.jpg') center/cover no-repeat; /* Reemplaza 'ruta/a/tu/imagen/batman-bg.jpg' con la ruta de tu imagen */
    opacity: 0.3;
    }
    table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
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
<h2>Introduce los datos:</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formulario">
    <!-- Campos para datos de Superhéroe -->
    <label for="nombrereal">Nombre del Superhéroe:</label>
    <input type="text" name="nombrereal" required><br>
    <label for="personaje">Personaje:</label>
    <input type="text" name="personaje" required><br>
   
    <label for="altura">Altura:</label>
    <input type="text" name="altura" required><br>
    <label for="peso">Peso:</label>
    <input type="text" name="peso" required><br>
    <label for="poderes">Poderes:</label>
    <input type="text" name="poderes" required><br>
    <label for="sexo">Sexo:</label>
    <input type="text" name="sexo" required><br>
    <label for="debilidad">Debilidad:</label>
    <input type="text" name="debilidad" required><br>
    <label for="creation">Fecha de Creación:</label>
    <input type="date" name="creation" required><br>
    <label for="biografia">Biografia:</label>
    <textarea name="biografia" required></textarea><br>
     <!-- Botón para enviar el formulario -->
    <input type="submit" value="Guardar Datos">
    </form>

    <?php
    
        //en esta parte voy a poner los mismos datos para conectarse a mi base de datos
        $username = "root";
        $password = "";
        $server = "localhost";
        $database = "batman"; //esta es mi base de datos, ustedes tienen otro nombre, aqui se lo agregan
        $conexion = new mysqli($server, $username, $password, $database);
        if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
        //En esta parte voy a poner las variables que use en la base de datos, desde nombre a biografia
        $nombrereal = $_POST['nombrereal'];
        $personaje = $_POST['personaje'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $poderes = $_POST['poderes'];
        $sexo = $_POST['sexo'];
        $debilidad = $_POST['debilidad'];
        $creation = $_POST['creation'];
        $biografia = $_POST['biografia'];
       
        $sql = "INSERT INTO personajes (nombrereal, personaje, altura, peso, poderes, sexo, debilidad, creation, biografia) VALUES ('$nombrereal', '$personaje', '$altura', '$peso', '$poderes', '$sexo', '$debilidad', '$creation', '$biografia')";
    
        if($conexion->query($sql)==TRUE){
            echo "Nuevo personaje creado con éxito.";
        }else{
            echo "Error al agregar al nuevo personaje.";
        }
        }
?>
    <?php
        //Voy a meter los datos del sql para sacar los datos
        $sql_mostrar ="SELECT * FROM personajes";
        $resultado = $conexion->query($sql_mostrar);
         
        if($resultado->num_rows >0){
                echo "<table>";
                echo "<tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Personaje</th>
                <th>Altura</th>
                <th>Peso</th>
                <th>Poderes</th>
                <th>Sexo</th>
                <th>Debilidad</th>
                <th>Creacion</th>
                <th>Biografia</th>
                </tr>";
                while($fila = $resultado->fetch_assoc()){
                     echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombrereal']}</td>
                <td>{$fila['personaje']}</td>
                <td>{$fila['altura']}</td>
                <td>{$fila['peso']}</td>
                <td>{$fila['poderes']}</td>
                <td>{$fila['sexo']}</td>
                <td>{$fila['debilidad']}</td>
                <td>{$fila['creation']}</td>
                <td>{$fila['biografia']}</td>
              </tr>";
    }
                echo "</table>";
                 }else{
                echo "No se encontraron registros en la base de datos";
            }
    ?>
</body>
</html>