<?php
	require_once "_Varios.php";

    llamadaGuardian();
	// Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
	// Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
	// (y $existe tomará true).
	$existe = isset($_REQUEST["id"]);

 	if (!$existe) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
		$categoriaNombre = "";
	} else { // Quieren VER la ficha de una entrada existente, cuyos datos se cargan.
        // Se recoge el parámetro "id" de la request.
        $categoriaId = (int)$_REQUEST["id"];

    	$conexion = obtenerPdoConexionBD();
		$sqlCategoria = "SELECT nombre FROM categoria WHERE id=?";
        $select = $conexion->prepare($sqlCategoria);
        $select->execute([$categoriaId]); // Se añade el parámetro a la consulta preparada.
        $fila = $select->fetch();
		
		 // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
		$categoriaNombre = $fila["nombre"];
	}



	// INTERFAZ:
    // $existe
    // $categoriaId
    // $categoriaNombre
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<h1><?= (!$existe) ? "Nueva categoría" : "Ficha de categoría" ?></h1>

<form method='get' action='CategoriaGuardar.php'>

    <?php if ($existe) { ?>
        <input type='hidden' name='id' value='<?=$categoriaId?>' />
    <?php } ?>

    <label for='nombre'>Nombre</label>
    <input type='text' id='nombre' name='nombre' value='<?=$categoriaNombre?>' />

    <br><br>
    <?php if (!$existe) { ?>
        <input type='submit' name='crear' value='Crear categoría' />
    <?php } else { ?>
        <input type='submit' name='actualizar' value='Actualizar cambios' />
    <?php } ?>

</form>

<?php if ($existe) { ?>
    <br />
    <a href='CategoriaEliminar.php?id=<?=$categoriaId?>'>Eliminar categoría</a>
<?php } ?>

<br />

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>