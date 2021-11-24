<?php
// numero de filas
$numfilas=9;
// contador de filas
$contador_filas = 1;
echo "<pre>";
for ($i = $numfilas ;  $i > 0 ;  $i--) {

    // Se imprimen "i" espacios en blanco al comienzo de cada fila
    for ($j = 0; $j <$i; $j++) {
        echo "&nbsp";
    }
        
    //se añade los numeros que faltan para llega a numero de filas
    for ($k = 1; $k <= $contador_filas; $k++) {
        echo $contador_filas ." ";
    }
    echo "<br>";
    /* Se incrementa el contador de filas */
    $contador_filas++;
}
echo "</pre>";