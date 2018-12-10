<?php
require_once ('../../lib/links.php');
libnivel3();
require_once ('../../controllers/administrativoController.php');
$administrativo = new AdministrativoController();
require_once ('../../models/Administrativo.php');
?>
<!DOCTYPE html>
<!--
Author:Glendy Cruz Canul
Program:  Alta de usuarios de docentes y administrativos 
description: 
1. Formulario pra subir usuarios 
2. Lista de usuarios.
-->

<head>
    <?php
    getMeta("Administración de Usuarios");
    estilosPaginas();
    ?>

    <script type="text/javascript">
        var usuarioact, contraseñaact, cargoact, nombreact;
        $(document).ready(function () {

            ///////DATABLES ////////
            $(document).ready(function () {
                $('#tableAdministrativo').DataTable();
            });
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            var c = 0;
            // Append table with add row form on add new button click
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:first-child").index();
                var row = '<tr>' +
                        '<td><input type="text" style="text-transform:uppercase" class="form-control" name="inputMatricula" id="inputMatricula"  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        '<td><input type="text"  class="form-control" name="inputPassword" id="inputPassword" ></td>' +
                        '<td><input type="text" style="text-transform:uppercase" class="form-control" name="inputCargo" id="inputCargo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        '<td><input type="text" style="text-transform:uppercase" class="form-control" name="inputNombre" id="inputNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></td>' +
                        '<td>' + actions + '</td>' +
                        '</tr>';
                $("table").prepend(row);
                $("table tbody tr").eq(index + 0).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });
            function NumText(string) {//solo letras y numeros
                var out = '';
                //Se añaden las letras validas
                var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890'; //Caracteres validos

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
                
                var matricula = document.getElementById("inputMatricula").value;
                                var comp = NumText(matricula);

                var password = document.getElementById("inputPassword").value;
                var comp2 = NumText(password);

                var cargo = document.getElementById("inputCargo").value;
                var nombre = document.getElementById("inputNombre").value;

                if (comp === "alerta" || comp2==="alerta") {
                    alert("Solo se aceptan letras y números");
                    location.reload(true);
                } 
          
                else {
                    if (matricula === "" || password === "" || cargo === "" || nombre === "") {
                        alert("No se aceptan campos vacios");
                        location.reload(true);
                    } 
                    else {
                        if (confirm("¿Esta seguro de realizar los cambios?")) {
                            $.post("../../controllers/administrativoController.php",
                                    {
                                        inputMatricula: matricula,
                                        inputPassword: password,
                                        inputCargo: cargo,
                                        inputNombre: nombre,
                                        buttonCreate: true
                                    },
                                    function (data) {
                                        if (data === "-1") {
                                            alert("Error al guardar los datos, revise su conexión de internet");
                                        } else if (data === "-2") {
                                            alert("Datos Existentes");
                                        } else {
                                            alert("Datos guardados con éxito");
                                            location.reload(true);
                                        }
                                    });
                        }
                    }
                }   
                
                ///2. ENVIAR POR POST    /////

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
                    //$(".update").removeAttr("enabled");
                }
            });
            //var cont = 0;
// Edit row on edit button click
/*
*  '<td><input type="text" class="form-control" name="inputMatricula" id="inputMatricula"></td>' +
                        '<td><input type="text" class="form-control" name="inputPassword" id="inputPassword" ></td>' +
                        '<td><input type="text" class="form-control" name="inputCargo" id="inputCargo"></td>' +
                        '<td><input type="text" class="form-control" name="inputNombre" id="inputNombre" ></td>' +
 */
            $(document).on("click", ".edit", function () {
                var cont = 0;
                $(this).parents("tr").find("td:not(:last-child)").each(function () {
                    $(this).html('<input name="input' + cont + '" style="text-transform:uppercase" class="form-control" id="input' + cont + '" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="' + $(this).text() + '">');
                    cont = cont + 1;
                });
                 
                usuarioact=document.getElementById("input0").value;
                contraseñaact=document.getElementById("input1").value;
                cargoact=document.getElementById("input2").value;
                nombreact=document.getElementById("input3").value;
                
                alert("act"+ usuarioact+ contraseñaact+ cargoact+nombreact);
                $(this).parents("tr").find(".edit").toggle();
                $(".add-new").attr("disabled", "disabled");

                
            });
            
            //actualizar
            $(document).on("click", ".update", function () {
                $(this).parents("tr").find("td:nth-child(4)").each(function () {
                    var matricula = document.getElementById("input0").value;
                    var password = document.getElementById("input1").value;
                    var cargo = document.getElementById("input2").value;
                    var nombre = document.getElementById("input3").value;
                    
                    alert("act"+ usuarioact+ contraseñaact+ cargoact+ nombreact+"\nnuevos "+matricula+password+cargo+nombre);

                    //
                    //    
                    //            var name = document.getElementById("input1").value;
                    //console.log(matAnt+'el nuevo'+matricula+'name'+name);

                    $.post("../../controllers/administrativoController.php",
                            {
                                inputMatricula: matricula,
                                inputPassword: password,
                                inputCargo: cargo,
                                inputNombre: nombre,
                                input0:usuarioact,
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
                var matricula = ($(this).parents("tr").find("td:first-child").html());
                $(".add-new").removeAttr("disabled");
                // pongo el nuevo codigo
                $.post("../../controllers/administrativoController.php",
                        {
                            inputMatricula: matricula,
                            buttonDelete: true
                        },
                        function (data) {
                            if (data === "-1") {
                                alert("Error al borrar el dato");
                            } else {
                                alert(data);
                                alert("Registro eliminado");
                                location.reload(true);
                            }
                        });
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
                    <div class="col-sm-8"><h2><center><b>Administración De Usuarios</b></h2></div></center>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Añadir Nuevo</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="tableAdministrativo">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Cargo</th>
                        <th>Nombre</th>
                        <th>Herramientas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $json = $administrativo->read();
                    $datosTabla = json_decode($json);

//print $obj->{'foo-bar'};
                    $cont = 0;
                    foreach ($datosTabla as $row) {
                        $cont++;
                        echo "<tr data-fila=" . $cont . "><td id='matricula" . $cont . "'>" . $row->{'matricula'} . "</td>"
                        . "<td id='password" . $cont . "'>" . $row->{'password'} . "</td>"
                        . "<td id='cargo" . $cont . "'>" . $row->{'cargo'} . "</td>"
                        . "<td id='nombre" . $cont . "'>" . $row->{'nombre'} . "</td>"
                        . "<td><a class = 'add' title = 'Agregar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE03B;</i></a>"
                        . "<a class = 'edit' title = 'Editar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE254;</i></a>"
                        . "<a class = 'delete' title = 'Eliminar' data-toggle = 'tooltip'><i class = 'material-icons'>&#xE872;</i></a>"
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