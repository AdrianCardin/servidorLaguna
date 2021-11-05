<?php
    require "../tools.php";
    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $telefono = $_REQUEST["telefono"];
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
        $sql = "INSERT INTO persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,0,1]);
        header('Location:lista.php?creado');
        exit;
    ?>

</body>

</html>