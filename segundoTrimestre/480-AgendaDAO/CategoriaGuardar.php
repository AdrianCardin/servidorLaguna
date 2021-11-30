<?php
    require_once "__RequireOnceComunes.php";

    salirSiSesionFalla();


    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);
    $id = (int)$_REQUEST["id"];

    // Se recogen los datos del formulario de la request, excepto id.
    $nombre = $_REQUEST["nombre"];

    if (!$existe) {
        // Quieren CREAR una nueva entrada, así que es un INSERT.
        $categoria=DAO::categoriaCrear($nombre);

    } else { // Quieren actualizar, así que es un UPDATE.
        // Se recoge TAMBIÉN el id.

        $categoria=DAO::categoriaObtenerPorId($id);

        // obtengo el nombre para actualizar y lo cambio de categoria
        $categoria->setNombre($_REQUEST["nombre"]);
       
        DAO::categoriaActualizar($categoria);
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

<?php pintarCabecera(); ?>


    <?php if (!$existe) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?= $categoria->getNombre(); ?>.</p>
    <?php } else { ?>
        <h1>Actualización completada</h1>
        <p>Se han guardado correctamente los nuevos datos de <?= $categoria->getNombre();} ?></p>


<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>