<?php
require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla();


$conexion = obtenerPdoConexionBD();

// Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
// Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
// (y $existe tomará true).
$existe = isset($_REQUEST["id"]);

// Se recogen los datos del formulario de la request, excepto id.
$nombre = $_REQUEST["nombre"];

if (!$existe) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO categoria (nombre) VALUES (?)";
    $parametros = [$nombre];
} else { // Quieren actualizar, así que es un UPDATE.
    // Se recoge TAMBIÉN el id.
    $id = (int)$_REQUEST["id"];

    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE categoria SET nombre=? WHERE id=?";
    $parametros = [$nombre, $id];
}

$sentencia = $conexion->prepare($sql);

//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);


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
?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>