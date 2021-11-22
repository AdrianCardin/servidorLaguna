<?php

declare(strict_types=1);

session_start();

function entrarSiSesionIniciada()
{
    if (comprobarRenovarSesion()) redireccionar("PersonaListado.php");
}

function salirSiSesionFalla()
{
    if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
}

function comprobarRenovarSesion(): bool
{
    if (haySesionRAM()) {
        if (isset($_COOKIE["id"])) { // comprobamos si hay una cookie para renovarla
            generarRenovarSesionCookie();
        }
        return true; // Esto es en todo caso
    } else { // no hay sesion RAM
        $usuario = obtenerUsuarioPorCookie();
        if ($usuario) { // equivale a if ($usuario != null)
            generarSesionRAM($usuario); //Canjear cookie por sesio RAM
            generarRenovarSesionCookie();
            return true;
        } else { // Ni RAM ni COOKIE
            return false;
        }
    }
}

function haySesionRAM(): bool
{
    return isset($_SESSION["id"]);
}

function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
{

    $conexion = obtenerPdoConexionBD();

    $sql = "SELECT id, identificador, nombre FROM usuario 
            WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $obtenidas = $select->rowCount();


    if ($obtenidas == 0) return null;
    else return $select->fetch();

}

// antiguo haySesionCookie():bool
function obtenerUsuarioPorCookie(): ?array
{
    if (isset($_COOKIE["id"])) {
        $conexion = obtenerPdoConexionBD();

        $sql = "SELECT id, identificador, nombre FROM usuario 
                WHERE id=? and BINARY codigoCookie=? and caducidadCodigoCookie >= ?";
        $select = $conexion->prepare($sql);
        $select->execute([
            $_COOKIE["id"],
            $_COOKIE["codigoCookie"],
            date("Y-m-d H:i:s", time())
        ]);

        $obtenidas = $select->rowCount();

        if ($obtenidas == 0) return null;
        else return $select->fetch();
    } else {
        return null;
    }
}

function generarSesionRAM(array $usuario)
{
    // guardar el id es lo mas importante
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["identificador"] = $usuario["identificador"];
    $_SESSION["nombre"] = $usuario["nombre"];
}

function generarRenovarSesionCookie()
{
    $codigoCookie = uniqid(); // Aleatorio unico

    $fechaCaducidad = time() + 24 * 60 * 60;
    $fechaCaducidadDB = date("Y-m-d H:i:s", $fechaCaducidad);

    // actualizar en la bd el codigoCookie y su caducidad
    $conexion = obtenerPdoConexionBD();

    $sql = "UPDATE usuario SET codigoCookie=?,caducidadCodigoCookie=? WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $fechaCaducidadDB, $_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

    // crear o renovar las cookies
    setcookie('id', strval($_SESSION["id"]), $fechaCaducidad);
    setcookie('codigoCookie', $codigoCookie, $fechaCaducidad);
}

function cerrarSesion()
{
    // Eliminar de la BD el codigoCookie y caducidadCodigoCookie
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL,caducidadCodigoCookie=NULL WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

    // Borrar Cookies
    setcookie('id', "", time() - 3600);
    setcookie('codigoCookie', "", time() - 3600);

    // Destruir Sesion RAM (PHPSESSID)
    session_destroy();
}