<?php
    include("./tools.php");

    session_set_cookie_params(3600);
    session_start();
    
    //guarda la palabra resultado
    if (isset($_POST["enviar"])) {
        if ((isset($_POST["palabraSolucion"]) )&& isset($_POST["letra"])) {
        //primera pasada
            $palabraSolucion=$_POST["palabraSolucion"];
            $letra=$_POST["letra"];
            $palabraEncriptada=encriptarPalabraCompleta($_POST["palabraSolucion"]);
        }
        
        $contador=0;
    }elseif(isset($_POST["seguirJugando"])){
        //resto de pasadas
            $palabraSolucion=$_SESSION["palabraSolucion"];
            $letra=$_POST["letra"];
            $palabraEncriptada=$_SESSION["palabraEncriptada"];
    }else{
        $palabraSolucion=$_SESSION["palabraSolucion"];
        $palabraEncriptada=$_SESSION["palabraEncriptada"];
        $contador=$_SESSION["contador"];
    }


    if (isset($_REQUEST["letra"])) {
        $letra=$_REQUEST["letra"];
    }else{
        $letra=$_SESSION["letra"];
    }


    // Si la palabra está contenida entra
    if (palabraContenida($palabraSolucion,$letra)) {
        //si has acertado la letra no te cuenta el turno
        $palabraEncriptada=desencriptar($palabraEncriptada,$palabraSolucion,$letra);
        $contador=$_SESSION["contador"];
    }else{ 
        //si fallas te cuenta el turno
        if (isset($_SESSION["contador"]) && isset($_REQUEST["seguirJugando"]) ) {
            $contador=$_SESSION["contador"]+1;
        }else{
            $contador=0;
            $palabraEncriptada=encriptarPalabraCompleta($_SESSION["palabraSolucion"]);
        }
    }

    $_SESSION["letra"]=$letra;
    $_SESSION["palabraSolucion"]=$palabraSolucion;
    $_SESSION["palabraEncriptada"]=$palabraEncriptada;
    $_SESSION["contador"]=$contador;
    
    // si se adivina terminas el juego
    if (adivinado($palabraSolucion,$palabraEncriptada)) {
        session_destroy();
        unset($_SESSION["palabraSolucion"]);
        unset($_SESSION["palabraEncriptada"]);
        unset($_SESSION["contador"]);
        header("Location:resuelto.php?solucion=$palabraSolucion&contador=$contador");
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css.css">
    <title>Encuentra la palabra</title>
</head>
<body>
    <div class="link">
        <form action="./juego.php" method="post">
            <h1>Letra encriptada</h1>
            <h2><?php echo $palabraEncriptada ?></h2>
            <h1>Letra</h1>
            <h2><?php echo $letra ?: "-"; ?></h2>
            <h1>Numero de fallos</h1>
            <h2><?php echo $contador ?></h2>
            <h1>Escribe una letra</h1>
            <input type="text" name="letra"  size="20" autofocus>
            <input type="submit" name="seguirJugando" value="Enviar">
        </form> 
    </div>
</body>
</html>
