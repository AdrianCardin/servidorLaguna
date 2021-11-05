<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Crear</title>
</head>
<body>   
    <div class="contenedor">
        <form action="categoriaCreado.php" method="post">
            <h1>Estas en la Persona Ficha</h1>
            <p>Nombre </p>
            <input type="text" name="nombre">
            <p>Apellidos</p>
            <input type="text" name="apellidos">
            <p>telefono</p>
            <input type="number" name="telefono">
            <input type="submit" value="Enviar">
        </form>
    </div>
    
</body>
</html>