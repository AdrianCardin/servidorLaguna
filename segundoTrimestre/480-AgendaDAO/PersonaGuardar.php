<?php
    require_once "__RequireOnceComunes.php";

    salirSiSesionFalla();


    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una persona existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);
    var_dump($existe);


    if (!$existe) {
        DAO::personaCrear(
            $_REQUEST["nombre"],
            $_REQUEST["apellidos"],
            $_REQUEST["telefono"],
            0,
            (int)$_REQUEST["categoriaId"]);
    } else { 
        // Quieren actualizar, así que es un UPDATE.
        // Se recoge TAMBIÉN el id.

        $persona=new Persona
        (
            (int)$_REQUEST["id"],
            $_REQUEST["nombre"],
            $_REQUEST["apellidos"],
            $_REQUEST["telefono"],
            $_REQUEST["estrella"],
            (int)$_REQUEST["categoriaId"]
        );
    }

    $persona=DAO::personaActualizar($persona);


    // INTERFAZ:
    // $existe
    // $correcto
    // $datosNoModificados
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>
    
<?php pintarCabecera(); ?>


    <?php if ($existe) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?= $persona->getNombre() ?>.</p>
    <?php } else { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva persona.</p>
    <?php }
    ?>


<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>