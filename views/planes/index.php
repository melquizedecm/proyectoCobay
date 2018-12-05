<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/planesController.php');
$planes = new planesController();
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
        var temp;
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
                        '<td><input type="text" class="form-control" name="inputId_plan" id="inputid_plan" placeholder="Automatico" readonly></td>' +
                        '<td><input type="text" class="form-control" name="inputPlan" id="inputplan"></td>' +
                        '<td><input type="text" class="form-control" name="inputEstatus" id="inputestatus" placeholder="Automatico" readonly></td>' +
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
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/planesController.php",
                        {
                            inputId_plan: id_plan,
                            inputPlan: plan,
                            buttonCreate: true
                        },
                function (data) {
                    if (data === "-1") {
                        alert("Error al guardar los datos");
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
                $(this).parents("tr").find("td:nth-child(2)").each(function () {
                    $(this).html('<input type="text" class="form-control" id="temporal" value="' + $(this).text() + '">');
                });
                temp = document.getElementById("temporal").value;
                $(this).parents("tr").find(".edit").toggle();
                $(".add-new").attr("disabled", "disabled");
            });


            /*Actualizar*/
            $(document).on("click", ".update", function () {
                var id_plan = document.getElementById("temporal").value;
                if (confirm("Se cambiara el valor " + temp + " con el nuevo valor " + id_plan)) {
                    $(this).parents("tr").find("td:first-child").each(function () {

                        $.post("../../controllers/planesController.php",
                                {
                                    inputId_planactual: temp,
                                    inputId_plannuevo: id_plan,
                                    buttonUpdate: true
                                },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al guardar los datos");
                            } else if (data === "-2") {
                                         alert("El plan ya EXiste");
                                     }
                            else {
                                alert("Registro Guardado con éxito ");
                                location.reload(true);
                            }
                        });
                    });
                }
            });
            //desactivar  

            $(document).on("click", ".btn-success", function () {
                if (confirm("¿Seguro que desea DESACTIVAR el plan?")) {
                    var id_plan = ($(this).parents("tr").find("td:first-child").html());

                    $.post("../../controllers/planesController.php",
                            {
                                inputId_plan: id_plan,
                                buttonDesactivar: true
                            },
                    function (data) {
                        if (data === "-1") {
                            alert("Error al DESACTIVAR el plan, revise su conexión de internet");
                        } else {
                            alert("plan DESACTIVADO con éxito");
                            location.reload(true);
                        }
                    });
                }
            });
            //fin cambiar estado 


            //activar 


            $(document).on("click", ".btn-danger", function () {
                if (confirm("¿Seguro que desea ACTIVAR el plan?")) {
                    var id_plan = ($(this).parents("tr").find("td:first-child").html());
                    $.post("../../controllers/planesController.php",
                            {
                                inputId_plan: id_plan,
                                buttonActivar: true
                            },
                    function (data) {
                        if (data === "-1") {
                            alert("Error al ACTIVAR el grupo, revise su conexión de internet");
                        } else {
                            alert("Plan ACTIVADO con éxito");
                            location.reload(true);
                        }
                    });
                }
            });
            //fin cambiar estado




        });

    </script>
</head>

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
                        <th align="center"> Estado Actual </th>
                        <th align="center"> Modificar </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $planes->read();
                    $datosTabla = json_decode($json);

                    //print $obj->{'foo-bar'};

                    foreach ($datosTabla as $row) {
                        echo "<tr>"
                        . "<td>" . $row->{'id_plan'} . "</td>"
                        . "<td>" . $row->{'plan'} . "</td>";

                        if ($row->{'status_plan'} === "ACTIVADO") {
                            echo "<td><button class='btn-success'>" . $row->{'status_plan'} . "</button></td>";
                        } else {
                            echo "<td><button class='btn-danger' id='btn-activar' onclick='activarPlan(this);'>" . $row->{'status_plan'} . "</button></td>";
                        }
                        echo "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                        . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                        /*. "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"*/
                        . "<a class = 'update' title = 'Actualizar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE863;</i></a>"
                        . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
    <?php
    getFooter();
    ?>

</html>  