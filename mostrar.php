<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h1>Aqui voy a mostrar mi tabla</h1>
    <h3>Tomas Garza</h3>

    <?php
    $username = "root";
    $password = "";
    $server = "localhost";
    $database = "batman";
    $conexion = new mysqli($server, $username, $password, $database);
    if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
    }
    $sql ="SELECT * FROM personajes";
    $resultado = $conexion->query($sql);

    if($resultado->num_rows >0){
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Personaje</th><th>Altura</th><th>Peso</th><th>Poderes</th><th>Sexo</th><th>Debilidad</th><th>Creacion</th><th>Biografia</th></tr>";
        while($row = $resultado->fetch_assoc()){
             echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["personaje"] . "</td><td>" . $row["altura"] ."</td><td>" . $row["peso"] . "</td><td>" . $row["poderes"] . "</td><td>" . $row["sexo"] . "</td><td>" . $row["debilidad"] . "</td><td>" . $row["creacion"] . "</td><td>" . $row["biografia"] . "</td></tr>";
        }
        echo "</table>";
    }else{
        echo "No se encontraron registros en la base de datos";
    }
    $conexion->close();

    ?>

</body>
</html>