<?php
// hacemos la conexion

    $servidor = "localhost";
    $identificador = "root";
    $contrasenna = "";
    $bd = "agenda";

    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // Modo emulación desactivado para prepared statements "reales"
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }


// tiene que recibir un id y lo ponemos en hidden

$id=$_REQUEST["id"];
    $sql = "SELECT * FROM Categoria where id=$id ORDER BY Nombre ";
    $select = $conexion->prepare($sql); // se prepara la sql
    $select->execute([]);
    $resultado = $select->fetchAll(); // obtiene los resultados

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Categoria Ficha</title>
</head>
<body>
    <div class="contenedor">
        <h1>Estas en la Categoria Ficha</h1>
        <p>Estas en la categoria de : </p>
        <input type="text" value=<?= $resultado[0]["nombre"] ?>>
    </div>
    
</body>
</html>