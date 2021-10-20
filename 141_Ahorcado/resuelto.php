<?php
$resultado=$_REQUEST["solucion"];
$contador=$_REQUEST["contador"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Resultado</title>
</head>
<body>
    <div class="link">  
        <h2>Enhorabuena , has conseguido resolver la palabra en <?php echo $contador;   ?> intentos. La palabra es <?php  echo $resultado;  ?></h2>
        <a href="./index.php">Pincha aqui para volver a jugar</a>
    </div>

</body>
</html>