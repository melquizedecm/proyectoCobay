<!DOCTYPE html>
<?php
require_once ("../../lib/links.php");
libnivel3();
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php getMeta("Perfil de Usuario"); ?>
    </head>
    <body>
        <?php getHeader(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="list-group ">
                        <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                        <a href="#" class="list-group-item list-group-item-action">Cambiar Contraseña</a>
                        <a href="#" class="list-group-item list-group-item-action">Perfil de Usuario</a>
     
                    </div> 
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Your Profile</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <div class="form-group row">
                                            <label for="username" class="col-4 col-form-label">Nombre de Usuario*</label> 
                                            <div class="col-8">
                                                <input id="username" name="username" placeholder="Ejemplo: Juan2018" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-4 col-form-label">Nombres</label> 
                                            <div class="col-8">
                                                <input id="name" name="name" placeholder="Ejemplo: Juan" class="form-control here" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="lastname" class="col-4 col-form-label">Apellidos</label> 
                                            <div class="col-8">
                                                <input id="lastname" name="lastname" placeholder="Ejemplo: Pérez Pérez" class="form-control here" type="text">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="email" class="col-4 col-form-label">Email*</label> 
                                            <div class="col-8">
                                                <input id="email" name="email" placeholder="email@cobay.com" class="form-control here" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newpass" class="col-4 col-form-label">Nuevo Password</label> 
                                            <div class="col-8">
                                                <input id="newpass" name="newpass" placeholder="Escribe tu password (8 digitos)" class="form-control here" type="text">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="offset-4 col-8">
                                                <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php getFooter();?>
    </body>
</html>
