<?php
include("./tools.php");
$año=$_GET["anno"];   
$añoEncuestion=$_GET["annno"];         
$añosValidacion=ArrayAnno($añoEncuestion);


 if (in_array($año,$añosValidacion)) {
    header("Location: https://www.google.com/search?q=$año");
 }else{
    echo "<p>Has modificado el codigo y se te va a redirigir a la pagina principal</p>";
    echo '<br>';
    echo '<a href="./index.php" > Pincha para ir al principio </a>';
 }           
                
?> 