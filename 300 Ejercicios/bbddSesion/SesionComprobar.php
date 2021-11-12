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

        $sql = "SELECT identificador,contrasenna,codigoCookie FROM usuario WHERE identificador=? AND contrasenna=?";
        $select = $conexion->prepare($sql); // se prepara la sql
        $select->execute([$identificador,$contrasenna]);
        $resultado = $select->fetchAll(); // obtiene los resultados


        // guardamos los valores en variables
        foreach ($resultado as $valor) {
            $contrasennaBBDD=$valor["contrasenna"];
            $identificadorBBDD=$valor["identificador"];
            $codigoCookie=$valor["codigoCookie"];
            
        }
        var_dump("BBDD i ". $identificadorBBDD);
        var_dump( "BBDD C ".$contrasennaBBDD);
        var_dump( " BBDD Cookie -->> ".$codigoCookie);
        var_dump( " i ".$identificador);
        var_dump( " C ".$contrasenna);


        if(($identificadorBBDD==$identificador) && ($contrasennaBBDD == $contrasenna)){
            $_SESSION["id"]=$codigoCookie;
            header("Location:PersonaListado.php");
            exit;
        }else{
            header("Location:SesionFormulario.php?comprobar");
            exit;
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

</body>
</html>