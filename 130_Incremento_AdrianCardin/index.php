<?php

if (isset($_POST["+1"])) {
    if (isset($_REQUEST["acumulado"])) {
        $acumulado=$_REQUEST["acumulado"]+1;
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
            <input type="number" name="acumulado" value="<?php echo $acumulado ?>" size="20"><br><br>              
            <br>
            <br>
            <input type="submit" name="+1" value="+1"/>
            <input type="submit" name="reset" value="Reset"/>
    </form>
</body>
</html>