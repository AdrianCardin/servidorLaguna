<?php
$operadores=array(
    "+" => "SUMA",
    "-" => "RESTA",
    "*" => "MULTIPLICACION",
    "/" => "DIVISION"
)
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Operadores</title>
</head>
<body>
    <div class="link">
        <form action="./redirigimiento.php" method="GET">
            <h2>Escriba primer numero</h2>
            <input type="number" name="primerNumero" size="20" required><br><br>
            <select name="operador" >
                
                <?php
                    foreach ($operadores as $signo => $valor) {
                       echo" <option value='$signo'>$valor</option>";
                    }
                ?>
            </select>
            <h2>Escriba segundo numero</h2>
            <input type="text" name="segundoNumero" size="20" required ><br>
        <br>
        <br>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>