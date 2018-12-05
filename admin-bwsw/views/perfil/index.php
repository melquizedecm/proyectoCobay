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
                        <a href="#" class="list-group-item list-group-item-action">Cambiar Contraseña</a>
                        <a href="#" class="list-group-item list-group-item-action">Perfil de Usuario</a>

                    </div> 
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Editar Perfil</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>

                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Nombre Completo</label> 
                                    <div class="col-8">
                                        <input id="name" name="name" placeholder="Ejemplo: Juan Pech Puc" class="form-control here" type="text">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="cargo" class="col-4 col-form-label">Cargo</label> 
                                    <div class="col-8">
                                        <input id="cargo" name="cargo" placeholder="Control Escolar" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="matricula" class="col-4 col-form-label">Matricula</label> 
                                    <div class="col-8">
                                        <input id="matricula" name="matricula" placeholder="Ejemplo: Juan2018" class="form-control here" required="required" type="text">
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-4 col-form-label">Nueva Contraseña</label> 
                                        <div class="col-8">
                                            <input id="newpass" name="password" placeholder="Escribe tu Contraseña (8 digitos)" class="form-control here" type="text">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary">Aceptar</button>
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
        <?php getFooter(); ?>
    </body>
</html>
