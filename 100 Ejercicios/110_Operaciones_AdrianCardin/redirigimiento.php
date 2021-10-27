<?php
    $primerNumero=(int)$_GET["primerNumero"];
    $segundoNumero=(int)$_GET["segundoNumero"];
    $operador=$_GET["operador"];
    $resultado; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Resultado</title>
</head>
<body>
    <div class="link">
        <?php
            error_reporting(0);
            echo "<p>El resultado es " ;
        
            switch ($operador) {
                case '+':
                    $resultado=$primerNumero+$segundoNumero;
                    echo "$primerNumero $operador $segundoNumero = $resultado";
                    break;
                case '-':
                    $resultado=$primerNumero-$segundoNumero;
                    echo "$primerNumero $operador $segundoNumero = $resultado";
                    break;
                case '*':
                    $resultado=$primerNumero*$segundoNumero;
                    echo "$primerNumero $operador $segundoNumero = $resultado";
                    break;
                case '/':
                    if($segundoNumero==0){
                        header("Location:error.php");
                    }else{
                        $resultado=$primerNumero/$segundoNumero;
                        echo "$primerNumero $operador $segundoNumero = $resultado";
                    }
                    break;
                }
               echo " </p>";
        ?>
    </div>
</body>
</html>