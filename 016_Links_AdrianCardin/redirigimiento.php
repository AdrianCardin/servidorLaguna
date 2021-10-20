<?php
error_reporting(0);
$decada=$_POST["decada"];
if (isset($decada)) {
    header("Location: https://www.google.com/search?q=$decada");
    
}
$año=$_POST["año"];

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
    <div class="formulario">
            <form action="redirigimiento.php" method="post">
                <h2>Escoja la año</h2>
                <select name="decada">
                <label for="">Secciona un año</label>
                <?php
                
                for ($i=$año; $i <= $año+9 ; $i++) {  
                    echo '<option value="'. $i .'">' . $i . '</option>';
                }
                    
                ?>
        
            </select>
            <br>
            <br>
            <input type="submit" value="Buscar"/>
        </form>
    </div>

</body>
</html>