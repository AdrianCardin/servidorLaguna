<?php
include("./tools.php");
//obtenemos los años validos
//uso el la funcion de tools
error_reporting(0);
$añosValidacion=arrayInput();
$año=$_GET["anno"];

if (in_array($año,$añosValidacion) ) {

}else {
    // si se obtiene una variable distinta a la que es permitida se autodirigirá a otra
    header("Location: ./redireccion.php");
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css2.css">
    <title>Decada</title>
</head>
<body>
    <div class="link">
           <p>Escoje el año</p>
        <?php
        
            
            for ($i=$año; $i <= $año+9 ; $i++) {  
                echo '<a href="./redireccion.php?anno='. $i .'&annno='. $año .'" >'. $i .'</a>';
                echo'<br>';
            }
                
        ?>    

    </div>

</body>
</html>