<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    salirSiSesionFalla();

    $conexionBD = obtenerPdoConexionBD();

    // Se recoge el parámetro "id" de la request.
    $id = (int)$_REQUEST["id"];

    $sql = "DELETE FROM persona WHERE id=?";

    $sentencia = $conexionBD->prepare($sql);

    //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
    $sqlConExito = $sentencia->execute([$id]); // Se añade el parámetro a la consulta preparada.

    //Se cargan variables boolean según la cantidad de filas afectadas por la ultima sentencia sql.

    // Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
    $correctoNormal = ($sqlConExito && $sentencia->rowCount() == 1);

    // Caso raro: cero filas afectadas... (No existía la fila en la BD)
    $noExistia = ($sqlConExito && $sentencia->rowCount() == 0);

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

<?php if ($correctoNormal) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la persona.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe la persona que se pretende eliminar (quizá la eliminaron en paralelo o, ¿ha manipulado Vd. el parámetro
        id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>