<?php
    require_once "__RequireOnceComunes.php";

    salirSiSesionFalla();

    // Se recoge el parámetro "id" de la request.
    $id = (int)$_REQUEST["id"];

    $eliminadoCorrectamente=DAO::personaEliminarPorId($id);

    // INTERFAZ:
    // $sqlConExito
    // $correctoNormal
    // $noExistia
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php if ($eliminadoCorrectamente) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la persona.</p>

<?php }else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>