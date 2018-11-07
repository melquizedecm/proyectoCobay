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
$docentes= new PeriodosController();
require_once ('../../models/Periodos.php');
?>
     

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PERIODOS</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
$(document).ready(function()
{
            ///////DATABLES ////////
            $(document).ready(function () 
            {
                $('#tablaPeriodos').DataTable();
            });
            
            //GENERACION DEL CRUD EN LA TABLA
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();

            //Append table with add row form on add new button click
            $(".add-new").click(function()
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
            $(document).on("click", ".add", function()
            {
                /////GUARDAR LOS DATOS/////
                //1. OBTENER LOS VALORES//
                var id= document.getElementById("inputId").value; //Jalar valor ingresado
                var periodo = document.getElementById("inputPeriodo").value;
                var estatus = document.getElementById("inputEstatus").value;
                //2. ENVIAR POR POTS//
                //$.post("url", variables, response);
                $.post("../../controllers/periodosController.php",
                        {
                            //Datos post
                            inputId:id,
                            inputPeriodo: periodo,
                            inputEstatus: estatus,
                            buttonCreate: true
                        },
                        function (data) 
                        {
                            if (data === "-1") 
                            {
                                alert("Error al guardar los datos, revisar la matricula");
                            } 
                            else 
                            {
                                ///despliega la tabla con los datos////
                                alert(data);
                            }
                        });
            });
            //3. REFRESCAR LOS VALORES///
		
            var empty = false;
            var input = $(this).parents("tr").find('input[type="text"]');
            input.each(function()
            {
                if(!$(this).val())
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
            if(!empty)
            {
                input.each(function()
                {
                    $(this).parent("td").html($(this).val());
                });			
		$(this).parents("tr").find(".add, .edit, .active").toggle();
		$(".add-new").removeAttr("disabled");
            }		
            
            // Edit row on edit button click
            $(document).on("click", ".edit", function()
            {		
                $(this).parents("tr").find("td:not(:last-child)").each(function()
                {
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
            });
            
            // Delete row on delete button click
            $(document).on("click", ".delete", function()
            {
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    
                    $json = $docentes->read();
                    $datosTabla = json_decode($json);

                    foreach ($datosTabla as $row) 
                    {
                        echo "<tr><td>" . $row->{'id_periodo'} . "</td>"
                               . "<td>" . $row->{'periodo'} . "</td>"
                               . "<td>" . $row->{'id_status_periodo'} . "</td>"
                               . "<td>"
                               . "<a class = 'active' title = 'Activar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xe008;</i></a>"
                               . "<a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                               . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                               . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"
                           . "</td></tr>";
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html> 