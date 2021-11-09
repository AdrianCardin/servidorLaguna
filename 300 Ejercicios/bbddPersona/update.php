<?php
require "../tools.php";
    $nombre=$_REQUEST["nombre"];
    $apellidos=$_REQUEST["apellidos"];
    $telefono=$_REQUEST["telefono"];
    
    $conexion = conectarABBDD();
    if ($_REQUEST["id"]=="") {
        
        $sql = "INSERT INTO persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,0,1]);
        header('Location:lista.php?creado');
        exit;
    }else{
        $id=$_REQUEST["id"];// obtiene el id
        

        $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono, $id]);
        header('Location:lista.php?actualizado');
        exit;

    }



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
</body>
</html>