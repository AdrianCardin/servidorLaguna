<?php
require "../tools.php";

$id=$_REQUEST["id"];// obtiene el id
$nombre=$_REQUEST["nombre"];
$apellidos=$_REQUEST["apellidos"];
$telefono=$_REQUEST["telefono"];
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
        $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono, $id]);
        header('Location:lista.php?actualizado');
        exit;
?>
</body>
</html>