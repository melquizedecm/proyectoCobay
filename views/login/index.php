<!DOCTYPE html>
<!--
Source: Login
Author: Néstor Reyna
Description: 
1.Para accender al sistema.
-->

    

<style>
    body {
  margin: 0;
  padding: 0;
  
  
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
}

.login-box label {
  margin: 0;
  padding: 0;
  font-weight: bold;
  display: block;
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
  color: #fff;
  font-size: 16px;
}

.login-box input[type="submit"] {
  border: none;
  outline: none;
  height: 40px;
  background: #b80f22;
  color: #fff;
  font-size: 18px;
  border-radius: 20px;
}

.login-box input[type="submit"]:hover {
  cursor: pointer;
  background: #ffc107;
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

  
</style>


  
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/css/master.css">
  </head>
  <body>

    <div class="login-box">
      <img src="img/logo.jpeg" class="avatar" alt="Avatar Image">
      <h1>Alumno</h1>
      <form>
        <!-- USERNAME INPUT -->
        <label for="username">Matrícula</label>
        <input type="text" placeholder="Enter Username">
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Enter Password">
        <input type="submit" value="Iniciar Sesión">
        
      </form>
    </div>
  </body>
</html>
