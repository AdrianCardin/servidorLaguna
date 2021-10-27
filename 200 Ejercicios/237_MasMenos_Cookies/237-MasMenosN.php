<?php

if (isset($_COOKIE["cookie237"]) && !(isset($_REQUEST["reset"]))) {

    $acumulado = $_COOKIE["cookie237"];
    isset($_REQUEST["diferencia"]) ? $diferencia = $_REQUEST["diferencia"] : $diferencia = 1;

    if (isset($_REQUEST["resta"])) {
        $acumulado = $acumulado - $diferencia;
    } elseif (isset($_REQUEST["suma"])) {
        $acumulado = $acumulado + $diferencia;
    }
} else {
    // Si NO hay formulario enviado (1ª vez), o piden resetear.
    $acumulado = 0;
    isset($_REQUEST["diferencia"]) ? $diferencia = $_REQUEST["diferencia"] : $diferencia = 1;
}

if (isset($_REQUEST["reset"])) {
    setcookie("cookie237", $acumulado = 0, time() - 3600);
}
setcookie("cookie237", $acumulado, time() + 3600);
?>



<html>

<h1><?= $acumulado ?></h1>

<form method='get'>

    <input type='submit' value=' - ' name='resta'>
    <input type='number' name='diferencia' value='<?= $diferencia ?>'>
    <input type='submit' value=' + ' name='suma'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

    <br /><br />

    <a href='<?= $_SERVER["PHP_SELF"] ?>?reset'>Resetear otra version</a>

</form>

</html>