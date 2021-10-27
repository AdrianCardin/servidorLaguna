<?php
function adivinado($resultado, $posibleResultado){
    if ($resultado == $posibleResultado) {
        return true;
    }
        return false;
    }
 
function encriptarPalabraCompleta($palabra){
    // separo la palabra en letras
    $arrayLetras=str_split($palabra);
    $contadorAsteriscos=sizeof($arrayLetras);
    $resultado="";
    //sustituyo las letras por * 
    for ($i=0; $i < $contadorAsteriscos ; $i++) { 
        $resultado =$resultado ."*";
    }
    return $resultado;
} 
function palabraContenida($palabra,$letra){
    $arrayPalabra=str_split($palabra);

    return in_array($letra, $arrayPalabra);
}

function desencriptar($palabraEncriptada,$solucion,$letra){
    $desencriptado="";
    
    for ($i=0; $i < strlen($solucion) ; $i++) { 
        if($solucion[$i]==$letra){
            $desencriptado=$desencriptado . $letra;
        }elseif($palabraEncriptada[$i]!="*"){
            //lo dejamos tal cual
            $desencriptado=$desencriptado. $palabraEncriptada[$i];
        }else{
            $desencriptado=$desencriptado. "*";
        }
    } 
return $desencriptado;
}

?>