<?php

require_once "__RequireOnceComunes.php";

salirSiSesionFalla();

cerrarSesion();

redireccionar("SesionFormulario.php?sesionCerrada");