<?php
$ciudades = [
    17 => "Donosti",
    8 => "Getafe",
    4 => "Toledo",
    71 => "Granada",
    52 => "Lugo",
    47 => "Zaragoza"
]; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>

    <label for="">Selecciona una ciudad : </label>
    <form action="">
        <select name="ciudad">
        <?php
        
        foreach ($ciudades as $key => $ciudad ) {
            echo '<option value="'. $key .'">' . $ciudad . '</option>';
        }
            
        ?>

    </form>

    </select>
    
</body>


</html>