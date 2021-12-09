<?php

require_once "_com/DAO.php";

// TODO ###

$resultado = DAO::categoriaEliminarPorId($_REQUEST["id"]);

echo json_encode($resultado);