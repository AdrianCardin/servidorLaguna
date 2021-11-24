<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    // --------------------------las variables de tipo check en el formulario se recibe como on o como null !!!!!!!
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