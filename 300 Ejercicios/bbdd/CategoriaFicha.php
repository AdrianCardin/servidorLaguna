<?php
require "../tools.php";

$conexion=conectarABBDD();
// tiene que recibir un id y lo ponemos en hidden

    $id=$_REQUEST["id"];
    $sql = "SELECT * FROM Categoria WHERE id=? ORDER BY Nombre ";
    $select = $conexion->prepare($sql); // se prepara la sql
    $select->execute([$id]);
    $resultado = $select->fetchAll(); // obtiene los resultados

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Categoria Ficha</title>
</head>
<body>
    <div class="contenedor">
        <h1>Estas en la Categoria Ficha</h1>
        <p>Estas en la categoria de : </p>
        <input type="hidden" name="id" value=<?= $resultado[0]["id"] ?>>
        <input type="text" value=<?= $resultado[0]["nombre"] ?>>
    </div>
    
</body>
</html>