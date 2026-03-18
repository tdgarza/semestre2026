<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Estos son los codigos de las letras-->
    <link href="https://fonts.cdnfonts.com/css/black-hoops" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/neon-club-music" rel="stylesheet">
    <!--Estos son las "librerias" del Bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>         
    <title>Tomas Daniel Garza Moya</title>
</head>
<div>
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
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid --color-de-letras;
        }
    </style>

     <nav class="navbar navbar-light" style="background-color: #9bc6e5;">
            <div class="container">
                <a class="navbar-brand" href="index.html" style="color: black; font-family: 'La unica', sans-serif;">Inicio</a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unidad 1</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDripdownMenuLink">
                                <a class="dropdown-item" href="mostrar.php">Mostrar Datos</a><br>
                                <a class="dropdown-item" href="meterdatos.php">Meter Datos</a><br>
                                
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unidad 2</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDripdownMenuLink">
                                <a class="dropdown-item" href="relaciones01.php">Relaciones 1</a><br>
                                <a class="dropdown-item" href="relaciones01.php">Relaciones 2</a><br>
                                <a class="dropdown-item" href="relaciones01.php">Relaciones 3</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unidad 3</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDripdownMenuLink">
                                <a class="dropdown-item" href="#">Perfil</a><br>
                                <a class="dropdown-item" href="#">Calculadora</a><br>
                                <a class="dropdown-item" href="#">Tienda parte 1</a>
                            </div>
                        </li>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
</div>
<body>
    <style>
          h1,h2{
            font-family: 'NEON CLUB MUSIC', sans-serif;
            color: var(--color-extra);
            text-align: center;                                                                        
        }
        table{
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid --color-de-letras;
        }
    </style>
    <h1>Personajes de Marvel</h1>
    <h2>Personajes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Fecha de Creacion</th>
            <th>Descripcion</th>
            <th>Titulo del Comic</th>
            <th>Nombre del Superpoder</th>
        </tr>
    
    <?php
    $username = "root";
    $password = "";
    $server = "localhost";
    $database = "robin";
    $conexion = new mysqli($server, $username, $password, $database);
    if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
    }
    $sql ="SELECT
p.personajeID,
p.nombre AS nombre_personaje,
p.alias,
p.fechacreacion,
p.descripcion,
c.titulo,
s.nombre AS nombre_superpoder
FROM personajes p
LEFT JOIN personajecomic pc ON p.personajeID = pc.personajeID
LEFT JOIN comics c on pc.comicID = c.comicID
LEFT JOIN personajesuperpoder ps ON p.personajeID = ps.personajeID
LEFT JOIN superpoderes s ON ps.superpoderID = s.superpoderID";

$result = $conexion->query($sql);

if($result->num_rows >0){
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row['personajeID'] . "</td>";
        echo "<td>" . $row['nombre_personaje'] . "</td>";
        echo "<td>" . $row['alias'] . "</td>";
        echo "<td>" . $row['fechacreacion'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . $row['titulo'] . "</td>";
        echo "<td>" . $row['nombre_superpoder'] . "</td>";
        echo "</tr>";
    }
}else{
    echo "<tr><td colspan='7'>No se encontraron personajes</td></tr>";
}

$conexion->close();
?>
    </table>
</body>
</html>