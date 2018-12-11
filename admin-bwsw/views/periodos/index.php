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
                    var index = $("table tbody tr:first-child").index();
                    var row = '<tr>' +
                            '<td><input type="text" class="form-control" name="id" id="inputId" placeholder="AUTOMATICO" readonly></td>' +
                            '<td><input type="text" class="form-control" name="periodo" id="inputPeriodo"></td>' +
                            '<td><input type="text" class="form-control" name="estatus" id="inputEstatus" placeholder="AUTOMATICO" readonly></td>' +
                            '<td>' + actions + '</td>' +
                            '</tr>';
                    $("table").prepend(row);
                    $("table tbody tr").eq(index + 0).find(".add, .update, .edit").toggle();
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
                    
                    //Validacion de los campos
                    if(periodo == null || periodo.length == 0 || /^\s+$/.test(periodo))
                    {
                        alert("Es nesesario ingresar un periodo!");
                    }
                    else
                    {
                        /////VALIDACION DE EXISTENCIA DEL PERIODO
                        $.post("../../controllers/periodosController.php",
                            {
                                //Datos post
                                inputPeriodo: periodo,
                                buttonValidar: true
                            },
                            function (data)
                            {
                                if (data === "-1")
                                {
                                    alert("Ya existe un registro con este periodo");
                                } 
                                else
                                {
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
                                        alert("Error al guardar los datos, Periodo ya existe");
                                    } 
                                    else
                                    {
                                        alert("Registro Guardado con éxito");
                                        location.reload(true);
                                    }
                                    });
                                }
                            });
                    }
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
                    } 
                    else
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
                    $(this).parents("tr").find(".edit").toggle();
                    $(".add-new").removeAttr("disabled");
                }


                // Edit row on edit button click
                $(document).on("click", ".edit", function ()
                {
                    $(this).parents("tr").find("td:nth-child(2)").each(function ()
                    {
                        $(this).html('<input type="text" class="form-control" id="inputPeriodo" value="' + $(this).text() + '">');
                    });
                    $(this).parents("tr").find(".edit").toggle();
                    $(".add-new").attr("disabled", "disabled");
                    //$(".update").attr("style");
                });
                
                //Actualizar datos de row en la base de datos
                $(document).on("click", ".update", function ()
                {
                    //Obtenemos los valores de los row
                    var id=$(this).parents("tr").find("td:first-child").html();
                    var periodo=document.getElementById("inputPeriodo").value;
                    
                    //Validacion de los campos
                    if(periodo == null || periodo.length == 0 || /^\s+$/.test(periodo))
                    {
                        alert("Es nesesario ingresar un periodo!");
                    }
                    else
                    {
                        //1. ENVIAR POR POTS//
                        $.post("../../controllers/periodosController.php",
                        {
                            inputId:id,
                            inputPeriodo: periodo,
                            buttonActualizar: true
                        },
                        function (data) 
                        {
                            if (data === "-1") 
                            {
                                alert("No se pudo actualizar, Periodo ya existe");
                            } 
                            else 
                            {
                                //1.1 FUNCION DESACTIVAR PERIODO ACTIVO
                                $.post("../../controllers/periodosController.php",
                                {
                                    inputId: id,
                                    inputPeriodo: periodo,
                                    periodoActualizado: true
                                },
                                function (data) 
                                {
                                    if (data === "-1") 
                                    {
                                        alert("Error al intentar activar el periodo");
                                    } 
                                    else 
                                    {
                                        alert("Periodo Actualizado Exitosamente!");
                                        location.reload(true);
                                    }
                                });
                            }
                        });
                    }
                });
                
                //ACTIVAR GRUPO
                $(document).on("click", ".btn-danger", function () 
                {
                    var id_periodo=($(this).parents("tr").find("td:first-child").html());
                    
                    //1. ENVIAR POR POTS//
                    //1.1 FUNCION DESACTIVAR PERIODO ACTIVO
                    $.post("../../controllers/periodosController.php",
                        {
                            periodoActivo: true
                        },
                        function (data) 
                        {
                            if (data === "-1") 
                            {
                                alert("Error al intentar activar el periodo");
                            } 
                            else 
                            {
                                alert("Periodo Activado");
                                location.reload(true);
                            }
                        });
                    
                    //2. ENVIAR POR POTS//
                    //$.post("url", variables, response);
                    $.post("../../controllers/periodosController.php",
                        {
                            inputId:id_periodo,
                            buttonActivar: true
                        },
                        function (data) 
                        {
                            if (data === "-1") 
                            {
                                alert("Error al guardar los datos, revisar el Id");
                            } 
                            else 
                            {
                                location.reload(true);
                            }
                        });
                });
                //FIN DESACTIVAR GRUPO
            
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

                        foreach ($datosTabla as $row) 
                        {
                            echo "<tr>"
                            . "<td>" . $row->{'id_periodo'} . "</td>"
                            . "<td>" . $row->{'periodo'} . "</td>";
                            
                            if ($row->{'status_periodo'} === "ACTIVADO") 
                            {
                                echo "<td><button class='btn-success' id='btn-success'>" . $row->{'status_periodo'} . "</button></td>";
                            } 
                            else 
                            {
                                echo "<td><button class='btn-danger' id='btn-danger' onclick='activarPeriodo(this);'>" . $row->{'status_periodo'} . "</button></td>";
                            }

                            echo "<td>"
                               . "<a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                               . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
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

    </body>
</html> 