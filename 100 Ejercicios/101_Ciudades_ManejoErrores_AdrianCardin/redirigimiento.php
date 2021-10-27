<?php
    $ciudadFavorita=$_GET["ciudad"];
    // con este trimp borro los espacios y puntos
    $ciudadFavorita=trim($ciudadFavorita, " \t. ");
    $ciudadFavorita=ucfirst(strtolower($ciudadFavorita));
    
    if ($ciudadFavorita=="") {
        header("Location:./index.php?error");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Tu ciudad famorita</title>
</head>
<body>
    <div class="link">
        <?php
            echo "<p>Tu ciudad favorita es : $ciudadFavorita</p>";
            echo "<a href=https://www.google.com/search?q=$ciudadFavorita>Pincha para buscarlo en Google</a>";

        ?>
        <a href="<?=$_SERVER["HTTP_REFERER"]?>">Atras</a>
    </div>

    
</body>
</html>