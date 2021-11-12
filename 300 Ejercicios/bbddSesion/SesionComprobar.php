<?php
    require "../tools.php";
    session_set_cookie_params(3600);
    session_start(); // se inicia la sesion
    $identificador=$_REQUEST["identificador"];
    $contrasenna=$_REQUEST["contrasenna"];
    

    if (isset($_SESSION["codigoCookie"])) {
        header("Location:PersonaListado.php");
        exit;
    }else{
        $contrasennaBBDD="";
        $identificadorBBDD="";
        $codigoCookie="";
        $conexion=conectarABBDD(); 

        $sql = "SELECT identificador,contrasenna,codigoCookie,id FROM usuario WHERE identificador=? AND contrasenna=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$identificador,$contrasenna]);
        $resultado = $select->fetchAll(); // obtiene los resultados


        // guardamos los valores en variables
        foreach ($resultado as $valor) {
            $contrasennaBBDD=$valor["contrasenna"];
            $identificadorBBDD=$valor["identificador"];
            $codigoCookie=$valor["id"];
            
        }


        if(($identificadorBBDD==$identificador) && ($contrasennaBBDD == $contrasenna)){
            $_SESSION["codigoCookie"]=$codigoCookie;
            header("Location:PersonaListado.php");
            exit;
        }else{
            header("Location:SesionFormulario.php?comprobar");
            exit;
        }
    }


?>