<?php
require "../tools.php";
    $id=$_REQUEST["id"];
    $nombre=$_REQUEST["nombre"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">  
    <title>Update</title>
</head>
<body>
        <form action="updateCategoria.php" method="post">
            <p>Modificar Palabra : </p>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="text" name="nombre" value=<?= $nombre ?>>
            <input type="submit" value="Cambiar">
        </form>
</body>
</html>