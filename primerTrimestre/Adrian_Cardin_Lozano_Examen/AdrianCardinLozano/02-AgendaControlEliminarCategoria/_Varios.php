<?php
	declare(strict_types=1);

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
	function hayUsuarioBBDD($id){
	$conexionBD = obtenerPdoConexionBD();
	$sql = "SELECT persona.nombre FROM persona WHERE categoriaId=?";
    $select = $conexionBD->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $obtenidas = $select->rowCount();

	if ($obtenidas==0) {
		return false;
	}else{
		return true;
	}
	}
?>
