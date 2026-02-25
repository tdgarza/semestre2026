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
        $creacion = $_POST['creacion'];
        $biografia = $_POST['biografia'];
       
        $sql = "INSERT INTO personajes (id, nombrereal, personaje, altura, peso, poderes, sexo, debilidad, creation, biografia) VALUES ('$nombrereal', '$personaje', '$altura', '$peso', '$poderes', '$sexo', '$debilidad', '$creacion', '$biografia')";
    
        if($conexion->query($sql)==TRUE){
            echo "Nuevo personaje creado con éxito.";
        }else{
            echo "Error al agregar al nuevo personaje.";
        }
        }
?>