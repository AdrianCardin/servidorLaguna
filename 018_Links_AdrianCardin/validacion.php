<?php
include("./tools.php");
//obtenemos los años validos
//uso el la funcion de tools
error_reporting(0);
$annoFinal=$_GET["annoFinal"];
$annoInicio=$_GET["annoInicio"];
$añosValidacion=arrayInput($annoInicio,$annoFinal);
$año=$_GET["anno"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Decada</title>
</head>
<body>
    <div class="link">
           <p>Escoje el año</p>
        <?php
        
        if (in_array($año,$añosValidacion) ) {

            for ($i=$año; $i <= $año+9 ; $i++) {  
                echo"<p>Año$i</p>";
                echo "<a href='https://www.google.com/search?q= $i' >Google</a><br>";
                echo "<a href='https://www.google.com/search?q=$i &rlz=1C1FKPE_esES971ES971&source=lnms&tbm=isch' >Google imagenes</a><br>";
                echo "<a href='https://www.google.com/maps/search/$i' >Maps</a><br>";
                echo "<a href='https://es.wikipedia.org/wiki/$i' >Wikipedia</a><br>";
            
            }
        }else {
            // si se obtiene una variable distinta a la que es permitida se autodirigirá a otra
            header("Location: ./redireccion.php");
            
        }
            
                
        ?>    

    </div>
</body>
</html>