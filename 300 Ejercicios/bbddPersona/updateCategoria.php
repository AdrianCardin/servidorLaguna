<?php
require "../tools.php";    
    $id=$_REQUEST["id"];
    $nombre=$_REQUEST["nombre"];
    $conexion = conectarABBDD();
    $sql = "UPDATE categoria SET nombre=? WHERE id=?";
    $select = $conexion->prepare($sql); // se prepara la sql
    $select->execute([$nombre,$id]);
    header('Location:lista.php?actualizado');
    exit;

?>