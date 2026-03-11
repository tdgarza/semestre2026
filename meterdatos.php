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
    <title>Primera Pagina</title>
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
    h1 {
    color: var(--color-extra); /* Naranja característico de Batman */
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
    border: 1px solid yellow; /* Borde naranja */
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
    </style>
    <form method="post" action="procesar_formulario.php">
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
    
    <label for="fecha_creacion">Fecha de Creación:</label>
    <input type="date" name="fecha_creacion" required><br>
    <label for="descripcion">Descripción del Superhéroe:</label>
    <textarea name="descripcion" required></textarea><br>

     <!-- Botón para enviar el formulario -->
    <input type="submit" value="Guardar Datos">
</body>
</html>