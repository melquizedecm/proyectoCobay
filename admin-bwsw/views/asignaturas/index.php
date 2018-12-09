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
                        '<td><input type="text" class="form-control" style="text-transform:uppercase" name="inputClave" id="inputClave" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        '<td><input type="text" class="form-control" style="text-transform:uppercase" name="inputNombre" id="inputNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        '<td><input type="text" class="form-control" name="inputStatus" id="inputStatus" placeholder="Automatico" readonly="readonly"></td>' +
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });

            function NumText(string) {//solo letras y numeros
                var out = '';
                //Se añaden las letras validas
                var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890- ';//Caracteres validos

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

            // Add row on add button click
            $(document).on("click", ".add", function () {
                ////////GUARDAR LOS DATOS//////
                ///1. OBTENER LOS VALORES/////
                var clave = document.getElementById("inputClave").value;
                var nombre = document.getElementById("inputNombre").value;
                var status = document.getElementById("inputStatus").value;
                var comp = NumText(clave);
                var comp2 = NumText(nombre);
                if (comp === "alerta" || comp2 === "alerta") {
                    alert("Solo se aceptan los siguientes caracteres: letras, números, -");

                    location.reload(true);

                } else
                {
                    var tamaño = clave.length;
                    if (tamaño > 20) {
                        alert("Maximo 20 carácteres para la Clave");

                        location.reload(true);
                    } else {
                        if (clave === "") {
                            alert("No se aceptan campos vacios ");

                            location.reload(true);
                        } else {
                            var tamaño2 = nombre.length;
                            if (tamaño2 > 50) {
                                alert("Maximo 50 carácteres para el Nombre");

                                location.reload(true);
                            } else {
                                if (nombre === "") {
                                    alert("No se aceptan campos vacios ");

                                    location.reload(true);
                                } else {
                                    if (confirm("Esta por agregar un nuevo registro\n¿Los datos son correctos?")) {
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
                                                    } else if (data === "-2") {
                                                        alert("Esta clave o asignatura ya existe");
                                                    } else {
                                                        alert("Registro Guardado con éxito");
                                                        location.reload(true);
                                                    }
                                                });
                                    }
                                }
                            }
                        }
                    }
                }

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
                var cont = 0;

                $(this).parents("tr").find("td:nth-child(2)").each(function () {

                    $(this).html('<input type="text" style="text-transform:uppercase" class="form-control" id="input2" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="' + $(this).text() + '" >');

                });
                temp = document.getElementById("input2").value;
                $(this).parents("tr").find(".edit").toggle();
                $(".update").attr("disabled", "disabled");
            });

            //actualizar
            $(document).on("click", ".update", function () {


                var nombre = document.getElementById("input2").value;
                var comp = NumText(nombre);

                if (comp === "alerta") {
                    alert("Solo se aceptan letras y numeros");
                    location.reload(true);

                } else if (nombre === temp) {
                    location.reload(true);
                } else {
                    if (nombre === "") {
                        alert("No se aceptan campos vacios ");
                        location.reload(true);
                    } else {
                        if (confirm("Se cambiara el valor " + temp + " con el nuevo valor " + nombre + "." + "\n¿Esta seguro de realizar esta acción?")) {
                            //apartir de aqui se ejecuta 2 veces el procesos, error en la linea 122   

                            $(this).parents("tr").find("td:nth-child(2)").each(function () {
                                $.post("../../controllers/asignaturasController.php",
                                        {
                                            nombreactual: temp,
                                            input2: nombre,
                                            buttonUpdate: true
                                        },
                                        function (data) {
                                            if (data === "-1") {
                                                alert("Error al guardar los datos, revisar la matricula");
                                            } else if (data === "-2") {
                                                alert("Esta materia ya existe");
                                            } else {
                                                alert("Registro Guardado con éxito");
                                                location.reload(true);
                                            }
                                        });
                            });
                        }
                    }
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
                if (confirm("¿Seguro que desea DESACTIVAR esta asignatura?")) {
                    var clave = ($(this).parents("tr").find("td:first-child").html());
                    //alert($(this).parents("tr").find("td:first-child").html());
                    /*$(".add-new").removeAttr("disabled");*/


                    /////GUARDAR LOS DATOS/////
                    //1. OBTENER LOS VALORES//

                    //2. ENVIAR POR POTS//
                    //$.post("url", variables, response);
                    $.post("../../controllers/asignaturasController.php",
                            {
                                inputClave: clave,
                                buttonDesactivar: true
                            },
                            function (data) {
                                if (data === "-1") {
                                    alert("Error al DESACTIVAR la asignatura, revise su conexión de internet");
                                } else {
                                    alert("Asignatura DESACTIVADA con éxito");
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
                if (confirm("¿Seguro que desea ACTIVAR esta asignatura?")) {
                    var clave = ($(this).parents("tr").find("td:first-child").html());


                    $.post("../../controllers/asignaturasController.php",
                            {
                                inputClave: clave,
                                buttonActivar: true
                            },
                            function (data) {
                                if (data === "-1") {
                                    alert("Error al ACTIVAR la asignatura, revise su conexión de internet");
                                } else {
                                    alert("Asignatura ACTIVADA con éxito");
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
                        . "<td>" . $row->{'asignatura'} . "</td>";
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
