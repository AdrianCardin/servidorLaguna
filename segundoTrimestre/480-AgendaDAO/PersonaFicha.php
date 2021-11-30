<?php
    require_once "__RequireOnceComunes.php";

    salirSiSesionFalla();

    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una persona existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    if (!$existe) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
        $persona=new Persona(0,"","","",false, "");
    } else { 
        // Quieren VER la ficha de una entrada existente, cuyos datos se cargan.
        // Se recoge el parámetro "id" de la request.
        $personaId = (int)$_REQUEST["id"];

        $persona=DAO::personaObtenerPorId($personaId);

    }

    $categorias=DAO::categoriaObtenerTodas();


    // INTERFAZ:
    // $existe
    // $personaId
    // $personaNombre
    // $persona...
    // ...
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php pintarCabecera(); ?>

<h1><?= (!$existe) ? "Nueva persona" : "Ficha de persona" ?></h1>

<form method='post' action='PersonaGuardar.php'>

    <?php if ($existe) { ?>
        <input type='hidden' name='id' value='<?= $persona->getId() ?>'/>
    <?php } ?>

    <label for='nombre'>Nombre</label>
    <input type='text' id='nombre' name='nombre' value='<?= $persona->getNombre(); ?>'/>

    <br><label for='apellidos'>Apellidos</label>
    <input type='text' id='apellidos' name='apellidos' value='<?= $persona->getApellidos(); ?>'/>

    <br><label for='telefono'>Telefono</label>
    <input type='text' id='telefono' name='telefono' value='<?= $persona->getTelefono(); ?>'/>

    <br><label for='estrella'>Estrella</label>
    <input type='text' id='estrella' name='estrella' value='<?= $persona->isEstrella(); ?>'/>

    <br><label for='categoriaId'>Categoría</label>
    <select id='categoriaId' name='categoriaId'>
        <?php
        foreach ($categorias as $categoria) {

            if ($persona->perteneceA($categoria)) $seleccion = "selected";
            else                                  $seleccion = "";

            echo "<option value=' ".$categoria->getId()." ' $seleccion>". $categoria->getNombre() ."</option>";

            // Alternativa (peor):
            // if ($categoriaId == $personaCategoriaId) echo "<option value='$categoriaId' selected>$categoriaNombre</option>";
            // else                                     echo "<option value='$categoriaId'         >$categoriaNombre</option>";
        }
        ?>
    </select>

    <br><br>
    <?php if (!$existe) { ?>
        <input type='submit' name='crear' value='Crear persona'/>
    <?php } else { ?>
        <input type='submit' name='actualizar' value='Actualizar cambios'/>
    <?php } ?>

</form>

<?php if ($existe) { ?>
    <br/>
    <a href='PersonaEliminar.php?id=<?= $personaId ?>'>Eliminar persona</a>
<?php } ?>

<br/>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>