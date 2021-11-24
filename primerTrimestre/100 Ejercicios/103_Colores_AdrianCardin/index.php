<?php
            
    $colores=array(
        "red" => "Rojo",
        "blue" =>"Azul",
        "green" =>"Verde",
        "yellow" =>"Amarillo",
        "brown" =>"Marron",
        "purple" =>"Morado"
    );
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css.css">
    <title>Links</title>
</head>
<body>
    <div class="link">
        <form action="./redirigimiento.php" method="get">
            <h2>Escoja el color</h2>
            <select name="color">
            <?php
            
                foreach ($colores as $key=>$color) {
                    echo "<option value=$key>$color </option>";
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