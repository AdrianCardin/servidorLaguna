<?php
    require "../tools.php";
    $conexion=conectarABBDD();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Lista</title>
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
                echo "<tr><td><a href='ficha.php?id=$fila[$idAyuda]'>" . $fila['nombre'] . "</a></td>";
                echo "<td><a href='eliminar.php?id=$fila[$idAyuda]'> X </a></td></tr>";
            }
            ?>
        </table>
    
</body>
</html>