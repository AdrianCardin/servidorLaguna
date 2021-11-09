<?php
require "../tools.php";    
    $id=$_REQUEST["id"];// obtiene el id
    $conexion = conectarABBDD();
    $sql = "SELECT * FROM persona WHERE id=? ORDER BY Nombre ";
    $select = $conexion->prepare($sql); // se prepara la sql
    $select->execute([$id]);
    $resultado = $select->fetchAll(); // obtiene los resultados

    $boolean=$resultado[0]["estrella"];
    if ($boolean==0) {

        $sql = "UPDATE persona SET estrella=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([1, $id]);
        //header('Location:lista.php?actualizado');
        //exit;


    }else{
        
        $sql = "UPDATE persona SET estrella=? WHERE id=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([0, $id]);
        //header('Location:lista.php?actualizado');
        //exit;
    }


    header('Location:lista.php?actualizado');
    exit;

?>