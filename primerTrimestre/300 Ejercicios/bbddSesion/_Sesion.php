<?php

function comprobarRenovarSesion()
{
    if (haySesionRAM()) {
        if (isset($_COOKIE["id"])) {
            generarRenovarSesionCookie();
        }
        return true;
    } else {
        $usuario = obtenerUsuarioPorCookie();
        if ($usuario) {
            generarSesionRAM($usuario);
            generarRenovarSesionCookie();
            return true;
        } else {
            return false;
        }
    }
}

function haySesionRAM()
{
    return isset($_SESSION["id"]);
}
function obtenerUsuarioPorContraseña(string $identificador, string $contrasenna)
{

    $conexion = obtenerPdoConexionBD();
    $sql = "SELECT id, identificador, nombre FROM usuario WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->rowCount();

    if ($obtenidas == 0) {
        return null;
    }else{
         return $select->fetch();
    }
}

function generarRenovarSesionCookie()
{
    //return isset($_SESSION["id"]);
    $codigoCookie = uniqid();

    $fechaCaducidad = time() + 24 * 60 * 60;
    $fechaCaducidadParaBD = date("Y-m-d" , $fechaCaducidad);

    setcookie("id" , strval($_SESSION["id"]), $fechaCaducidad);
    setcookie("codigoCookie" , $codigoCookie, $fechaCaducidad);

    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=? , caducidadCodigoCookie=? WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $fechaCaducidadParaBD, $_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->rowCount();
}


function obtenerUsuarioPorCookie(): ?array
{
    if (isset($_SESSION["id"])) {
        if (isset($_COOKIE["id"]) && isset($_COOKIE["codigoCookie"])) {
            $codigoCookie = $_COOKIE["codigoCookie"];
            $id = $_COOKIE["id"];

            $conexion = obtenerPdoConexionBD();
            $sql = "SELECT id, identificador , codigoCookie FROM usuario WHERE BINARY codigoCookie=? AND BINARY id=? and caducidadCodigoCookie=?";
            $select = $conexion->prepare($sql);
            $select->execute([$codigoCookie, $id, date("T-m-d H:i:s", time())]); // Se añade el parámetro a la consulta preparada.
            $obtenidas = $select->rowCount();

            if ($obtenidas == 0) {
                return null;
            } else return $select->fetch();
        }

        return false;
    }
}

function generarSesionRAM()
{
    //??
}

function generarSesionCookie(array $usuario)
{
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["identificador"] = $usuario["identificador"];
    $_SESSION["nombre"] = $usuario["nombre"];
}

function renovarSesionCookie()
{
    //?? ya se hace 
}

function destruirSesion()
{

    //borramos la cookie de bbdd
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL, caducidadCodigoCookie=NULL WHERE id=? ";
    $select = $conexion->prepare($sql);
    $select->execute([$_SESSION["id"]]);

    //destruimos tambien la cookieCodigo
    session_destroy();
    unset($_SESSION);
    setcookie("recuerdame", "borrar", time() - 60);
    setcookie("codigoCookie", "borrar", time() - 60);
    setcookie("id", "borrar", time() - 60);
}

function entrarSiSesionIniciada()
{
    if (comprobarRenovarSesion()) {
        redireccionar("PersonasListado.php");
    }
}

function salirSiSesionFalla()
{
    if (!comprobarRenovarSesion()) {
        redireccionar("SesionFormulario.php");
    }
}
