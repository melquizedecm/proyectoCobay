<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/asignaturasController.php');
$asignaturas = new AsignaturasController();
require_once ('../../models/Asignaturas.php');
?>
<!DOCTYPE html>
<!--
Author: Aaron Pech
Program:  Control de Asignaturas 
description: 
1. Formulario pra subir asignaturas
2. Lista de Asignaturas.
-->

<!--<html>-->
<head>
    <?php
    getMeta("Administración de Asignaturas");
    estilosPaginas();
    ?>
    <script type="text/javascript">
        var temp;
        $(document).ready(function () {

            ///////DATABLES ////////
            $(document).ready(function () {
                $('#tableAsignatura').DataTable();
            });

            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" class="form-control" name="inputClave" id="inputClave"></td>' +
                        '<td><input type="text" class="form-control" name="inputNombre" id="inputNombre" ></td>' +
                        '<td><input type="text" class="form-control" name="inputStatus" id="inputStatus" placeholder="Automatico" readonly="readonly"></td>' +
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });
-
            // Add row on add button click
            $(document).on("click", ".add", function () {
                ////////GUARDAR LOS DATOS//////
                ///1. OBTENER LOS VALORES/////
                var clave = document.getElementById("inputClave").value;
                var nombre = document.getElementById("inputNombre").value;
                var status = document.getElementById("inputStatus").value; 


                ///2. ENVIAR POR POST    /////
                $.post("../../controllers/asignaturasController.php",
                        {
                            inputClave: clave,
                            inputNombre: nombre,
                            inputStatus: status,
                            buttonCreate: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al guardar los datos, revisar la clave");
                            } else {
                                alert("Registro Guardado con éxito");
                                location.reload(true);
                            }
                        });

                ///3. REFRESCAR LA TABLA O LA PAGINA////



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
            });


            // Edit row on edit button click
            $(document).on("click", ".edit", function () {
                var cont=0;
                
                $(this).parents("tr").find("td:not(:nth-child(3)):not(:last-child)").each(function () {
                    
                    $(this).html('<input name="input'+ cont +'" id="input' + cont + '" value="' + $(this).text() + '" >');
                    cont = cont + 1;
                    
                 });
                temp=document.getElementById("input0").value;
                $(this).parents("tr").find(".edit").toggle();
                $(".update").attr("disabled", "disabled");
            });
            
            //actualizar
           $(document).on("click", ".update", function () {
                
                    var clave = document.getElementById("input0").value;
                    var nombre = document.getElementById("input1").value;
               if(confirm("¿Esta seguro de realizar esta acción?")){
                //
                //    
                //            var name = document.getElementById("input1").value;
                    //console.log(matAnt+'el nuevo'+matricula+'name'+name);
                $(this).parents("tr").find("td:not(:last-child)").each(function () {
               $.post("../../controllers/asignaturasController.php",
                        {
                            claveactual: temp,
                            clave:  clave,
                            nombre: nombre,
                            buttonUpdate: true
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
                   }
            });


            // Delete row on delete button click
            $(document).on("click", ".delete", function () {
                $(this).parents("tr").remove();
                $(".add-new").removeAttr("disabled");
            });
            
            
            //desactivar asignatura 
            
            $(document).on("click", ".btn-success", function () {
                                     /*alert($(this).parents("tr").html());*/
                  /*$(this).parents("tr").remove();*/
                     /*alert($(this).parents("tr").html());*/
                     var clave=($(this).parents("tr").find("td:first-child").html());
                     alert($(this).parents("tr").find("td:first-child").html());
                                /*$(".add-new").removeAttr("disabled");*/

                
                /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
               
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
               $.post("../../controllers/asignaturasController.php",
                        {
                            inputClave:clave,
                            buttonDesactivar: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al guardar los datos, revisar el Id");
                            } else {
                                alert("Registro Guardado con éxito");
                                location.reload(true);
                            }
                        });
            });
            //fin cambiar estado grupo
            
            
            //activar grupo 
            
            
            $(document).on("click", ".btn-danger", function () {
                                  /*alert($(this).parents("tr").html());*/
                  /*$(this).parents("tr").remove();*/
                     /*alert($(this).parents("tr").html());*/
                     var clave=($(this).parents("tr").find("td:first-child").html());
                     alert($(this).parents("tr").find("td:first-child").html());
                     
               $.post("../../controllers/asignaturasController.php",
                        {
                            inputClave:clave,
                            buttonActivar: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al guardar los datos, revisar el Id");
                            } else {
                                alert("Registro Guardado con éxito");
                                location.reload(true);
                            }
                        });
            });
            //fin cambiar estado grupo
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
                    <div class="col-sm-8"><h2><center>Administración De <b>Asignaturas</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Añadir Nuevo</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tableAsignatura">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $json = $asignaturas->read();
                    $datosTabla = json_decode($json);

                    //print $obj->{'foo-bar'};

                    foreach ($datosTabla as $row) {
                        echo "<tr><td>" . $row->{'id_asignatura'} . "</td>"
                                ."<td>" . $row->{'asignatura'} . "</td>";
                        if ($row->{'status'} === "ACTIVA") {
                                echo "<td><button class='btn-success'>" . $row->{'status'} . "</button></td>";
                            } else {
                                echo "<td><button class='btn-danger' id='btn-activar' onclick='activarGrupo(this);'>" . $row->{'status'} . "</button></td>";
                            }
                            echo

                        "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                        . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                        . "<a class = 'update' title = 'Actualizar'  data-toggle = 'tooltip'><i class = 'material-icons'>&#xE863;</i></a>"
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