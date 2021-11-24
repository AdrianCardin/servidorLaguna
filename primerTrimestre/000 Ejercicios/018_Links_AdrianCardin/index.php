<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Links 2</title>
</head>
<body>
    <div class="link" border="2px">
            <p>Pincha en la decada que desea ir</p>
            <?php
            $annoInicio=1900;
            $annoFinal=2020;
            // genero los links y los redirecciono a validacion
            for ($i=$annoInicio; $i <= $annoFinal ; $i=$i+10) {
                echo "<a href='./validacion.php?anno=$i&annoInicio=$annoInicio&annoFinal=$annoFinal'>$i</a><br>";
                
            }

            ?>     
    </div>

    
</body>
</html>