<?php
//añade los años validos para la validación
// la manera mas segura es poner todos los años de golpe y no se podrá modificar la validacion
function arrayInput(){
    $array=array();
    for ($i=1900; $i < 2020; $i=$i+10) { 
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