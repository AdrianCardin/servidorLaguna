<?php

if (isset($_POST["sumar"])) {
    if (isset($_REQUEST["acumulado"]) && isset($_REQUEST["sumando"]) ) {
        $sumando=((int)$_REQUEST["sumando"]);
        $acumulado=((int) $_REQUEST["acumulado"])+((int)$_REQUEST["sumando"]);
    }

}else{
        $acumulado=0;
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Incremento</title>
</head>
<body>
    <div class="link">
        <form action="./index.php" method="POST">
            <h2>Incrementa</h2>
            <p>Sumando 1</p>
            <input type="number" name="acumulado" value="<?php echo $acumulado ?>" size="20"><br><br>
            <p>Sumando 2</p>              
            <input type="number" name="sumando" value="<?php echo $sumando ?>" size="20" value="1"><br><br>
            <br>
            <br>
            <input type="submit" name="sumar" value="Sumar"/>
            <input type="submit" name="reset" value="Reset"/>
    </form>
</body>
</html>