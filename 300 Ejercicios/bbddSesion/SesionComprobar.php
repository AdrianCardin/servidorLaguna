<?php
    require_once "_Varios.php";

    if (sesionIniciada()) {
        redireccionar("PersonaListado.php");
        exit;
    }

    $identificador = $_REQUEST["identificador"];
    $contrasenna = $_REQUEST["contrasenna"];

    $conexion = obtenerPdoConexionBD();
    $sql = "SELECT id, identificador, nombre FROM usuario WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->rowCount();

    if ($obtenidas == 1) {
        $fila = $select->fetch();
        $_SESSION["id"] = $fila["id"];
        $_SESSION["identificador"] = $fila["identificador"];
        $_SESSION["nombre"] = $fila["nombre"];
    redireccionar("PersonaListado.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }
?>