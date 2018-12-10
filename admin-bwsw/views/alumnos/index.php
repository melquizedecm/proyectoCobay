<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/alumnosController.php');
$Alumnos = new alumnosController();
require_once ('../../models/Alumnos.php');
?>
<!DOCTYPE html>
<!--
Author: Brayan Cetina
Program:  Alta de alumnos 
description: 
1. Formulario pra subir docentes 
2. Lista de Alumnos.
-->

<head>
    <?php
    getMeta("Alta de Alumnos");
    estilosPaginas();
    ?>
    <script type="text/javascript">
        var ActualMatricula;
        var ActualNombre;
        $(document).ready(function () {

            ///////DATABLES ////////
            $('#tableAlumnos').DataTable();

            ///////GENERACION DEL CRUD EN LA TABLA////// 
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" class="form-control" name="inputMatricula" id="inputMatricula"></td>' +
                        '<td><input type="text" class="form-control" name="inputNombre" id="inputNombre"></td>' +
                        '<td><input type="text" class="form-control" name="inputEstatus" id="inputEstatus"></td>' +
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .delete , .update").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });
            // Add row on add button click (Agregar base de datos)
            $(document).on("click", ".add", function () {
                /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
                var matricula = document.getElementById("inputMatricula").value; //(JALAR EL VALOR INGRESADO)
                var nombre = document.getElementById("inputNombre").value;
                var estatus = document.getElementById("inputEstatus").value;
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/alumnosController.php",
                        {
                            inputMatricula: matricula,
                            inputNombre: nombre,
                            inputEstatus: estatus,
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
                $(".update").removeAttr("enabled");
            }
            // Delete row on delete button click
            $(document).on("click", ".delete", function () {
                var matricula = $(this).parents("tr").find("td:first-child").html();
                $.post("../../controllers/alumnosController.php",
                        {
                            inputMatricula: matricula,
                            buttonDelete: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al guardar los datos, revisar la matricula: " + matricula);
                            } else {
                                location.reload(true);
                            }
                        });
            });
        });

        //desactivar grupo 
        $(document).on("click", ".btn-success", function () {
            if (confirm("¿Esta seguro de la Acción?")) {
                var matricula = ($(this).parents("tr").find("td:first-child").html());
                $.post("../../controllers/alumnosController.php",
                        {
                            input_matricula: matricula,
                            buttonDesactivar: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error de conexión.");
                            } else {
                                location.reload(true);
                            }
                        });
            }
        });
        //fin cambiar estado grupo

        //activar grupo 
        $(document).on("click", ".btn-danger", function () {
            if (confirm("¿Esta seguro de la Acción?")) {
                var matricula = ($(this).parents("tr").find("td:first-child").html());
                $.post("../../controllers/alumnosController.php",
                        {
                            input_matricula: matricula,
                            buttonActivar: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error en la conexión.");
                            } else {
                                location.reload(true);
                            }
                        });
            }
        });

        // Edit row on edit button click
        $(document).on("click", ".edit", function () {
            //busca
            $(this).parents("tr").find("td:nth-child(1)").each(function () {
                $(this).html('<input type="text" style="text-transform:uppercase" class="form-control" id="Matricula" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="' + $(this).text() + '">');
            });
            //busca 
            $(this).parents("tr").find("td:nth-child(2)").each(function () {
                $(this).html('<input type="text" style="text-transform:uppercase" class="form-control" id="Nombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="' + $(this).text() + '">');
            });
            ActualMatricula = document.getElementById("Matricula").value;
            ActualNombre = document.getElementById("Nombre").value;
            $(this).parents("tr").find(".edit").toggle();
            $(".add-new").attr("disabled", "disabled");

        });

        /*Actualizar*/
            $(document).on("click", ".update", function () {
            var nuevaMatricula = document.getElementById("Matricula").value;
            var nuevoNombre = document.getElementById("Nombre").value;
            if (confirm("Se modificaran los datos, esta seguro de esto?")) {
                $.post("../../controllers/alumnosController.php",
                        {
                            Matricula: ActualMatricula,
                            imputMatriculaNueva: nuevaMatricula,
                            inputNombreNuevo: nuevoNombre,
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
            }
        });
        //fin cambiar estado grupo
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
                    <div class="col-sm-8"><h2><center> Control <b>Alumnos.</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo Alumno</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tableAlumnos">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Estado Actual</th>
                        <th>Mostrar Calificaciones </th>
                        <th>Herramientas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $Alumnos->read();
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) {
                        echo "<tr>"
                        . "<td>" . $row->{'matricula'} . "</td>"
                        . "<td>" . $row->{'nombre'} . "</td>"
                        . "<td>" . $row->{'status'} . "</td>";
                        if ($row->{'aviso'} === "SIN PENDIENTES") {
                            echo "<td><button class='btn-success'>" . $row->{'aviso'} . "</button></td>";
                        } else {
                            echo "<td><button class='btn-danger' id='btn-activar' onclick='activarPeriodo(this);'>" . $row->{'aviso'} . "</button></td>";
                        }
                        echo "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
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