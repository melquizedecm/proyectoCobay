<?php

session_start();
$matricula =  addslashes($_POST['inputMatricula']);
$contraseña = addslashes($_POST['inputPassword']);

$_SESSION['username2'] = $matricula;

//Conectando a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto_cobay");
//Consulta


$consulta = "SELECT * FROM alumnos WHERE matricula='" . $matricula . "' and password='" . $contraseña . "'";

$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    header("location:http://localhost/proyectoCobay/estudiante/views/calificaciones/");
} else {
    echo header("location:http://localhost/proyectoCobay/estudiante/views/login/index.php?fallo=true");
    exit();
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
