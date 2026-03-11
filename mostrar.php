
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
                                <a class="dropdown-item" href="#">Perfil</a><br>
                                <a class="dropdown-item" href="#">Calculadora</a><br>
                                <a class="dropdown-item" href="#">Tienda parte 1</a>
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
</div>
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
        echo "<tr><th>ID</th><th>Nombre</th><th>Personaje</th><th>Altura</th><th>Peso</th><th>Poderes</th><th>Sexo</th><th>Debilidad</th><th>Creacion</th><th>Biografia</th><th>Imagen</th></tr>";
    
        //con el while siguiente, va a darle vueltas al codigo de la base de datos para obtener todos los resultados posibles, la parte de "$" me dice que declaro la variable en php, y el nombre entre comillas seran los encabezados de la tabla del mySQL. como es un codigo "hibrido" lo que ponga entre comillas con el td, th, tr, sera la mezcla entre php y el html

        while($row = $resultado->fetch_assoc()){

             echo "<tr>
             <td>" . $row["id"] . "</td>
             <td>" . $row["nombre"] . "</td>
             <td>" . $row["personaje"] . "</td>
             <td>" . $row["altura"] ."</td>
             <td>" . $row["peso"] . "</td>
             <td>" . $row["poderes"] . "</td>
             <td>" . $row["sexo"] . "</td>
             <td>" . $row["debilidad"] . "</td>
             <td>" . $row["creacion"] . "</td>
             <td>" . $row["biografia"] . "</td>
             <td>"; //este td, abre la nueva columna para la imagen.
             //este if solo va a comprobar si hay imagen o no, puede o no puede estar. pero le da la elegancia de que si no esta una imagen por cualquier motivo, solo pondra esa parte, igual pueden poner una URL con otra imagen que muestre que esta vacia la onda. 

             if(!empty($row["imagen"])){
                echo "<img src='data:image/jpeg;base64,".base64_encode($row["imagen"])."'>";
             }else{
                echo "Sin Imagen";
             } echo "</td></tr>";
        }
        echo "</table>";
    }else{
        echo "No se encontraron registros en la base de datos";
    }
    $conexion->close();

    ?>

</body>
</html>