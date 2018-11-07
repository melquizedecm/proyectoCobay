<?php
function conectar() {
///PARAMETROS PARA LOCALHOST
    $DBuser = "root";
    $DBpass = "";
    $DBserver = "localhost";
    $DBdatos = "proyecto_cobay";
////////////NUEVO METODO DE CONEXION////////////////////
    $link = mysqli_connect($DBserver, $DBuser, $DBpass, $DBdatos);

    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        return $link;
    } else {
        return $link;
    }
}

function liberar($resultado) {
    $resultado->free();
}

function cerrar($link) {
    $link->close();
}

?>
