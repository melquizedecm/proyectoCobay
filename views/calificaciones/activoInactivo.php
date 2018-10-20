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
<body>
    <div style="align-items: center"><label><h2>Lista de Calificaciones</h2></label></div>
    
              
	<table WIDTH="900">

           <thead>
            <tr>
                <th scope="col" class="bg-success" >Alumnos</th>
                <th colspan="5" class="bg-primary">Materias</th>
             </tr>
             <tr>
                 <th scope="col" class="col-1 "></th>
                 <th scope="col" class="col-1">Español</th>
                 <th scope="col" class="col-1">Matematicas</th>
                 <th scope="col" class="col-1">Fisica</th>
                 <th scope="col" class="col-1">Quimica</th>
                 <th scope="col" class="col-1">Sociales </th>

             </tr>
          </thead>
          <tbody>
            <tr>
                <th scope="row" class="bg-success">Ricardo</th>
              <td>80</td>
              <td>90</td>
              <td>90</td>
              <td>90</td>
               <td>100</td>
               <td><input type="button" value="ocultar"></td>
                             <td><input type="button" value="mostrar"></td>


            </tr>
            <tr>
              <th scope="row">Carlos</th>
              <td>100</td>
              <td>90</td>
              <td>90</td> 
              <td>90</td>
              <td>100</td>
              <td><input type="button" value="ocultar"></td>
                            <td><input type="button" value="mostrar"></td>


            </tr>
            <tr>
              <th scope="row" class="bg-success">Marcos</th>
              <td>90</td>
              <td>60</td>
              <td>60</td>
              <td>90</td>
              <td>65</td>
              <td><input type="button" value="ocultar"></td>
                            <td><input type="button" value="mostrar"></td>


            </tr>
          </tbody>

        </table>
    </body>
</html> 

