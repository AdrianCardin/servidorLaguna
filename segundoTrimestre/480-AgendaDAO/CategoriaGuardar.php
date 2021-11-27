<?php
    require_once "__RequireOnceComunes.php";

    salirSiSesionFalla();


    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    // Se recogen los datos del formulario de la request, excepto id.
    $nombre = $_REQUEST["nombre"];

    if (!$existe) {
        // Quieren CREAR una nueva entrada, así que es un INSERT.
        DAO::categoriaCrear($nombre);

    } else { // Quieren actualizar, así que es un UPDATE.
        // Se recoge TAMBIÉN el id.
        $id = (int)$_REQUEST["id"];

        $categoriaNombre=DAO::categoriaObtenerPorId($id);
        // Quieren MODIFICAR una categoría existente y es un UPDATE.
        $nombre=$categoriaNombre->getNombre();
        $id=$categoriaNombre->getId();
        $correcto=DAO::categoriaActualizar($categoriaNombre);
    }


    // INTERFAZ:
    // $existe
    // $correcto
    // $datosNoModificados
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>] <a href='SesionCerrar.php'>Cerrar
    sesión</a>

<?php
// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datosNoModificados) { ?>
    <?php if (!$existe) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?= $nombre ?>.</p>
    <?php } else { ?>
        <h1>Actualización completada</h1>
        <p>Se han guardado correctamente los nuevos datos de <?= $nombre ?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada, pero se ha quedado Vd. a gusto pulsando el botón de actualizar
                :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if (!$existe) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva categoría.</p>
    <?php } else { ?>
        <h1>Error en la actualización.</h1>
        <p>No se han podido actualizar los datos de la categoría.</p>
    <?php } ?>

    <?php
}
var_dump($existe);
?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>