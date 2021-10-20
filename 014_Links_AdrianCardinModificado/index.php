<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css2.css">
    <title>Links 2</title>
</head>

<body>
    <div class="link" border="2px">
        <p>Pincha en la decada que desea ir</p>
        <?php
            // genero los links y los redirecciono a validacion
            for ($i=1900; $i <= 2020 ; $i=$i+10) {  
                echo '<a href="https://www.google.com/search?q=' . $i . '" >'. $i .'</a>';
                echo '<br>';
            }

            ?>
    </div>


</body>

</html>