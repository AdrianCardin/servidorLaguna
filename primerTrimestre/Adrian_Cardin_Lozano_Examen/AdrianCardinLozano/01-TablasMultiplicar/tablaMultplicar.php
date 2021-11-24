<?php
$numeroRandUno=rand(1,10);
$numeroRandDos=rand(1,10);
if (!isset($_COOKIE["racha"])) {
    setcookie("racha", 1, time() + 3600);
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
    <form action="resultado.php" method="post">
        <label >Numero uno</label>
        <input type="text" name="numeroUno"  value="<?php echo $numeroRandUno ?>" >
        <label >Numero dos</label>
        <input type="text" name="numeroDos"  value="<?php echo $numeroRandDos ?>" >
        <label >Resultado de la multiplicacion</label>
        <input type="text" name="resultado" id="resultado">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>