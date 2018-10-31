<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * author: Jacob Luna
 * Program: Subir Calificaciones
 * Description:
 * 1. Formulario para subir excel
 * 2. Lista de alumnos con su calificación
 * 
 */
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">

    body {
        color: #404E67;
        background: #F5F7FA;
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
</style>
<script type="text/javascript">

    function cargarHojaExcel()
    {
        if (document.frmcargararchivo.excel.value == "")
        {
            alert("Seleccione un archivo");
            document.frmcargararchivo.excel.focus();
            return false;
        }

        document.frmcargararchivo.action = "..//..//controllers//calificacionController.php";
        document.frmcargararchivo.submit();
    }

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        var actions = $("table td:last-child").html();
        // Append table with add row form on add new button click
        $(".add-new").click(function () {
            $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                    '<td></td>' +
                    '<td><input type="text" class="form-control" name="inputname" id="inputname"></td>' +
                    '<td><input type="text" class="form-control" name="inputmatricula" id="inputmatricula"></td>' +
                    '<td><input type="text" class="form-control" name="inputparcial 1" id="inputparcial_1"></td>' +
                    '<td><input type="text" class="form-control" name="inputparcial 2" id="inputparcial_2"></td>' +
                    '<td><input type="text" class="form-control" name="inputordinario" id="inputordinario"></td>' +
                    '<td><input type="text" class="form-control" name="inputpromedio" id="inputpromedio"></td>' +
                    '</tr>';
            $("table").append(row);
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
        });
        // Add row on add button click
        $(document).on("click", ".add", function () {
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

    <div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">

                    <div class="col-sm-8"><center><h2>Calificaciones de alumnos <b></b></h2></center></div>

                </div>
                <div class="row">
                    <div class="col-sm-6" >
                        <form name="frmcargararchivo" method="post" enctype="multipart/form-data" class="md-form">
                            <div class="file-field">

                                <div class="btn btn-primary btn-sm float-left">
                                    <span>Elije tu archivo</span>
                                    <input type="file" name="excel">
                                </div>

                            </div>
                            <div>
                                <input type="button" value="subir" class="btn btn-info" onclick="cargarHojaExcel();" />
                            </div>
                        </form>
                    </div>     

                    <!--<div >
                        <div class="dropdown">

                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Grupos
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1A</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1B</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1C</a></li>


                            </ul>

                        </div>

                        <div class="dropdown">

                            <button class="btn btn-default dropdown-toggle" type="button" id="menu2" data-toggle="dropdown">Materias
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu2">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Informatica</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Matematicas</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ingles 1</a></li>
                            </ul>

                        </div>
                         <div class="dropdown">

                            <button class="btn btn-default dropdown-toggle" type="button" id="menu3" data-toggle="dropdown">Semestre
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu3">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Primero</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Tercero</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Quinto</a></li>
                            </ul>

                        </div>
                    </div>-->
                    <div class="col-sm-2" >
                        <!--<button type="button" class="btn btn-info"><i class="fa fa-plus"></i> Buscar Lista de Alumnos</button>-->
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Buscar Lista de Alumnos</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Selección de Lista</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Matricula</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Ordinario</th>
                        <th>Promedio</th>

                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>1</td>
                        <td>Juan Carlos Rodriguez</td>
                        <td>4160020B</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
                        <td>100</td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Carlos Castro</td>
                        <td>4160003B</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Aaron Pech</td>
                        <td>4160016B</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
                        <td>100</td>

                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nerstor Reina</td>
                        <td>4160013B</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
                        <td>100</td>

                    </tr> 
                </tbody>
            </table>
        </div>
    </div>     
</body>

