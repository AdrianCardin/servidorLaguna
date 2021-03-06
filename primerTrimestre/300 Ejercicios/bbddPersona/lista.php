<?php
require_once "../tools.php";
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
        $sql = "SELECT p.id as IdPersona, p.nombre AS NombrePersona ,p.categoriaId AS personaCategoriaId, p.estrella AS estrella, c.nombre AS NombreCategoria FROM categoria AS c , persona AS p WHERE p.categoriaId = c.id ORDER BY NombrePersona";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([]);
        $resultado = $select->fetchAll(); // obtiene los resultados


        if (isset($_REQUEST["eliminado"])) {
            echo"<div class='actualizado'>Se ha eliminado el componente</div>"; 
            echo "<br>";
        }if (isset($_REQUEST["actualizado"])) {
            echo"<div class='actualizado'>Se ha actualizado el componente</div>"; 
            echo "<br>";
        }if (isset($_REQUEST["creado"])) {
            echo"<div class='actualizado'>Se ha creado el componente</div>"; 
            echo "<br>";
        }
?>

<div class="tabla">
        <h1>Tabla resultado</h1>
        <table>
            <tr>
                <td>Favorito</td>
                <td>Nombre Persona</td>
                <td>Nombre Categoria</td>
                <td>Eliminar</td>
            </tr>
    

            <?php
            //nombres de la obtencion de bbdd con su id
            $idPersona="IdPersona";
            $personaCategoriaId="personaCategoriaId";
            $nombreCategoria="NombreCategoria";
            $estrella="estrella";
            foreach ($resultado as $fila) {
                echo "<tr><td><a href='autoFav.php?id=$fila[$idPersona]'><img src='star-png$fila[$estrella].png' alt='15px' width='15px'></a></td>";
                echo "<td><a href='ficha.php?id=$fila[$idPersona]'>" . $fila['NombrePersona'] . "</a></td>";
                if ($fila[$personaCategoriaId]==1) {
                    $class="Familia";
                }elseif ($fila[$personaCategoriaId]==3) {
                    $class="Trabajo";
                }elseif ($fila[$personaCategoriaId]==4) {
                    $class="Otros";
                }elseif ($fila[$personaCategoriaId]==8) {
                    $class="Estudios";
                }elseif($fila[$personaCategoriaId]==16){
                    $class="Prueba";
                }
                echo "<td class='$class'><a href='modificarNombreCategoria.php?id=$fila[$personaCategoriaId]&nombre=$fila[$nombreCategoria]'>" . $fila['NombreCategoria'] . "</a></td>";
                echo "<td><a href='eliminar.php?id=$fila[$idPersona]'> X </a></td></tr>";
            }
            ?>
        </table>
</div>
<a href="ficha.php" class="link">Pincha para crear</a>
</body>
</html>