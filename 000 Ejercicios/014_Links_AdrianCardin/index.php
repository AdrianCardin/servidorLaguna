<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Links</title>
</head>
<body>
    <div class="formulario">
        <form action="redirigimiento.php" method="post">
            <h2>Escoja el año</h2>
            <select name="año">
            <label for="">Secciona un año</label>
            <?php
            
            for ($i=1900; $i <= 2019 ; $i++) {  
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