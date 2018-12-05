<?php
/*
 * Se realiza el diseño de la vista del administrado en calificaciones
 * Si el alumno debe mas de 3 materia, el administrador tendrá la opción de
 * sellecciona el boton de inactivo y ya no se mostrarán las calificaciones.
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calificacione</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <style>
        td {
            background-color: #F6FFD7;
        }


    </style><!--hola mecs-->

    <div style="text-align:center;">

        <body>

            <div style="align-items: center"><label><h2>Lista de Calificaciones</h2></label></div>
            <div style="text-align:center;">

                <table table style="margin: 0 auto" class="table-bordered">
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
                        <select name="Semestre">
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
                        <select name="Alumno">
                            <option>Seleccionar</option>
                            <option>Ricardo</option>
                            <option>Jacob</option>
                            <option>Jose</option>
                            <option>Brayan</option>
                            <option>Glendy</option>
                            <option>Aurora</option>

                        </select>
                    </th>
                    <td> Calificaciones <input type="button" value="Modificar"><input type="button" value="Subir"></td>


                </table>
                <td></td>
 


                <table table style="margin: 0 auto" class="table-bordered">

                    <tr>

                        <th>Alumno</th>
                        <th>Materia</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Ordinario</th>
                        <th>Califiación</th>
                        <th>Acción</th>

                    </tr>

                    <tr>

                        <td rowspan="5">Ricardo</td>
                        <td> Matemáticas</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td rowspan="5"><input type="button" value="ocultar"><input type="button" value="mostrar"></td>
                    </tr>
                    <tr>

                        <td> Física</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>

                    </tr><tr>

                        <td> Español</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>

                    </tr><tr>

                        <td> Inglés</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>

                    </tr><tr>

                        <td> Química</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>
                        <td> 100</td>

                    </tr>

                </table>
            
        <td> </td>
 

</html> 

