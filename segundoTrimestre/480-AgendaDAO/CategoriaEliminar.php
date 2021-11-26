<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    salirSiSesionFalla();

    
    $id = (int)$_REQUEST["id"];

    $eliminadoCorrectamente=DAO:: categoriaEliminarPorId($id);


?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php pintarCabecera(); ?>

<?php if ($eliminadoCorrectamente) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la categoría.</p>

<?php  } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la categoría.</p>

<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>


<?php pintarPie(); ?>
</body>

</html>