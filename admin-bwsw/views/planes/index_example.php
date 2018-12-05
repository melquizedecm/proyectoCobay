<?php
/*
 * Author: Jacob Luna
 * Programm: Subir calificaciones
 * Description: 
 * 1. Formulario para subir el excel
 * 2. Lista de Alumnos con su calificación
 * 
 */

/**
 * Description of agregarplan
 *
 * @author melqui
 */
require_once("../../lib/links.php");
libnivel3();
?>

<?php
//$link=conectar();
//$banco= new OperacionesBanco();
//if ($_POST){
//$id_plan=$_POST['id_plan'];
//$banco->setConcepto($link,$id_plan);
//}
//$data=index();
?>
<html>
    <head>     
        <?php
        $encabezado = new Meta();
        $encabezado->getMeta();
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <title>AGREGAR PLAN</title>
        <?php
//estilo(); 
//header('Content-Type: text/html; charset=utf-8');
        ?>
    </head>

    <body>
    <center>

        <?php //encabezado3("AAGREGAR PLANES");  ?>
        <br />
        <div class="container center-block" >
            <div>
                <form class="form-horizontal"  name="formPlan" method="post" action="../../controllers/Plan.php">
                    <table class="table-responsive">
                        <tr>
                            <td scope="row" align="right">Escribe el nuevo Plan</td>
                            <td>
                                <div class="col-xs-12 wow animated slideInLeft" data-wow-delay=".5s">
                                    <input  REQUIRED id="inputPlan" name="inputPlan" type="text" size="5" class="form-control" placeholder="2017B" value="">
                                </div>
                            </td>

                        </tr>	
                        <th colspan="4" scope="row"><center><input type="submit" name="btnCreate" id="btnCreate"  value="Guardar"></center></th>
                    </table>
                </form>
            </div>

            <H4>LISTA DE PLANES INGRESADOS </H4>
            <br>
            <table width="50">
                <thead>
                    <tr>
                        <th align="center"> id_plan </th>
                        <th align="center"> plan </th>
                        <th align="center"> id_periodo </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center"> 2 </td>
                        <td align="center"> 2017B </td>
                        <td align="center"> 17B </td>
                    </tr>
                    <tr>
                        <td align="center"> 3 </td>
                        <td align="center"> 2017B </td>
                        <td align="center"> 17B </td>
                    </tr>
                    <tr>
                        <td align="center"> 4 </td>
                        <td align="center"> 2017B </td>
                        <td align="center"> 17B </td>
                    </tr>
                    <tr>
                        <td align="center"> 5 </td>
                        <td align="center"> 2017B </td>
                        <td align="center"> 17B </td>
                    </tr>
                </tbody>

                <?php
                //          echo $data;
//$concepto=$banco->getBanco_Concepto($link);
//while($fila=$concepto->fetch_array(MYSQLI_BOTH)){
//	echo "<tr>";
//	echo "<td align='center'> ".$fila['concepto']."</td>";
//	echo "<tr>";
//	}
                ?>              
<!-- <td>
<a class = "add" title = "Add" data-toggle = "tooltip"><i class = "material-icons">&#xE03B;</i></a>
<a class = "edit" title = "Edit" data-toggle = "tooltip"><i class = "material-icons">&#xE254;</i></a>
<a class = "delete" title = "Delete" data-toggle = "tooltip"><i class = "material-icons">&#xE872;</i></a>
</td>
                -->
            </table>
          <!--  <h2><a href='../../form_principal.php'> Ir a Menu</a></H2>-->
        </div>
        <div id="footer">
            <?php
//pie3();
            ?>
        </div>
    </center>
</body>
</html>
