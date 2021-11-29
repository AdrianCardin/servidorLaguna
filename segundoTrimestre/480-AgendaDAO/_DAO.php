<?php

require_once "_Clases.php";
require_once "_Varios.php";

class DAO
{
    private static ?PDO $conexion = null;

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "agenda"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            echo "\n\nError al conectar:\n" . $e->getMessage();
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }

        return $pdo;
    }

    private static function garantizarConexion()
    {
        if (Self::$conexion == null) {
            Self::$conexion = Self::obtenerPdoConexionBd();
        }
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        Self::garantizarConexion();

        $select = Self::$conexion->prepare($sql);
        $select->execute($parametros);
        return $select->fetchAll(); // Se devuelve "el $rs"
    }

    // Devuelve:
    //   - null: si ha habido un error
    //   - int: el id autogenerado para el nuevo registro, si todo bien.
    private static function ejecutarInsert(string $sql, array $parametros): ?int
    {
        Self::garantizarConexion();

        $insert = Self::$conexion->prepare($sql);
        $sqlConExito = $insert->execute($parametros);

        if (!$sqlConExito) return null;
        else return Self::$conexion->lastInsertId();
    }

    // Ejecuta un Update o un Delete.
    // Devuelve:
    //   - null: si ha habido un error
    //   - 0, 1 u otro número positivo: OK (no errores) y estas son las filas afectadas.
    private static function ejecutarUpdel(string $sql, array $parametros): ?int
    {
        Self::garantizarConexion();

        $updel = Self::$conexion->prepare($sql);
        $sqlConExito = $updel->execute($parametros);

        if (!$sqlConExito) return null;
        else return $updel->rowCount();
    }



    /* CATEGORÍA */

    private static function categoriaCrearDesdeFila(array $fila): Categoria
    {
        return new Categoria($fila["id"], $fila["nombre"]);
    }

    public static function categoriaObtenerPorId(int $id): ?Categoria
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM categoria WHERE id=?",
            [$id]
        );

        if ($rs) {
            $fila = $rs[0];
            $categoria = Self::categoriaCrearDesdeFila($fila);
            return $categoria;
        } else {
            return null;
        }
    }

    public static function categoriaObtenerTodas(): array
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM categoria ORDER BY nombre",
            []
        );

        $datos = [];
        foreach ($rs as $fila) {
            $categoria = Self::categoriaCrearDesdeFila($fila);
            array_push($datos, $categoria);
        }

        return $datos;
    }

    public static function categoriaCrear(string $nombre): ?Categoria
    {
        $idAutogenerado = Self::ejecutarInsert(
            "INSERT INTO categoria (nombre) VALUES (?)",
            [$nombre]
        );

        if ($idAutogenerado == null) return null;
        else return Self::categoriaObtenerPorId($idAutogenerado);
    }

    public static function categoriaActualizar(Categoria $categoria): ?Categoria
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE categoria SET nombre=? WHERE id=?",
            [$categoria->getNombre(), $categoria->getId()]
        );

        if ($filasAfectadas == null) return null;
        else return $categoria;
    }

    public static function categoriaEliminarPorId(int $id): bool
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "DELETE FROM categoria WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function categoriaEliminar(Categoria $categoria): bool
    {
        return Self::categoriaEliminarPorId($categoria->getId());
    }


    /* PERSONA */

    private static function personaCrearDesdeFila(array $fila): Persona
    {
        return new Persona($fila["id"], $fila["nombre"], $fila["apellidos"], $fila["telefono"], $fila["estrella"], $fila["categoriaId"]);
    }

    public static function personaObtenerPorId(int $id): ?Persona
    {
        $rs = Self::ejecutarConsulta(
            "SELECT * FROM persona WHERE id=?",
            [$id]
        );

        if ($rs) return Self::personaCrearDesdeFila($rs[0]);
        else return null;
    }

    public static function personaObtenerTodas(): array
    {
        $datos = [];

        $rs = Self::ejecutarConsulta(
            "SELECT * FROM persona ORDER BY nombre, apellidos",
            []
        );

        foreach ($rs as $fila) {
            $persona = Self::personaCrearDesdeFila($fila);
            array_push($datos, $persona);
        }
        
        return $datos;
    }

    public static function personaCrear(string $nombre, string $apellidos, string $telefono, bool $estrella, int $categoriaId): ?Persona
    {
        $idAutogenerado = Self::ejecutarInsert(
            "INSERT INTO persona (nombre, apellidos, telefono, estrella, categoriaId) VALUES (?, ?, ?, ?, ?)",
            [$nombre, $apellidos, $telefono, $estrella ? 1 : 0, $categoriaId]
        );

        if ($idAutogenerado == null) return null;
        else return Self::personaObtenerPorId($idAutogenerado);
    }

    public static function personaActualizar(Persona $persona): ?Persona
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "UPDATE persona SET nombre=?, apellidos=?, telefono=?, estrella=?, categoriaId=? WHERE id=?",
            [$persona->getNombre(), $persona->getApellidos(), $persona->getTelefono(), $persona->isEstrella() ? 1 : 0, $persona->getCategoriaId(), $persona->getId()]
        );

        if ($filasAfectadas = null) return null;
        else return $persona;
    }

    public static function personaEliminarPorId(int $id): bool
    {
        $filasAfectadas = Self::ejecutarUpdel(
            "DELETE FROM persona WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function personaEliminar(Persona $persona): bool
    {
        return Self::personaEliminarPorId($persona->id);
    }
}