<?php
session_start();
$matricula= stripslashes($_POST['inputMatricula']);
$contraseña=stripslashes($_POST['inputPassword']);

$_SESSION['username']=$matricula; 

//Conectando a la base de datos
$conexion=mysqli_connect("localhost","root","","proyecto_cobay");
//Consulta


$consulta= "SELECT * FROM administrativos WHERE matricula='".$matricula."' and password='".$contraseña."'"; 

$resultado=  mysqli_query($conexion, $consulta);
$filas=  mysqli_num_rows($resultado);

if($filas>0)
{
    header("location:http://localhost/proyectoCobay/views/Menu/");
}
else
{
    echo"Error en la autentificación";
    
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
