<?php
    require "../tools.php";
    session_start(); // se inicia la sesion

    if (isset($_REQUEST["comprobar"]) ) {
        echo"<div class='comprobar'> Vuelve a ingresar los campos </div>";
    }
    if (isset($_REQUEST["personaListado"]) ) {
        echo"<div class='comprobar'> Persona Listado </div>";
    }
    if (isset($_SESSION["codigoCookie"]) ) {
        header("Location:PersonaListado.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="formulario">
            <form action="SesionComprobar.php" method="post">
                <p>Usuario</p>
                <input type="text" name="identificador">
                <p>Contraseña</p>
                <input type="password" name="contrasenna">
                <input type="submit" value="Enviar">
            </form>
    </div>
    
</body>
</html>