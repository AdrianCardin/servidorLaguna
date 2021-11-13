<?php
    require_once "_Varios.php";

    // --------------------------las variables de tipo check en el formulario se recibe como on o como null !!!!!!!
    

    $identificador = $_REQUEST["identificador"];
    $contrasenna = $_REQUEST["contrasenna"];

    $conexion = obtenerPdoConexionBD();
    $sql = "SELECT id, identificador, nombre FROM usuario WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->rowCount();

    if ($obtenidas == 1) {
        $fila = $select->fetch();

        //añadimos numero aleatorio para añadir el codigoCookie(bbdd) . Después lo guardamos en una cookie y en la bbdd
        $numeroAleatorio=random_int(0,300);
        //creo la cookie
        setcookie("id",0,time()-60);
        setcookie("codigoCookie",0,time()-60); // primero borramos la cookie que habia y creamos la nueva
        if ($_REQUEST["recuerdame"]=="on") {
            setcookie("recuerdame","on",time()+60*60*24);
            setcookie("codigoCookie",$numeroAleatorio,time()+60*60*24); //cookie codigo   
            setcookie("id",$fila["id"],time()+60*60*24); //cookie id
        }
        // actualizamos el codigo en la bbdd
        updateCodigoCookie( $numeroAleatorio, $fila["id"]);

        $_SESSION["id"] = $fila["id"];
        $_SESSION["identificador"] = $fila["identificador"];
        $_SESSION["nombre"] = $fila["nombre"];

        // todo pasa correctamente!!!!!!!!

        redireccionar("PersonaListado.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }
?>