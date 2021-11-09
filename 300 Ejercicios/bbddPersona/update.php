<?php
require "../tools.php";
    $nombre=$_REQUEST["nombre"];
    $apellidos=$_REQUEST["apellidos"];
    $telefono=$_REQUEST["telefono"];
    $categoria=$_REQUEST["CategoriaId"]; // obtiene el id de la categoria de la persona
    $favorito=$_REQUEST["favorito"];
    $boolean = $favorito=="on" ? 1 : 0 ;

    $conexion = conectarABBDD();
    if ($_REQUEST["id"]=="") {
        
        $boolean = $favorito=="on" ? 1 : 0 ;
        $sql = "INSERT INTO persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,$boolean,$categoria]);
        header('Location:lista.php?creado');
        exit;
    }else{
        $id=$_REQUEST["id"];// obtiene el id
        

        $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?,estrella=?, categoriaId=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$nombre,$apellidos,$telefono,$boolean,$categoria,$id]);
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