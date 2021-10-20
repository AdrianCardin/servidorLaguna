<?php
//añade los años validos para la validación
function arrayInput($inicio,$final){
    $array=array();
    for ($i=$inicio; $i < $final+9; $i=$i+10) {
        array_push($array,$i);
    }
    return $array;
}
function ArrayAnno(int $decada){
    $array=array();
    for ($i=$decada; $i < $decada+9; $i++) { 
        array_push($array,$i);
    }
    return $array;
}
?>