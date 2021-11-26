<?php

declare(strict_types=1);

session_start();

function entrarSiSesionIniciada()
{
    if (comprobarRenovarSesion()) redireccionar("PersonasListado.php");
}

function salirSiSesionFalla()
{
    // if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
}

function comprobarRenovarSesion(): bool
{
    if (haySesionRAM()) {
        if (isset($_COOKIE["id"])) { // Basta con mirar si parece que viene cookie porque ya acabamos de validar la sesión RAM
            generarRenovarSesionCookie();
        }
        return true; // Esto es en todo caso
    } else { // NO hay sesión RAM
        $usuario = obtenerUsuarioPorCookie();
        if ($usuario) { // Equivale a if ($usuario != null)
            generarSesionRAM($usuario); // Canjear la sesión cookie por una sesión RAM.
            generarRenovarSesionCookie();
            return true;
        } else { // Ni RAM, ni cookie
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
    $filasObtenidas = $select->rowCount();

    if ($filasObtenidas == 0) return null;
    else return $select->fetch();
}

// Antiguo haySesionCookie(): bool
function obtenerUsuarioPorCookie(): ?array
{
    if (isset($_COOKIE["id"])) {
        $conexion = obtenerPdoConexionBD();

        $sql = "SELECT id, identificador, nombre FROM usuario
                WHERE id = ? AND BINARY codigoCookie = ? AND caducidadCodigoCookie >= ?";
        $select = $conexion->prepare($sql);
        $select->execute([
            $_COOKIE["id"],
            $_COOKIE["codigoCookie"],
            date("Y-m-d H:i:s", time()) // Fecha-hora de ahora mismo obtenida del sistema.
        ]);
        $filasObtenidas = $select->rowCount();

        if ($filasObtenidas == 0) return null;
        else return $select->fetch();
    } else {
        return null;
    }
}

function generarSesionRAM(array $usuario)
{
    // Guardar el id es lo único indispensable.
    // El resto son por evitar accesos a la BD a cambio del riesgo
    // de que mis datos en sesión RAM estén obsoletos.
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["identificador"] = $usuario["identificador"];
    $_SESSION["nombre"] = $usuario["nombre"];
}

function generarRenovarSesionCookie()
{
    $codigoCookie = uniqid(); // Genera un código aleatorio "largo".

    $fechaCaducidad = time() + 24 * 60 * 60;
    $fechaCaducidadParaBD = date("Y-m-d H:i:s", $fechaCaducidad);

    // Anotar en la BD el codigoCookie y su caducidad.
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=?, caducidadCodigoCookie=? WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $fechaCaducidadParaBD, $_SESSION["id"]]);

    // Crear (o renovar) las cookies.
    setcookie('id', strval($_SESSION["id"]), $fechaCaducidad);
    setcookie('codigoCookie', $codigoCookie, $fechaCaducidad);
}

function cerrarSesion()
{
    // Eliminar de la BD el codigoCookie y su caducidad.
    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL, caducidadCodigoCookie=NULL WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

    // Borrar las cookies.
    setcookie('id', "", time() - 3600);
    setcookie('codigoCookie', "", time() - 3600);

    // Destruir sesión RAM (implica borrar cookie de PHP "PHPSESSID").
    session_destroy();
}