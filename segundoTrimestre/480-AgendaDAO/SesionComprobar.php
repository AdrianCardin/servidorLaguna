<?php
    require_once "__RequireOnceComunes.php";
    
    entrarSiSesionIniciada();

    $usuario = obtenerUsuarioPorContrasenna($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

    if ($usuario) { // Equivale a if ($usuario != null)
        generarSesionRAM($usuario);

        if (isset($_REQUEST["recuerdame"])) {
            generarRenovarSesionCookie();
        }

        redireccionar("PersonaListado.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }

?>