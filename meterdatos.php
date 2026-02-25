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