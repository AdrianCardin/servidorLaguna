<?php
            session_set_cookie_params(3600); // convierte los parametros de la sesion en cookies dentro de la sesion y no del navegador
            session_start(); // se inicia la sesion

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