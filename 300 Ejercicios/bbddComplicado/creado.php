<?php
    require "../tools.php";
    $nombre = $_REQUEST["nombre"];
    $conexion = conectarABBDD();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Creado</title>
</head>

<body>
    <?php
    $sql = "INSERT INTO Categoria VALUE nombre=?";
    $select = $conexion->prepare($sql); // se prepara la sql
    $select->execute([$nombre]);

    ?>
    <div class="actualizado">
        <p>Se ha actualizado en la base de datos</p>
        <a href="lista.php">Pincha aqui para ir a la lista</a>
    </div>

</body>

</html>