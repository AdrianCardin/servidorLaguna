<?php

// El servidor se queda con la sesion 1 h (3600s)
ini_set('session.gc_maxlifetime', 3600);
session_start();

if (isset($_SESSION["acumulado"]) && !(isset($_REQUEST["reset"]))) {

    $acumulado = $_SESSION["acumulado"];
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
    $_SESSION["acumulado"] = 0;
}
$_SESSION["acumulado"] = $acumulado;
?>



<html>

<h1><?= $acumulado ?></h1>

<form method='post'>

    <input type='submit' value=' - ' name='resta'>
    <input type='number' name='diferencia' value='<?= $diferencia ?>'>
    <input type='submit' value=' + ' name='suma'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

</form>

</html>