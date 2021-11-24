<?php

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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Conexion a bbdd</title>
</head>

<body>
    <?php
        $sql = "SELECT * FROM Categoria ORDER BY Nombre";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([]);
        $resultado = $select->fetchAll(); // obtiene los resultados

    ?>

    <div class="tabla">
        <h1>Tabla resultado</h1>
        <table>
            <tr>
                <td>Nombre</td>
            </tr>
    

            <?php
            //nombres de la obtencion de bbdd con su id
            $idAyuda="id";
            foreach ($resultado as $fila) {
                echo "<tr><td><a href='CategoriaFicha.php?id=$fila[$idAyuda]'>" . $fila['nombre'] . "</a></td></tr>";
            }
            ?>

        </table>
    </div>
</body>

</html>