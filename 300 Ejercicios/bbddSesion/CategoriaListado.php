<?php
	require_once "_Varios.php";
	condicionSuprema();

	$conexion = obtenerPdoConexionBD();

	// Los campos que incluyo en el SELECT son los que luego podré leer
    // con $fila["campo"].
	$sql = "SELECT id, nombre FROM categoria ORDER BY nombre";

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

<h1>Listado de Categorías</h1>

<table border='1'>

	<tr>
		<th>Nombre</th>
		<th></th>
	</tr>

	<?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'CategoriaFicha.php?id=<?=$fila["id"]?>'><?=$fila["nombre"]?></a></td>
            <td><a href='CategoriaEliminar.php?id=<?=$fila["id"]?>'>(X)                 </a></td>
        </tr>
	<?php } ?>

</table>

<br>

<a href='CategoriaFicha.php'>Crear entrada</a>

<br>
<br>

<a href='PersonaListado.php'>Gestionar listado de Personas</a>

</body>

</html>