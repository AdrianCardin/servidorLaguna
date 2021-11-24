<?php
$resultadoUsuario=$_POST["resultado"];
$numeroUno=$_REQUEST["numeroUno"];
$numeroDos=$_REQUEST["numeroDos"];
$resultadoCorrecto=$numeroUno*$numeroDos;

if ($resultadoCorrecto==$resultadoUsuario) {
    setcookie("racha", $_COOKIE["racha"] + 1, time() + 3600);
    echo "<p>Tienes correcta la solucion</p>";
}else{
    echo "<p>NO es correcta la solucion y has perdido tu racha</p>";
    unset($_SESSION);
    setcookie("racha", "borrar", time() - 60);
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
    <a href="tablaMultplicar.php">Pincha para volver a empezar</a>
    <p>Tu racha es de <?php
     if(isset($_COOKIE["racha"])){
                            echo $_COOKIE["racha"]; }else{
                                echo 0 ;
    } ?></p>
</body>
</html>