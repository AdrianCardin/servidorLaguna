<?php
require "../tools.php";

$conexion=conectarABBDD();
if (isset($_REQUEST["id"])) {
    // tiene que recibir un id y lo ponemos en hidden
    
        $id=$_REQUEST["id"];
        $sql = "SELECT * FROM persona WHERE id=? ORDER BY Nombre ";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$id]);
        $resultado = $select->fetchAll(); // obtiene los resultados

        $id=$resultado[0]["id"];
        $nombre=$resultado[0]["nombre"];
        $apellido=$resultado[0]["apellidos"];
        $telefono=$resultado[0]["telefono"];
}else{
    //no viene id
    $id="";
    $nombre="";
    $apellido="";
    $telefono="";
}
    $sqlCategoria="SELECT id,nombre FROM categoria ORDER BY nombre ";
    $selectCategoria = $conexion->prepare($sqlCategoria); // se prepara la sql
    $selectCategoria->execute([]);
    $resultadoCategoria = $selectCategoria->fetchAll(); // obtiene los resultados

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Ficha Persona</title>
</head>
<body>
    <div class="contenedor">
        <form action="update.php" method="post">
            <h1>Estas en la Categoria Ficha</h1>
            <p>Estas en la categoria de : </p>
            <input type="hidden" name="id" value=<?= $id ?>>
            <p>Nombre : </p>
            <input type="text" name="nombre" value=<?= $nombre ?>>
            <p>Apellido : </p>
            <input type="text" name="apellidos" value=<?= $apellido ?>>
            <p>telefono : </p>
            <input type="text" name="telefono" value=<?= $telefono ?>>
            <p>Categoria : </p>
            <select name="CategoriaId" >
                    <?php
                    foreach ($resultadoCategoria as $valor) {
                       echo "<option value=".$valor["id"]." >".$valor["nombre"];    
                       echo "</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Enviar">
        </form>
    </div>
    
</body>
</html>