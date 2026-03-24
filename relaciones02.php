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
            color: white;
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
    <h1>CINE</h1>
    <h2>Peliculas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Años</th>
            <th>Director</th>
            <th>Actores</th>
            <th>Personajes</th>
        </tr>
    
    <?php
    $username = "root";
    $password = "";
    $server = "localhost";
    $database = "cine"; //<----aqui le cambio a mi base de datos ultima llamada cine

    $conexion = new mysqli($server, $username, $password, $database);
    if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
    }
    $sql ="SELECT
    p.PeliculaID,
    p.Titulo,
    p.AnioLanzamiento, 
    d.Nombre AS Director, 
   
    GROUP_CONCAT(DISTINCT a.Nombre SEPARATOR ', ') AS Actores,
    GROUP_CONCAT(DISTINCT pa.Personaje SEPARATOR ', ') AS Personajes
    
    FROM Peliculas p
    LEFT JOIN Directores d ON p.DirectorID = d.DirectorID
    LEFT JOIN PeliculaActor pa ON p.PeliculaID = pa.PeliculaID
    LEFT JOIN Actores a ON pa.ActorID = a.ActorID
    GROUP BY p.PeliculaID";

    $result = $conexion->query($sql);

    if($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['PeliculasID'] . "</td>";
            echo "<td>" . $row['Titulo'] . "</td>";
            echo "<td>" . $row['AnioLanzamiento'] . "</td>";
            echo "<td>" . $row['Director'] . "</td>";
            echo "<td>" . $row['Actores'] . "</td>";
            echo "<td>" . $row['Personajes'] . "</td>";
            echo "</tr>";
        }
    }else{
        echo "<tr><td colspan='9'> No se encontraron personajes. </td></tr>";
    }
        $conn->close();
    ?>
    </table>
</body>
</html>