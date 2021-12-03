<?php
    $mysql=new mysqli("localhost", "root","","pets");

    $salida= "";
    $query="SELECT * from cats INNER JOIN duenno WHERE cats.id_duenno = duenno.id";

    if (isset($_POST["consulta"])) {
        $q=$mysql-> real_escape_string($_POST["consulta"]);
        $query= "SELECT duenno.nombre AS nombreDuenno , cats.nombre AS nombreCats, cats.edad AS EdadMascota from cats INNER JOIN duenno WHERE cats.nombre LIKE '%".$q."%'";
    }

    $resultado=$mysql->query($query);

    if ($resultado->num_rows > 0) {
        $salida=
        "<table border='2' class='tablaDatos'>

        <tr>
            <th>Nombre dueño</th>
            <th>Nombre mascota</th>
            <th>Edad mascota</th>
        </tr>";
        while ($fila = $resultado->fetch_assoc()) {
            $salida.=
            "<tr>
                <td>".$fila['nombreDuenno']."</td>
                <td>".$fila['nombreCats']."</td>
                <td>".$fila['EdadMascota']."</td>
            </tr>";
        }

        $salida.="</table>";
        
    }else{
        $salida.="No hay dato";

    }
    echo $salida;
    $mysqli->close();

?>