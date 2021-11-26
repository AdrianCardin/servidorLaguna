<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    // salirSiSesionFalla();

    $conexion = obtenerPdoConexionBD();

    $sql = "
       SELECT
            p.id       AS p_id,
            p.nombre   AS p_nombre,
            p.telefono AS p_telefono,
            c.id       AS c_id,
            c.nombre   AS c_nombre
        FROM
           persona AS p INNER JOIN categoria AS c
           ON p.categoriaId = c.id
        ORDER BY p.nombre
    ";

    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $sentencia->fetchAll();

    // INTERFAZ:
    // $rs
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>] <a href='SesionCerrar.php'>Cerrar
    sesión</a>

<h1>Listado de Personas</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Categoría</th>
        <th></th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='PersonaFicha.php?id=<?= $fila["p_id"] ?>'><?= $fila["p_nombre"] ?></a></td>
            <td><a href='PersonaFicha.php?id=<?= $fila["p_id"] ?>'><?= $fila["p_telefono"] ?></a></td>
            <td><a href='CategoriaFicha.php?id=<?= $fila["c_id"] ?>'><?= $fila["c_nombre"] ?></a></td>
            <td><a href='PersonaEliminar.php?id=<?= $fila["p_id"] ?>'>(X) </a></td>
        </tr>
    <?php } ?>

</table>

<br>

<a href='PersonaFicha.php'>Crear entrada</a>

<br/>
<br/>

<a href='CategoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>