<?php

declare(strict_types=1);

session_start();

function obtenerPdoConexionBD(): PDO
{
	$servidor = "localhost";
	$bd = "agenda";
	$identificador = "root";
	$contrasenna = "";
	$opciones = [
		PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
	];

	try {
		$conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
	} catch (Exception $e) {
		syso("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
		exit("Error al conectar");
	}

	return $conexion;
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
	header("Location: $url");
	exit;
}

function syso(string $contenido)
{
	file_put_contents('php://stderr', $contenido . "\n");
}

function sesionIniciada(): bool
{
	return isset($_SESSION["id"]);
}

function destruirSesion()
{	
	//destruimos tambien la cookieCodigo
	setcookie("codigoCookie","borrar" ,time()-60);
    session_destroy();
    unset($_SESSION);
}
function destruirCookies()
{	
	//destruimos todas las cookies
	setcookie("recuerdame","borrar" ,time()-60);
	setcookie("codigoCookie","borrar" ,time()-60);
    setcookie("id","borrar" ,time()-60);
}
function updateCodigoCookie(int $codigoCookie , $id){
	$conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=? WHERE id=? ";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie,$id]); // Se añade el parámetro a la consulta preparada.
    
}
function updateCodigoCookieNullBBDD($id){
	$conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL WHERE id=? ";
    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    
}

function guardian($id , $codigoCookie){
	// obtenemos el id y el codigoCookie de la bbdd y la comparamos con lo que nos dan
	$conexion = obtenerPdoConexionBD();
    $sql = "SELECT codigoCookie FROM usuario WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->fetchAll();

	
	foreach ($obtenidas as $fila) {
		$codigoCookieBBDD=$fila["codigoCookie"];
	}

	if ($codigoCookie==NULL || $codigoCookieBBDD==NULL) {
		return false;
	}
	
	/*var_dump("Type of codigo Coo ---> " . gettype($codigoCookie));
	var_dump("<br>");
	var_dump("Type of codigo Coo BBDD ---> " . gettype($codigoCookieBBDD));
	var_dump("<br>");
	var_dump("Codigo cookie ---> " . $codigoCookie);
	var_dump("<br>");
	var_dump("Codigo cookie BBDD---> " . $codigoCookieBBDD);
	var_dump("<br>");
	var_dump("comparacion ---> " . strcmp($codigoCookie,$codigoCookieBBDD));
	*/
	
	return strcmp($codigoCookie,$codigoCookieBBDD) == 0;
}

function destruirCodigoCookie($id){

	$conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL WHERE id=? ";
    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
}

function llamadaGuardian(){
	// la llamada guardian te quiere echar

	if (isset($_COOKIE["id"]) && isset($_COOKIE["codigoCookie"])) {
		if (guardian($_COOKIE["id"],$_COOKIE["codigoCookie"]) || isset($_SESSION["id"])) {

		
			if ($_COOKIE["recuerdame"]=="on") {
				setcookie("id",$_COOKIE["codigoCookie"],time()+60); //cookie id
				setcookie("codigoCookie",$_COOKIE["codigoCookie"],time()+60); //cookie codigo 
			}else{
				setcookie("id",$_COOKIE["codigoCookie"],time()+60*20); //cookie id
				setcookie("codigoCookie",$_COOKIE["codigoCookie"],time()+60*20); //cookie codigo
			}
		


		
		//actualizamos el tiempo de la cookie cada vez que entre
		
    }else{
		redireccionar("SesionCerrar.php");
	}
	}
}

