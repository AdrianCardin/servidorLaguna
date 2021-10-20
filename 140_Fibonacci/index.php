<?php

if (isset($_POST["enviar"])) {
    $sumando=((int)$_REQUEST["acumulado"]);
    $acumulado=((int)$_REQUEST["resultado"]);
    $resultado=$sumando+$acumulado;

    
}else{
    $sumando=0;
    $acumulado=1;
    $resultado=$sumando+$acumulado;
}

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
            <input type="hidden" name="sumando" value="<?php echo $sumando ?>" size="20" >
            <input type="hidden" name="acumulado" value="<?php echo $acumulado ?>" size="20" >
            <input type="hidden" name="resultado" value="<?php echo $resultado ?>" size="20" >
            <h2><?php echo $sumando . ' + ' . $acumulado . ' = '. $resultado; ?></h2>
            <input type="submit" name="enviar" value="Enviar">
            <input type="submit" name="reset" value="Reiniciar">
        </form>
    </div>
</body>
</html>