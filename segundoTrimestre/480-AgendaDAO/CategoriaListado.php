<?php
    require_once "__RequireOnceComunes.php";

    // salirSiSesionFalla();


    $categorias=DAO::categoriaObtenerTodas();

    // INTERFAZ:
    // $rs
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>
<?php pintarCabecera(); ?>

<h1>Listado de Categorías</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th></th>
    </tr>

    <?php foreach ($categorias as $categoria) { ?>
        <tr>
            <td><a href='CategoriaFicha.php?id=<?= $categoria->getId(); ?>'><?= $categoria->getNombre(); ?></a></td>
            <td><a href='CategoriaEliminar.php?id=<?= $categoria->getId(); ?>'>(X) </a></td>
        </tr>
    <?php } ?>

</table>

<br>

<a href='CategoriaFicha.php'>Crear entrada</a>

<br>
<br>

<a href='PersonaListado.php'>Gestionar listado de Personas</a>


<?php pintarPie(); ?>
</body>

</html>