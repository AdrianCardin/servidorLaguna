<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Incremento</title>
</head>
<body>
    <div class="link">
        <form action="./juego.php" method="POST">
            <h2>Escriba la palabra a resolver</h2>
            <input type="hidden" name="letra" value="" size="20" >
            <input type="password" name="palabraSolucion" size="20" >
            <input type="submit" name="enviar" value="Enviar"/>
        </form>
    </div>    
</body>
</html>