<?php
session_start();
$matricula=$_POST['matricula'];
$contraseña=$_POST['contraseña'];

$_SESSION['matricula']=$matricula; // PARA MANDAR A JOSÉ LUÍS

//Conectando a la base de datos
$conexion=mysqli_connect("localhost","root","","proyecto_cobay");
//Consulta

$consulta= "SELECT * FROM alumnos WHERE matricula='$matricula' and password='$contraseña'"; 

$resultado=  mysqli_query($conexion, $consulta);
$filas=  mysqli_num_rows($resultado);

if($filas>0)
{
    header("location:http://localhost/proyectoCobay/views/calificaciones/ConsultarCalificaciones.php");
}
else
{
    echo"Error en la autentificación";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>

