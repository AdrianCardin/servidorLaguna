<?php

function comprobarRenovarSesion()
{
    if (isset($_SESSION["id"])) {
        return true;
    } else {
        if (isset($_COOKIE["id"]) && isset($_COOKIE["codigoCookie"])) {
            $codigoCookie = $_COOKIE["codigoCookie"];
            $id = $_COOKIE["id"];

            $conexion = obtenerPdoConexionBD();
            $sql = "SELECT id, codigoCookie FROM usuario WHERE codigoCookie=? AND BINARY id=?";
            $select = $conexion->prepare($sql);
            $select->execute([$codigoCookie, $id]); // Se añade el parámetro a la consulta preparada.
            $obtenidas = $select->rowCount();

            if ($obtenidas == 1) {
                $fila = $select->fetch();

                //destruyo la cookie
                setcookie("id", 0, time() - 60);
                setcookie("codigoCookie", 0, time() - 60); // primero borramos la cookie que habia y creamos la nueva


                setcookie("codigoCookie", $codigoCookie, time() + 60 * 60 * 24); //cookie codigo   
                setcookie("id", $id, time() + 60 * 60 * 24); //cookie id

                //añado la sesion actualizada
                $_SESSION["id"] = $fila["id"];
                $_SESSION["identificador"] = $fila["identificador"];
                $_SESSION["nombre"] = $fila["nombre"];
                return true;
            } else {
                redireccionar("SesionFormulario.php");
            }


            // todo pasa correctamente!!!!!!!!
        }

        return false;
    }
}

function haySesionRAM()
{
    return isset($_SESSION["id"]);
}

function haySesionCookie()
{
    return isset($_COOKIE["id"]);
}

function generarSesionRAM()
{
    //??
}

function generarSesionCookie()
{
    //??
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


