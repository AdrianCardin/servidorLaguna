<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    if (esAdmin($_SESSION["id"])) {
        echo "Eres Admin";
    }else{
        echo "Eres Normal";
    }
    salirSiSesionFalla();

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

Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>] <a href='SesionCerrar.php'>Cerrar
    sesión</a>

<h1>Listado de Categorías</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th></th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
        <?php
        
        if (esAdmin($_SESSION["id"])) {
            // pongo el los codigos fuera porque si no , al tener tantas comas de man fallo
            $id="id";
            $nombre="nombre";
                                echo "<td><a href='CategoriaFicha.php?id=$fila[$id]'> $fila[$nombre] </a></td>";
                                echo "<td><a href='PersonaEliminar.php?id=$fila[$id]>(X) </a></td>";
        }else{
            $nombre="nombre";
                                echo "<td><p> $fila[$nombre]</p></td>";
                                echo "<td><p> (X) </p></td>";
        } 
        
        ?>
        </tr>
    <?php } ?>

</table>

<br>

<?php 
if (esAdmin($_SESSION["id"])) {
    echo "<a href='CategoriaFicha.php'>Crear entrada</a>";
}
?>


<br>
<br>

<a href='PersonaListado.php'>Gestionar listado de Personas</a>

</body>

</html>