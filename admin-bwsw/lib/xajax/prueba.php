<html>
<head>
<script language="javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="javascript">
function asignar_status(form){    
       /// Aqui podemos enviarle alguna variable a nuestro script PHP
    var i = form.value;
       /// Invocamos a nuestro script PHP
    $.post("actualizar_status.php", { nombre: i }, function(data){
       /// Ponemos la respuesta de nuestro script en el DIV recargado
    $("#actualizar_status").html(data);
    });                    
}
</script>
</head>
<body>
form method="post" action="">

<table width="335" border="1" align="center">
  <tr>
    <td width="67">nombre </td>
    <td width="252"><input type="text" name="nombre" cols="50" onKeyPress="javascript:fListar_Clientes(this);"  >
        <input type="submit" name="Submit2" value="Buscar"></td>
  </tr>
  <tr><td><div id="actualizar_status">[] </div>
</table>
</form>
 <div id="listas"> []</div>
 </body>
 </html>
 