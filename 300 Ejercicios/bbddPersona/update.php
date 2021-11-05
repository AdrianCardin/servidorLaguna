<?php
require "../tools.php";

$id=$_REQUEST["id"];// obtiene el id
$nombre=$_REQUEST["nombre"];
$conexion=conectarABBDD();

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
<?php
        $sql = "UPDATE persona SET nombre=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre, $id]);

?>
    <div class="actualizado">
        <p>Se ha actualizado en la base de datos</p>
        <a href="lista.php">Pincha aqui para ir a la lista</a>
    </div>
</body>
</html>