<?php
/* 
 * Author: José Luis Rivera
 * Program: Consultar Calificaciones
 * Description:
 * 1. Formulario para que el alumno vea sus calificaciones del semestre actual
 */

//importamos los archivos del modelo y del controlador
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/consultarcalificacionController.php');
$alumno= new consultarcalificacionController();
require_once ('../../models/Consulta.php');

?>
<!DOCTYPE html>
<title>Mis calificaciones</title>
<head>
    <?php
    getMeta("Tabla de calificaciones");
    estilosPaginas();
    ?>

<!--
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mis calificaciones</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  #F5F7FA
<?php
getMeta ("Tabla de calificaciones");
estilosPaginas();
?>

<!--    body {
        color: #404E67;
        background: #66CDAA; 
		font-family: 'Open Sans', sans-serif;
	}
	.table-wrapper {
		width: 700px;
		margin: 30px auto;
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }-->
<style type="text/css">

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
	table.thead{
		
		background: #57C472;
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
	
	thead{
	background-color: #01A75D;
	color: white;
	}
	
	tr:nth-child(ever){
	background-color: #ddd;	
	}
	tr:hover td{
	background-color:#F5F7FA;
	color: black; 
 }
	
</style>

<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="name" id="name"></td>' +
            '<td><input type="text" class="form-control" name="department" id="department"></td>' +
            '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
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
                    <div class="col-sm-9"><h2> <b>Tabla de calificaciones</b></h2></div>
                    <div class="col-sm-3">
                    <!--   <button type="button" class="btn btn-danger"><i class="fa fa-power-off"></i> Cerrar sesión</button> -->
                    </div>
                </div>
                <h4>Alumno:
                    <?php
                    //mostramos el nombre del alumno
                    //usare de ejemplo la matrícula 17B003000037
                    //consulta a utilizar SELECT nombre FROM `alumnos` WHERE matricula = '17B003000037'
                    
                    $json = $alumno->ObtenerNombre("17B003000004");
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) {
                        echo $row->{'nombre'};
                    }
                    ?>
                </h4>
                <h4>Semestre: 
                    <?php
                    $json = $alumno->ObtenerSemestre("17B003000004");
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) {
                        echo $row->{'id_semestre'};
                    }
                    ?>
                </h4>
                <h4>Grupo: 
                    <?php
                    $json = $alumno->obtenerGrupo("17B003000004");
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) {
                        echo $row->{'grupo'};
                    }
                    ?>
                </h4>

            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Ordinario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $alumno->llenarTabla("17B003000004");
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) {
                        echo "<tr><td>" . $row->{'asignatura'} . "</td>"
                        . "<td>" . $row->{'parcial_uno'} . " </td>"
                        . "<td>" . $row->{'parcial_dos'} . " </td>"
                        . "<td>" . $row->{'ordinario'} . " </td>" 
                        . "</tr>";
                    }
                    ?>

                    <!--
                    <tr>
                        <td>Ética y valores I</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
			<td>100</td>
                    </tr>
				    <tr>
                        <td>Introducción a las ciencias sociales</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
			<td>100</td>
                    </tr>
			<tr>
                        <td>Lengua Adicional al Español I</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
			<td>100</td>
                    </tr>
			<tr>
                        <td>Química I</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
			<td>100</td>
                    </tr>
			<tr>
                        <td>Taller de lectura y redacción I</td>
                        <td>35</td>
                        <td>35</td>
                        <td>30</td>
			<td>100</td>
                    </tr>-->
                </tbody>
					
            </table>
        </div>
    </div>   
    <?php
    getFooter();
    ?>
</body>
</html>      
