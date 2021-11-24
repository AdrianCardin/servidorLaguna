<?php

//esto arregla el erro de cuando estas jugando no se sale error al coger el request
if (!isset($_REQUEST["oculto"])  && isset($_COOKIE["oculto"])) {
    $oculto = (int)$_COOKIE["oculto"];
} else {
    $oculto = (int)$_REQUEST["oculto"];
}
setcookie("oculto", $oculto, time() + 3600);




if (!isset($_REQUEST["intento"]) && !isset($_COOKIE["numIntentos"])) { // Primera vez. Solo viene oculto.
    $intento = null;

    $numIntentos = 0;
} else { // Resto de veces. Vienen todos los datos.

    //esto arregla que cuando sales y te vuelves a meter , no te sume un intento de mas y evita error de undefined
    if (isset($_REQUEST["intento"])) {
        $intento = $_REQUEST["intento"];
        $numIntentos = (int)$_COOKIE["numIntentos"] + 1;
    } else {
        $intento = 0;
        $numIntentos = (int)$_COOKIE["numIntentos"];
    }



    // Esto del logaritmo no es importante. Es solo una manera de que
    // no salga 1.000.000 de asteriscos si hacen un intento de "1000000".
    $numAsteriscos = 1 + log(abs($intento - $oculto), 1.5);
    $stringCercania = "";
    for ($i = 1; $i <= $numAsteriscos; $i++) {
        $stringCercania = $stringCercania . "*";
    }
}
setcookie("numIntentos", $numIntentos, time() + 3600);


// INTERFAZ:
// $oculto
// $intento
// $numAsteriscos
// $stringCercania
?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

    <h1>ADIVINA EL NÚMERO</h1>


    <?php

    if ($intento == null) {
        // No informamos de nada, el juego acaba de empezar.
    } elseif ($intento < $oculto) {
        echo "<p>El número que buscas es mayor ($stringCercania)</p>";
    } elseif ($intento > $oculto) {
        echo "<p>El número que buscas es menor ($stringCercania)</p>";
    } else {
        echo "<p>¡Has adivinado el número! Era, efectivamente, $oculto. Has gastado $numIntentos intentos.</p>";
    }


    if ($intento != $oculto) { // Presentamos el formulario:
    ?>

    <form method="post">
        <p>Jugador 2: Adivina el número (llevas <?= $numIntentos ?> intentos).</p>
        <input type="number" name="intento" autofocus required>
        <input type="submit" value="Intentar">
    </form>

    <?php
    }
    ?>

</body>

</html>