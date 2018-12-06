<?php
/*
 * Author: José Luis Rivera
 * Program: Consultar Calificaciones
 * Description:
 * 1. Formulario para que el alumno vea sus calificaciones del semestre actual
 * 
 */

//importamos los archivos del modelo y del controlador
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/consultarcalificacionController.php');
$alumno = new consultarcalificacionController();
require_once ('../../models/Consulta.php');

//---------------------------- Variable con la cual se obtendrá la matricula -------------------------------------------------------

//$usuario = $_POST['inputMatricula'];
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        getMeta("Tabla de calificaciones");
        estilosPaginas();
        ?>
        <style type="text/css">

            body {
                color: #404E67;
                background: #66CDAA; 
                font-family: 'Open Sans', sans-serif;
            }
            .table-wrapper {
                width: 700px;
                margin: 30px auto;
                background: #fff;
                padding: 20px;	
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .table-title {
                padding-bottom: 10px;
                margin: 0 0 10px;
            }
            .table-title h2 {
                margin: 6px 0 0;
                font-size: 22px;
            }
            .table-title .add-new {
                float: right;
                height: 30px;
                font-weight: bold;
                font-size: 12px;
                text-shadow: none;
                min-width: 100px;
                border-radius: 50px;
                line-height: 13px;
            }
            .table-title .add-new i {
                margin-right: 4px;
            }
            table.table {
                table-layout: fixed;
            }
            table.table tr th, table.table tr td {
                border-color: #e9e9e9;
            }
            table.table th i {
                font-size: 13px;
                margin: 0 5px;
                cursor: pointer;
            }
            table.thead{

                background: #57C472;
            }
            table.table th:last-child {
                width: 100px;
            }
            table.table td a {
                cursor: pointer;
                display: inline-block;
                margin: 0 5px;
                min-width: 24px;
            }    
            table.table td a.add {
                color: #27C46B;
            }
            table.table td a.edit {
                color: #FFC107;
            }
            table.table td a.delete {
                color: #E34724;
            }
            table.table td i {
                font-size: 19px;
            }
            table.table td a.add i {
                font-size: 24px;
                margin-right: -1px;
                position: relative;
                top: 3px;
            }    
            table.table .form-control {
                height: 32px;
                line-height: 32px;
                box-shadow: none;
                border-radius: 2px;
            }
            table.table .form-control.error {
                border-color: #f50000;
            }
            table.table td .add {
                display: none;
            }

            thead{
                background-color: #01A75D;
                color: white;
            }

            tr:nth-child(ever){
                background-color: #ddd;	
            }
            tr:hover td{
                background-color:#F5F7FA;
                color: black; 


            }

        </style>

    </head>

    <body>
        <?php
        getHeaderAlumno();
        //Algunas matriculas: 17B003000061 estatus 2, 15B003000462 estatus:0, 17B003000114 estatus 1. donde 0=BAJA, 1=REGULAR,2=REGULAR,3=PENDIENTE.
        //validamos que el alumno sea regular.
     //    $json = $alumno->obtenerEstatus("17B003000061");
            
//            $json = $alumno->obtenerEstatus("17B003000061");
//            $datosTabla = json_decode($json);
//
//            foreach ($datosTabla as $row) {
//
//                if ($row->{'id_status'} == 2) { //Si el alumno es irregular
//                    echo 'No';
//                } else {
//                    if ($row->{'id_status'} == 1){
//                    echo 'Mostramos calificaciones';
//                    }
//                }
//            }
        ?>
        <div class="container">
           
            
            <div class="table-wrapper"> 
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-9"><h2> <b>TABLA DE CALIFICACIONES</b></h2></div>
                        <div class="col-sm-3">
                <!--     <button type="button" class="btn btn-danger"> <i class="fa fa-power-off"></i> Cerrar sesión</button> -->
                        </div>
                    </div>
                    <h4>ALUMNO: 
                        <?php
                       //          $json = $alumno->obtenerEstatus("17B003000061");
            

                        
                        
                        //mostramos el nombre del alumno
                        $json = $alumno->ObtenerNombre("17B003000061"); //$usuario que es la variable extraida del login
                        $datosTabla = json_decode($json);

                        foreach ($datosTabla as $row) {
                            echo $row->{'nombre'};
                        }
                        ?>
                    </h4>
                    <!--  <h4>SEMESTRE: 
                    //abrir php
                         
                         /* $json = $alumno->ObtenerSemestre("17B003000037");
                          $datosTabla = json_decode($json);
      
                          foreach ($datosTabla as $row) {
                              echo $row->{'id_semestre'};
                          }*/
                         //cerrar php
                      </h4>-->
                    <h4>GRUPO: 
                        <?php
                        $json = $alumno->obtenerGrupo("17B003000061");
                        $datosTabla = json_decode($json);

                        foreach ($datosTabla as $row) {
                            echo $row->{'id_grupo'};
                        }
                        ?>
                    </h4>

                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ASIGNATURA</th>
                            <th>PARCIAL 1</th>
                            <th>PARCIAL 2</th>
                            <th>ORDINARIO</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $json = $alumno->llenarTabla("17B003000061");
                        $datosTabla = json_decode($json);
                        $numeric = 0;
                        foreach ($datosTabla as $row) {

                            echo "<tr><td>" . $row->{'asignatura'} . "</td>";
                            if ($row->{'parcial_uno'} == 35 && $row->{'parcial_dos'} == 35) { //si en los 2 parciales obtuvo 35 se agregará automaticamente el resto para sumar 100
                                $numeric = (int) $row->{'ordinario'} + (int) $row->{'parcial_uno'} + (int) $row->{'parcial_dos'};
                                echo "<td>" . $row->{'parcial_uno'} . " </td>"
                                . "<td>" . $row->{'parcial_dos'} . " </td>"
                                . "<td>" . $row->{'ordinario'} . " </td>"
                                . "<td>" . $numeric . " </td>"
                                . "</tr>";
                            } else {
                                if ($row->{'parcial_uno'} != null && $row->{'parcial_dos'} != null && $row->{'ordinario'} != null) { //Si los campos estan llenos
                                    $numeric = (int) $row->{'ordinario'} + (int) $row->{'parcial_uno'} + (int) $row->{'parcial_dos'};
                                    echo "<td>" . $row->{'parcial_uno'} . " </td>"
                                    . "<td>" . $row->{'parcial_dos'} . " </td>"
                                    . "<td>" . $row->{'ordinario'} . " </td>"
                                    . "<td>" . $numeric . " </td>"
                                    . "</tr>";
                                    if ($numeric < 70) {
                                        //no mostrara nada
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>

                </table>
                <?php
             
                $json = $alumno->obtenerEstatus("17B003000061");
                $datosTabla = json_decode($json);
                foreach ($datosTabla as $row) {
                    if ($row->{'id_status'} == 2) { //Si el alumno es irregular
                        echo 'No se pueden ver las calificaciones';
                    } else {
                        if ($row->{'id_status'} == 1) {
                            echo 'Mostramos calificaciones';
                        }
                    }
                }
                ?>
            </div> 
        </div>  
        <?php
        getFooter();
        ?>
    </body>
</html>      


