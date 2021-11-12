<?php

require_once "_Varios.php";

if (sesionIniciada()) {
    destruirSesion();
}

redireccionar("SesionFormulario.php");