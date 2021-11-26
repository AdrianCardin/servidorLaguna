<?php

require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla();

cerrarSesion();

redireccionar("SesionFormulario.php?sesionCerrada");