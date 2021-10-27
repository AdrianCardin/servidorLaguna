<?php

session_set_cookie_params(3600);
session_start();

if (isset($_POST["enviar"])) {
    $sumando=($_SESSION["acumulado"]);
    $acumulado=($_SESSION["resultado"]);
    $resultado=$sumando+$acumulado;

    
}else{
    $sumando=0;
    $acumulado=1;
    $resultado=$sumando+$acumulado;
}

$_SESSION["sumando"] = $sumando;
$_SESSION["acumulado"] = $acumulado;
$_SESSION["resultado"] = $resultado;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Fibonacci</title>
</head>
<body>
    <div class="link">
        <form action="./index.php" method="post">
            <h2><?php echo $sumando . ' + ' . $acumulado . ' = '. $resultado; ?></h2>
            <input type="submit" name="enviar" value="Enviar">
            <input type="submit" name="reset" value="Reiniciar">
        </form>
    </div>
</body>
</html>