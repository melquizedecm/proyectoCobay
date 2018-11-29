<!-- Author: Ángel García
     Program: Crear periodos
     Description: 
        1- Oprimir el boton de añadir periodo
        2- Colocar los datos solicitados
        3- Verificar informacion
        4- Herramientas de edicion para el usuario
-->
<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/periodosController.php');
$periodos = new PeriodosController();
require_once ('../../models/Periodos.php');
?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <?php
        getMeta("Administración de Periodos");
        estilosPaginas();
        ?>        
        <script type="text/javascript">

      /*    function activarPeriodo(this) {
                alert("periodo");
            }*/

            ///////DATABLES ////////
            $(document).ready(function ()
            {
                $('#tablaPeriodos').DataTable();
            });

            $(document).ready(function ()
            {


                //GENERACION DEL CRUD EN LA TABLA
                $('[data-toggle="tooltip"]').tooltip();
                var actions = $("table td:last-child").html();

                //Append table with add row form on add new button click
                $(".add-new").click(function ()
                {
                    $(this).attr("disabled", "disabled");
                    var index = $("table tbody tr:last-child").index();
                    var row = '<tr>' +
                            '<td><input type="text" class="form-control" name="id" id="inputId"></td>' +
                            '<td><input type="text" class="form-control" name="periodo" id="inputPeriodo"></td>' +
                            '<td><input type="text" class="form-control" name="estatus" id="inputEstatus"></td>' +
                            '<td>' + actions + '</td>' +
                            '</tr>';
                    $("table").append(row);
                    $("table tbody tr").eq(index + 1).find(".add, .edit, .active").toggle();
                    $('[data-toggle="tooltip"]').tooltip();
                });

                // Add row on add button click
                $(document).on("click", ".add", function ()
                {
                    /////GUARDAR LOS DATOS/////
                    //1. OBTENER LOS VALORES//
                    var id = document.getElementById("inputId").value; //Jalar valor ingresado
                    var periodo = document.getElementById("inputPeriodo").value;
                    var estatus = document.getElementById("inputEstatus").value;
                    //2. ENVIAR POR POTS//
                    //$.post("url", variables, response);
                    $.post("../../controllers/periodosController.php",
                            {
                                //Datos post
                                inputId: id,
                                inputPeriodo: periodo,
                                inputEstatus: estatus,
                                buttonCreate: true
                            },
                            function (data)
                            {
                                if (data === "-1")
                                {
                                    alert("Error al guardar los datos, revisar la matricula");
                                } else
                                {
                                    ///despliega la tabla con los datos////
                                    alert(data);
                                }
                            });
                });
                //3. REFRESCAR LOS VALORES///

                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function ()
                {
                    if (!$(this).val())
                    {
                        $(this).addClass("error");
                        empty = true;
                    } else
                    {
                        $(this).removeClass("error");
                    }
                });

                $(this).parents("tr").find(".error").first().focus();
                if (!empty)
                {
                    input.each(function ()
                    {
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".add, .edit, .active").toggle();
                    $(".add-new").removeAttr("disabled");
                }

                // Edit row on edit button click
                $(document).on("click", ".edit", function ()
                {
                    $(this).parents("tr").find("td:not(:last-child)").each(function ()
                    {
                        $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
                    });
                    $(this).parents("tr").find(".add, .edit").toggle();
                    $(".add-new").attr("disabled", "disabled");
                });

                // Delete row on delete button click
                $(document).on("click", ".delete", function ()
                {
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
                        <div class="col-sm-8"><h2>Periodos <b>Existentes</b></h2></div>
                        <div class="col-sm-4">
                            <button type="button" id="buttonAgregarPeriodo"  name="buttonAgregarPeriodo" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Periodo</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered" id="tablaPeriodos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Periodo</th>
                            <th>Estado Actual</th>
                            <th>Herramientas</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $json = $periodos->read();
                        $datosTabla = json_decode($json);

                        foreach ($datosTabla as $row) {
                            echo "<tr>"
                            . "<td>" . $row->{'id_periodo'} . "</td>"
                            . "<td>" . $row->{'periodo'} . "</td>";
                            if ($row->{'status_periodo'} === "ACTIVO") {
                                echo "<td><button class='btn-success'>" . $row->{'status_periodo'} . "</button></td>";
                            } else {
                                echo "<td><button class='btn-danger' id='btn-activar' onclick='activarPeriodo(this);'>" . $row->{'status_periodo'} . "</button></td>";
                            }

                            echo "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                            . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                            . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"
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

    </body>
</html> 