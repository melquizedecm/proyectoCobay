<!DOCTYPE html>
<!--
Source: Login
Author: Néstor Reyna
Description: 
1.Para accender al sistema.
-->
<?php
?>


<style>
    body {
        margin: 0;
        padding: 0;
       // background: #E4D7C7;


        font-family: sans-serif;
        height: 100vh;
    }

    .login-box {
        width: 440px;
        height: 490px;
        background: #57C472;
        color: #fff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        padding: 70px 30px;
        background-image: url(img/fondo.jpeg);
        
        -webkit-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
    box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
    }

    .login-box .avatar {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        position: absolute;
        top: -50px;
        left: calc(50% - 50px);
    }

    .login-box h1 {
        margin: 0;
        padding: 0 0 20px;
        text-align: center;
        font-size: 22px;
         color: #3B0B0B;
    }

    .login-box label {
        margin: 0;
        padding: 0;
      //font-weight: bold;
        display: block;
         color: #3B0B0B;
    }

    .login-box input {
        width: 100%;
        margin-bottom: 20px;
    }

    .login-box input[type="text"], .login-box input[type="password"] {
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 40px;
        color: #3B0B0B;
        font-size: 16px;
    }

    .login-box input[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        background: #449D44;
        color: #fff;
        font-size: 18px;
        border-radius: 20px;
    }

    .login-box input[type="submit"]:hover {
        cursor: pointer;
        background: #449D44;
        color: #000;
    }

    .login-box a {
        text-decoration: none;
        font-size: 12px;
        line-height: 20px;
        color: darkgrey;
    }

    .login-box a:hover {
        color: #fff;
    }

    .form-container
{
	border: 1px solid #fff; 
	padding: 50px 60px; 
	margin-top:20vh; 
    
    -webkit-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
    box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
}


</style>



<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="/css/master.css">
</head>
<body>

    <div class="login-box">
        <img src="img/logo.png" class="avatar" alt="Avatar Image">
        <h1>Alumno</h1>
        <form>
            <!-- USERNAME INPUT -->
            <label for="username" >Matrícula</label>
            <input type="text" id="inputMatricula" placeholder="Enter Username">
            <!-- PASSWORD INPUT -->
            <label for="password">Contraseña</label>
            <input type="password"id="inputPassword" placeholder="Enter Password">
            <input type="submit" value="Iniciar Sesión" id="buttonLogin">
 
            
        </form>
    </div>
</body>
</html>




<script type="text/javascript">

    var matricula = document.getElementById("inputMatricula").value; //(JALAR EL VALOR INGRESADO)
    var nombre = document.getElementById("inputNombre").value;
    //2. ENVIAR POR POTS//
    //$.post("url", variables, response);
    $.post("../../controllers/colsutarcalificacionController.php",
            {
                inputMatricula: matricula,
                inputNombre: nombre,
                buttonCreate: true
            },
    function (data) {
        if (data === "-1") {
            alert("Error al iniciar sesión");
        } else {
            alert("Bienvenido al sistema");
            location.reload(true);
        }
    });





</script>