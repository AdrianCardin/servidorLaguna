    <?php
        $boolean=false;
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boolean</title>
    </head>

    <body>
        <?php
            if ($boolean) {
                echo "<p>Hola</p>";  
            }else {
                echo "<p>Adios</p>"; 
            }
        ?>
    </body>

    </html>