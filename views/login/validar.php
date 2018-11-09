<?php
$matricula=$_POST['matricula'];
$contraseña=$_POST['contraseña'];

//Conectando a la base de datos
$conexion=mysqli_connect("localhost","root","","proyecto_cobay");
//Consulta
echo $matricula;
echo $contraseña;
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

