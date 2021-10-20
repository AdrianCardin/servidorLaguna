<?php
    include "./tools.php";

    //guarda la palabra resultado
    if (isset($_POST["enviar"])) {
        if (isset($_POST["palabraSolucion"]) && isset($_POST["letra"])) {
        //primera pasada
            $palabraSolucion=strtolower($_POST["palabraSolucion"]);
            $letra=$_POST["letra"];
            $palabraEncriptada=encriptarPalabraCompleta($_POST["palabraSolucion"]);
            $contador=0;
        }
    } elseif(isset($_POST["seguirJugando"])) {
        //resto de pasadas
            $palabraSolucion=$_POST["palabraSolucion"];
            $letra=$_POST["letra"];
            $palabraEncriptada=$_POST["palabraEncriptada"];
    }

    // Si la palabra está contenida entra
    if (palabraContenida($palabraSolucion, $letra)) {
        //si has acertado la letra no te cuenta el turno
        $palabraEncriptada=desencriptar($palabraEncriptada,$palabraSolucion,$letra);
        $contador=$_POST["contador"];
    } else {
        //si fallas te cuenta el turno
        if (isset($_POST["contador"])) {
            $contador=$_POST["contador"]+1;
        }else{
            $contador=0;
        }
    }


    
    // si se adivina terminas el juego
    if (adivinado($palabraSolucion,$palabraEncriptada)) {
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
            <input type="hidden" name="palabraSolucion" value="<?php echo $palabraSolucion ?>" size="20" >
            <input type="hidden" name="palabraEncriptada" value="<?php echo $palabraEncriptada ?>" size="20" >
            <input type="hidden" name="contador" value="<?php echo $contador ?>" size="20" >
            <h1>Letra encriptada</h1>
            <h2><?php echo $palabraEncriptada ?></h2>
            <h1>Letra</h1>
            <h2><?php echo $letra ?: "-"; ?></h2>
            <h1>Numero de intentos</h1>
            <h2><?php echo $contador ?></h2>
            <h1>Escribe una letra</h1>
            <input type="text" name="letra"  size="20" >
            <input type="submit" name="seguirJugando" value="Enviar">
        </form>
    </div>
</body>
</html>
