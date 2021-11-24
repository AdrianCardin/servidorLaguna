<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();

	// Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
	// Sin embargo, si VIENE id quieren VER la ficha de una persona existente
	// (y $existe tomará true).
	$existe = isset($_REQUEST["id"]);

	// Se recogen los datos del formulario de la request, excepto id.
	$nombre = $_REQUEST["nombre"];
	$apellidos = $_REQUEST["apellidos"];
	$telefono = $_REQUEST["telefono"];
    $categoriaId = (int)$_REQUEST["categoriaId"];

	if (!$existe) {
		// Quieren CREAR una nueva entrada, así que es un INSERT.
 		$sql = "INSERT INTO persona (nombre, apellidos, telefono, categoriaId) VALUES (?, ?, ?, ?)";
        $parametros = [$nombre, $apellidos, $telefono, $categoriaId];
	} else { // Quieren actualizar, así que es un UPDATE.
        // Se recoge TAMBIÉN el id.
    	$id = (int)$_REQUEST["id"];

		// Quieren MODIFICAR una persona existente y es un UPDATE.
 		$sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, categoriaId=? WHERE id=?";
        $parametros = [$nombre, $apellidos, $telefono, $categoriaId, $id];
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
			<p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
		<?php } else { ?>
			<h1>Actualización completada</h1>
			<p>Se han guardado correctamente los nuevos datos de <?=$nombre?>.</p>

			<?php if ($datosNoModificados) { ?>
				<p>En realidad, no había modificado nada, pero se ha quedado Vd. a gusto pulsando el botón de actualizar :)</p>
			<?php } ?>
		<?php }
?>

<?php
	} else {
?>

    <?php if (!$existe) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva persona.</p>
    <?php } else { ?>
        <h1>Error en la actualización.</h1>
        <p>No se han podido actualizar los datos de la persona.</p>
    <?php } ?>

<?php
	}
?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>