<?php

session_start();
$matricula = addslashes($_POST['inputMatricula']);
$contraseña = addslashes($_POST['inputPassword']);



//Conectando a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto_cobay");
//Consulta


$consulta = "SELECT * FROM administrativos WHERE matricula='" . $matricula . "' and password='" . $contraseña . "'";

$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    $_SESSION['username'] = $matricula;
    header('Location: ../views/Menu/');
} else {
    header('Location: ../views/login/index.php?fallo=true');
    exit();
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
