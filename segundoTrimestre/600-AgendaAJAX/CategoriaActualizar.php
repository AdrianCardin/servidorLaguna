<?php

require_once "_com/Clases.php";
require_once "_com/DAO.php";

$categoria = new Categoria($_REQUEST["id"],$_REQUEST["nombre"]);

$categoria = DAO::CategoriaActualizar($categoria);

echo json_encode($categoria);