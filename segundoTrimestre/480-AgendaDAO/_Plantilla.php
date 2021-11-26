<?php
function pintarCabecera()
{
    ?>
    <header><h1>Aplicacion de agenda</h1>

    
   <p> Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>] <a href='SesionCerrar.php'>Cerrar sesión</a> </p>
   </header>
<?php
}

function pintarPie()
{
    ?>
    <footer><p>(c) DAW2 @ LDJ 2021</p></footer>
    <?php
}
