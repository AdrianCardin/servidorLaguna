<?php
    $mysql=new mysqli("localhost", "root","","despliegue");

    $salida= "";
    $query="SELECT duenno.nombre AS nombreDuenno , cats.nombre AS nombreCats from cats INNER JOIN duenno WHERE cats.id_duenno = duenno.id";

    if (isset($_POST["consulta"])) {
        $q=$mysql-> real_escape_string($_POST["consulta"]);
        $query= "SELECT duenno.nombre AS nombreDuenno , cats.nombre AS nombreCats from cats INNER JOIN duenno WHERE cats.id_duenno";
    }

?>