<?php
$id=$_REQUEST["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Categoria Ficha</title>
</head>
<body>
    <div class="contenedor">
        <h1>Estas en la Categoria Ficha</h1>
        <p>Tu contenido es : <?=  $id ?></p>
    </div>
    
</body>
</html>