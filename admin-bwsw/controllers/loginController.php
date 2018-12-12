<?php
////////// LIBRERIAS /////////
require_once '../lib/consultas.php';
require_once '../core/config.php';

///// RECEPCION DE  DATOS ////////
session_start();
$matricula = addslashes($_POST['inputMatricula']);
$password = addslashes($_POST['inputPassword']);

////////CONSULTA DE DATOS ////////
$consulta = "SELECT * FROM administrativos WHERE matricula='" . $matricula . "' and password='" . $password . "'";
$link = conectar();

//////// VALIDAR CONEXION ///////
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
}

//////////VERIFICAR RESULTADOS //////
$result = $link->query($consulta);
if (!$result){
    echo $link->error;
}
if (!mysqli_query($link, $consulta)) {
    printf("Errormessage: %s\n", mysqli_error($link));
}

//////////  REDIRECCIONAMIENTO /////////
if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $matricula;
    header('location: ../views/Menu/');
} else {
    header('location: ../views/login/index.php?fallo=true');
}

