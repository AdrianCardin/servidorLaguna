<?php
require "../tools.php";
$id=$_REQUEST["id"];
$conexion=conectarABBDD();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Eliminar</title>
</head>
<body>
    <?php
            $sql = "DELETE FROM Categoria WHERE id=?";
            $select = $conexion->prepare($sql); // se prepara la sql
            $select->execute([$id]);

    ?>
    <div class="actualizado">
       <p>Has eliminado el nombre</p> 
    <a href="lista.php">Pincha aqui para volver a listado</a>
    </div>
    
</body>
</html>