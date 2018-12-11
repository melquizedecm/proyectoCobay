<?php
require_once '../../lib/links.php';
libnivel3();
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
  
<?php
getMeta("Asignar calificaciones");
estilosPaginas();
?>
<script type="text/javascript">

    function cargarHojaExcel()
    {
        if (document.frmcargararchivo.excel.value == "")
        {
            alert("Seleccione un archivo");
            document.frmcargararchivo.excel.focus();
            return false;
        }
        
        document.frmcargararchivo.action = "../../controllers/calificacionController.php";
        document.frmcargararchivo.submit();
    }

    $(document).ready(function () {
        //GENERACION DE LA TABLA
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
                    '<td><input type="text" class="form-control" name="inputparcial_1" id="inputparcial_1"></td>' +
                    '<td><input type="text" class="form-control" name="inputparcial_2" id="inputparcial_2"></td>' +
                    '<td><input type="text" class="form-control" name="inputordinario" id="inputordinario"></td>' +
                    '<td><input type="text" class="form-control" name="inputpromedio" id="inputpromedio"></td>' +
                    '</tr>';
            $("table").append(row);
            $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        
        
        // Add row on add button click
        $(document).on("click", ".add", function () {
             /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
                var nombre = document.getElementById("inputname").value; //(JALAR EL VALOR INGRESADO)
                var matricula = document.getElementById("inputmatricula").value;
                var parcial1 = document.getElementById("inputparcial_1").value;
                var parcial2 = document.getElementById("inputparcial_2").value;
                var promedio = document.getElementById("inputpromedio").value;
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/calificacionController.php",
                        {
                            inputname: nombre,
                            inputmatricula: matricula,
                            inputparcial_1: parcial1,
                            inputparcial_2: parcial2,
                            inputpromedio: promedio,
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
    <?php
    getHeader();
    ?>
    <div class="container">
            <?php
            if(isset($_GET['message'])){
                imprimirMensaje($_GET['type'], $_GET['message']);
            }
            if(isset($_GET['action']) && $_GET['action']=="2"){
                ?>
                 <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Nota:</strong> El archivo se subio exitosamente
                </div>
                <?php
            }
            if(isset($_GET['action']) && $_GET['action']=="1"){
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Nota:</strong> El archivo no se ha subido
                </div>
                <?php
            }
            ?>
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

                    
                    <div class="col-sm-2" >
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
                                        <table table class="table table-bordered" class="fa fa-plus">
                                            <th>
                                                <select name="Semestre">
                                                    <option>Semestre</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>

                                                </select>
                                            </th>
                                            <th>
                                                <select name="Grupo">
                                                    <option>Grupo</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                    <option>E</option>
                                                    <option>F</option>

                                                </select>
                                            </th>
                                            <th>
                                                <select name="Materia">
                                                    <option>Materia</option>
                                                    <option>ingles</option>
                                                    <option>Matematicas</option>
                                                    

                                                </select>
                                            </th>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
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
     <?php
    getFooter();
    ?>
</body>

