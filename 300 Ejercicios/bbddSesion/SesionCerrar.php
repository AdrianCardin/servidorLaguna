<?php

require_once "_Varios.php";

if (sesionIniciada()) {
    destruirSesion();
    destruirCodigoCookie($_SESSION["id"]);
    //ponemos a null el valor de la cookie en la bbdd
    updateCodigoCookieNullBBDD($_COOKIE["id"]);
}

redireccionar("SesionFormulario.php");