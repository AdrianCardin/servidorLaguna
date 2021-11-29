<?php
    require_once "__RequireOnceComunes.php";

    // salirSiSesionFalla();

    $personas=DAO::personaObtenerTodas();

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

    <?php foreach ($personas as $persona) { ?>
        <tr>
            <td><a href='PersonaFicha.php?id=<?= $persona->getId(); ?>'><?= $persona->getNombre(); ?></a></td>
            <td><a href='PersonaFicha.php?id=<?= $persona->getId(); ?>'><?=  $persona->getTelefono(); ?></a></td>
            <td><a href='CategoriaFicha.php?id=<?= $persona->getId(); ?>'><?=  "categoria" /*$persona->obtenerCategoria();*/ ?></a></td>
            <td><a href='PersonaEliminar.php?id=<?= $persona->getId(); ?>'>(X) </a></td>
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