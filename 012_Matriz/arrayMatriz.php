<?php
    //creo una funcion para meter las columnas que quieras en un array
    function generarFila(int $numeroColumnas){
        $array = array();
        for ($i=1; $i <= $numeroColumnas ; $i++) {
            $randomNumber = rand(-100,100);
            array_push($array, $randomNumber);
        }
        return $array;
    }

    $numeroDeColumnas=12;
    $array["fila_1"]=generarFila($numeroDeColumnas);
    $array["fila_2"]=generarFila($numeroDeColumnas);
    $array["fila_3"]=generarFila($numeroDeColumnas);
    $array["fila_4"]=generarFila($numeroDeColumnas);
    $array["fila_5"]=generarFila($numeroDeColumnas);
    $array["fila_6"]=generarFila($numeroDeColumnas);
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css.css" type="text/css">
    <title>Array Matriz</title>
</head>

<body>
    <table border="2px">
        <?php


        //funciona recorriendo los arrays padres
        foreach($array as $fila => $arrayContenido){
            echo '<tr>';
            echo '<th class="caja">'. $fila .'</th>';
            // funciona recorriendo el contenido del array hijo
            foreach($arrayContenido as $contenidoArray){
                if($contenidoArray>0){
                    echo '<td class="positivo">'. $contenidoArray .'</td>';
                }else if($contenidoArray<0){
                    echo '<td class="negativo">'. $contenidoArray .'</td>';
                }else{
                    echo '<td class="cero">'. $contenidoArray .'</td>';
                }

            }
            echo '</tr>';
        }

        ?>
    </table>
</body>

</html>