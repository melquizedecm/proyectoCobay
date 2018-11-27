<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/gruposController.php');
$grupos= new gruposController();
require_once ('../../models/Grupos.php');
?>
<!DOCTYPE html>
<!--
Author: Christian Garcia
Program:  Alta de Grupos 
description: 
1. Formulario pra subir grupos
2. Lista de Grupos.
-->

<head>
     <?php
    getMeta("Administración de Grupos");
    estilosPaginas();
    ?>
    
    <script type="text/javascript">
        var temp;
        $(document).ready(function () {
            
            ///////DATABLES ////////
            $(document).ready(function () {
                $('#tableGrupo').DataTable();
            });


            ///////GENERACION DEL CRUD EN LA TABLA////// 
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" class="form-control" name="inputId_grupo" id="inputId_grupo"  ></td>' +
                        '<td><input type="text" class="form-control" name="inputStatus" id="inputStatus" placeholder="Automatico" readonly ></td>' +
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
                var id_grupo = document.getElementById("inputId_grupo").value; 
                var status = document.getElementById("inputStatus").value; 
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/gruposController.php",
                        {
                            inputId_grupo:id_grupo,
                            inputStatus: status,
                            buttonCreate: true
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
                
                $(this).parents("tr").find("td:first-child").each(function () {
                    $(this).html('<input type="text" class="form-control" id="temporal" value="' + $(this).text() + '">');
                });
                temp=document.getElementById("temporal").value;
                $(this).parents("tr").find(".edit").toggle();
                $(".add-new").attr("disabled", "disabled");
                
                
                
                
            });
            
            
            /*Actualizar*/
             $(document).on("click", ".update", function () {
             if(confirm("Seguro desea actualizar este grupo?")){
                $(this).parents("tr").find("td:not(:last-child)").each(function ()  {


                    var id_grupo=document.getElementById("temporal").value;
                    alert("Se cambiara el valor "+temp+" con el nuevo valor "+id_grupo);
                   
                   
                //            var name = document.getElementById("input1").value;
                    //console.log(matAnt+'el nuevo'+matricula+'name'+name);

                             $.post("../../controllers/gruposController.php",
                                     {
                                         inputId_grupoactual: temp,
                                         inputId_gruponuevo: id_grupo,
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
            
            
            //desactivar grupo 
            
            $(document).on("click", ".btn-success", function () {
                                     /*alert($(this).parents("tr").html());*/
                  /*$(this).parents("tr").remove();*/
                     /*alert($(this).parents("tr").html());*/
                     if(confirm("¿Seguro que desea DESACTIVAR este grupo?")){
                     var id_grupo=($(this).parents("tr").find("td:first-child").html());
                     /*alert($(this).parents("tr").find("td:first-child").html());*/
                                /*$(".add-new").removeAttr("disabled");*/


                        /////GUARDAR LOS DATOS/////
                        //1. OBTENER LOS VALORES//

                        //2. ENVIAR POR POTS//
                        //$.post("url", variables, response);
                        $.post("../../controllers/gruposController.php",
                                {
                                    inputId_grupo: id_grupo,
                                    buttonDesactivar: true
                                },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al DESACTIVAR el grupo, revise su conexión de internet");
                            } else {
                                alert("Grupo DESACTIVADO con éxito");
                                location.reload(true);
                            }
                        });
                    }
                    });
            //fin cambiar estado grupo
            
            
            //activar grupo 
            
            
            $(document).on("click", ".btn-danger", function () {
                                  /*alert($(this).parents("tr").html());*/
                  /*$(this).parents("tr").remove();*/
                     /*alert($(this).parents("tr").html());*/
                      if(confirm("¿Seguro que desea ACTIVAR este grupo?")){
                     var id_grupo=($(this).parents("tr").find("td:first-child").html());
                     
               $.post("../../controllers/gruposController.php",
                                {
                                    inputId_grupo: id_grupo,
                                    buttonActivar: true
                                },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al ACTIVAR el grupo, revise su conexión de internet");
                            } else {
                                alert("Grupo DESACTIVADO con éxito");
                                location.reload(true);
                            }
                        });
                    }
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
                    <div class="col-sm-8"><h2><center>Administración De <b>Grupos</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo Grupo</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tableGrupo">
                <thead>
                    <tr>
                        <th>Semestre y Grupo</th>
                        <th>Estatus</th>
                        <th>Herramientas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $json = $grupos->read();
                    $datosTabla = json_decode($json);

                    //print $obj->{'foo-bar'};
                     
                    
                    

                    foreach ($datosTabla as $row) {
                        echo "<tr><td>" . $row->{'id_grupo'} . "</td>";
                        if ($row->{'status'} === "ACTIVADO") {
                                echo "<td><button class='btn-success'>" . $row->{'status'} . "</button></td>";
                            } else {
                                echo "<td><button class='btn-danger' id='btn-activar' onclick='activarGrupo(this);'>" . $row->{'status'} . "</button></td>";
                            }
                            echo "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
    . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
   /* . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"*/
    . "<a class = 'update' title = 'Actualizar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE863;</i></a>"
    . "</td> </tr>";
}
?>


<!--   <tr>
    <td>03</td>
    <td>270697214582</td>
    <td>Gemma Canul Gongora</td>
    <td>
        <a class="add" title="Agregar" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
        <a class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
        <a class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
    </td>
</tr>      -->
                </tbody>
            </table>
        </div>
    </div> 
     <?php
getFooter();
    ?>
</body>
</html>