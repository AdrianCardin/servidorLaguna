<?php
require "../tools.php";
    $nombre=$_REQUEST["nombre"];
    $apellidos=$_REQUEST["apellidos"];
    $telefono=$_REQUEST["telefono"];
    
    var_dump($categoria);
    
    $conexion = conectarABBDD();
    if ($_REQUEST["id"]=="") {
        
        $sql = "INSERT INTO persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,0,$categoria]);
        header('Location:lista.php?creado');
        exit;
    }else{
        $id=$_REQUEST["id"];// obtiene el id
        $categoria=$_REQUEST["CategoriaId"]; // obtiene el id de la categoria de la persona
        

        $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, categoriaId=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,$categoria, $id]);
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