<!DOCTYPE html>
<!--
Author: Carlos Castro, Meluizedec Moo Medina
Program:  Alta de Docentes 
description: 
1. Formulario para subir docentes 
2. Lista de Docentes.
-->
<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/docentesController.php');
$docentes = new DocentesController();
require_once ('../../models/Docentes.php');
?>

<head>
    <?php
    getMeta("Administración de Docentes");
    estilosPaginas();
    ?>

    <script type="text/javascript">
        $(document).ready(function () {

            ///////DATABLES ////////
            $('#tableDocente').DataTable();
            ///////GENERACION DEL CRUD EN LA TABLA////// 
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" class="form-control" name="inputMatricula" id="inputMatricula"></td>' +
                        '<td><input type="text" class="form-control" style="text-transform:uppercase" name="inputNombre" id="inputNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        //'<td><input type="text" class="form-control" name="inputEstado" id="inputEsatdo"></td>' +
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .delete , .update").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });

            function NumText(string) {//solo letras y numeros
                var out = '';
                //Se añaden las letras validas
                var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890';//Caracteres validos
                for (var i = 0; i < string.length; i++) {
                    if (filtro.indexOf(string.charAt(i)) != -1) {
                        out += string.charAt(i);
                    } else {
                        out = "alerta"
                        return out;
                    }
                }
                return out;
            }

            function Num(int) {//solo letras y numeros
                var out = '';
                //Se añaden las letras validas
                var filtro2 = '1234567890';//Caracteres validos
                for (var i = 0; i < int.length; i++) {
                    if (filtro2.indexOf(int.charAt(i)) != -1) {
                        out += int.charAt(i);
                    } else {
                        out = "alerta"
                        return out;
                    }
                }
                return out;
            }
            // Add row on add button click (Agregar base de datos)
            $(document).on("click", ".add", function () {
                /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
                var matricula = document.getElementById("inputMatricula").value; //(JALAR EL VALOR INGRESADO)
                var nombre = document.getElementById("inputNombre").value;
                var comp = NumText(nombre);
                var num = Num(matricula);
                if (comp === "alerta" || num === "alerta") {
                    alert("solo se puede ingresar Números o Letras");

                    location.reload(true);
                } else
                {
                    //var estado = document.getElementById("inputEstado").value;

                    //2. ENVIAR POR POTS//
                    //$.post("url", variables, response);
                    $.post("../../controllers/docentesController.php",
                            {
                                inputMatricula: matricula,
                                inputNombre: nombre,
                                //inputEstado: estado,
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
                }
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
                $(".update").removeAttr("enabled");
            }
            var cont = 0;
// Edit row on edit button click
            $(document).on("click", ".edit", function () {
                var cont = 0;
                $(this).parents("tr").find("td:not(:last-child)").each(function () {
                    $(this).html('<input name="input' + cont + '" id="input' + cont + '" value="' + $(this).text() + '" >');
                    cont = cont + 1;
                });
                $(this).parents("tr").find(".edit").toggle();
                $(".update").attr("disabled", "disabled");
            });
            //actualizar
            $(document).on("click", ".update", function () {
                $(this).parents("tr").find("td:nth-child(2)").each(function () {
                    var matricula = document.getElementById("input0").value;
                    var nombre = document.getElementById("input1").value.toUpperCase();
                    //
                    //    
                    //            var name = document.getElementById("input1").value;
                    //console.log(matAnt+'el nuevo'+matricula+'name'+name);

                    $.post("../../controllers/docentesController.php",
                            {
                                matricula: matricula,
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
            });
            // Delete row on delete button click
            $(document).on("click", ".delete", function () {
                if (confirm("¿Seguro que desea ELIMINAR este docente?")) {
                    $(this).parents("tr").remove();
                    //alert($(this).parents("tr").html());/
                    var matriculaMaestro = ($(this).parents("tr").find("td:first-child").html());
                    $(".add-new").removeAttr("disabled");
                    // pongo el nuevo codigo
                    $.post("../../controllers/docentesController.php",
                            {
                                matricula_maestro: matriculaMaestro,
                                buttonDelete: true
                            },
                    function (data) {
                        if (data === "-1") {
                            alert("Error al borrar el dato");

                        } else {
                            //alert(data);
                            alert("Registro eliminado");
                            location.reload(true);
                        }
                    });
                }
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
                    <div class="col-sm-8"><h2><center><b>Administración de Docentes</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo Docente</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tableDocente">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $docentes->read();
                    $datosTabla = json_decode($json);

//print $obj->{'foo-bar'};
                    //data-id=".$row->('id')."
                    $cont = 0;
                    foreach ($datosTabla as $row) {
                        $cont++;
                        echo "<tr  data-fila=" . $cont . ">"
                        . "<td id='mat" . $cont . "'>" . $row->{'matricula_maestro'} . "</td>"
                        . "<td id='name" . $cont . "'>" . $row->{'nombre'} . "</td>"
                        //"<td id='name" . $cont . "'>" . $row->{'estado'} . "</td>"
                        . "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                        . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                        . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"
                        . "<a class = 'update' title = 'Actualizar'  data-toggle = 'tooltip'><i class = 'material-icons'>&#xE863;</i></a>"
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


