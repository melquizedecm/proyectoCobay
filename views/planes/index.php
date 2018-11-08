<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/planesController.php');
$planes = new PlanesController();
require_once ('../../models/Planes.php');
?>
<!DOCTYPE html>
<!--
Author: Aurora Basto 
Program:  Agregar planes
description: 
1. Agregar planes 
2. Lista de planes
-->

<head>
    <?php
    getMeta("Administración de Planes");
    estilosPaginas();
    ?>
    
    <script type="text/javascript">
        $(document).ready(function () {

            ///////DATABLES ////////
            $(document).ready(function () {
                $('#tablePlanes').DataTable();
            });


            ///////GENERACION DEL CRUD EN LA TABLA////// 
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" class="form-control" name="inputID_Plan" id="inputid_plan" placeholder="Automatico" readonly></td>'+
                '<td><input type="text" class="form-control" name="inputPlan" id="inputplan"></td>' +
                        /*'<td><input type="text" class="form-control" name="inputEstatus" id="inputestatus"></td>' +*/
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });

            // Add row on add button click (Agregar base de datos)
            $(document).on("click", ".add", function () {
                /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
                var id_plan = document.getElementById("inputid_plan").value;
                var plan = document.getElementById("inputplan").value; //(JALAR EL VALOR INGRESADO)
                /*var estatus = document.getElementById("inputEstatus").value;*/
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/planesController.php",
                        {
                            inputID_Plan: id_plan,
                            inputPlan: plan,
                            /*inputEstatus: estatus,*/
                            buttonCreate: true
                        },
                function (data) {
                    if (data === "-1") {
                        alert("Error al guardar los datos, revisar la matricula");
                    } else {
                        alert("Registro Guardado con éxito");
                        location.reload(true);
                    }
                });
            });
            //3. REFRESCAR LOS VALORES///
            var empty = false;
            var input = $(this).parents("tr").find('input[type="text"]');
            input.each(function () {
                if (!$(this).val()) {
                    $(this).addClass("error");
                    empty = true;
                } else {
                    $(this).removeClass("error");
                }
            });
            $(this).parents("tr").find(".error").first().focus();
            if (!empty) {
                input.each(function () {
                    $(this).parent("td").html($(this).val());
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").removeAttr("disabled");
            }

            // Edit row on edit button click
            $(document).on("click", ".edit", function () {
                $(this).parents("tr").find("td:not(:last-child)").each(function () {
                    $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").attr("disabled", "disabled");
            });
            // Delete row on delete button click
            $(document).on("click", ".delete", function () {
                $(this).parents("tr").remove();
                $(".add-new").removeAttr("disabled");
            });
        });

    </script>
</head>
<body>
    <?php
    getHeader();
    ?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><center>Administración De <b>Planes</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Plan</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tablePlanes">
                <thead>
                    <tr>
                        
                        <th align="center"> ID_Plan </th>
                        <th align="center"> Plan </th>
                        
                        <th align="center"> Modificar </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $planes->read();
                    $datosTabla = json_decode($json);

                    //print $obj->{'foo-bar'};

                    foreach ($datosTabla as $row) {
                        echo "<tr><td>" . $row->{'id_plan'} . "</td>"
                        . "<td>" . $row->{'plan'} . "</td>"
                        /*. "<td>" . $row->{'estatus'} . "</td>"*/
                        . "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                        . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                        . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"
                        . "<a class = 'update' title = 'Actualizar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE863;</i></a>"
                        . "</td> </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>    
    <?php
    getFooter();
    ?>
</body>
</html>  