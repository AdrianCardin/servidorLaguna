<?php

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "pets";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        syso("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit("Error al conectar");
    }

    return $conexion;
}
$conexion = obtenerPdoConexionBD();

// Los campos que incluyo en el SELECT son los que luego podré leer
// con $fila["campo"].
$sql = "SELECT duenno.nombre AS nombreDuenno , cats.nombre AS nombreCats from cats INNER JOIN duenno WHERE cats.id_duenno = duenno.id";

$sentencia = $conexion->prepare($sql);
$sentencia->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $sentencia->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Mascotas-Dueño</h1>

<table border='1'>

    <tr>
        <th>Nombre dueño</th>
        <th>Nombre mascota</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        
        <tr>
            <td><p><?=  $fila["nombreDuenno"] ?></p></td>
            <td><p><?= $fila["nombreCats"] ?></p></td>
        </tr>
    <?php } ?>

</table>

<br>

</body>

</html>
