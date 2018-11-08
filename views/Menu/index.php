<?php
require_once '../../lib/links.php';
libnivel3();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Menu Cobay</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"table width="100%" height="100%" border="1" cellspacing="0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?php estilosMenu(); ?>
    </head>
    <body style="background-color:#66CDAA;">
        <?php
        getHeader();
        ?>
        <div>
            <center>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background: #808080">

                                <div class="panel-heading">ALUMNOS</div>
                                <div class="panel-body">
                                    <a href="../alumnos/">   <img src="https://image.flaticon.com/icons/svg/562/562135.svg" class="img-responsive " style="width:100%" alt="Image"></a>
                                </div>
                                <div class="panel-footer" style="background: #808080"><h5 style="color: #808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>


                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background:#808080 ">
                                <div class="panel-heading">DOCENTES</div>
                                <div class="panel-body">
                                    <a href="../docentes/"><img src="https://image.flaticon.com/icons/svg/562/562129.svg" class="img-responsive" style="width:100%" alt="Image"></a></div>
                                <div class="panel-footer" style="background:#808080"><h5 style="color:#808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>



                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background:#808080">
                                <div class="panel-heading">ASIGNATURAS</div>
                                <a href="../asignaturas/"style="color:#FFFFFF">  <div class="panel-body"><img src="https://image.flaticon.com/icons/svg/906/906343.svg" class="img-responsive" style="width:100%" alt="Image"></div>
                                    <div class="panel-footer" style="background:#808080"><h5 style="color:#808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>


                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background:#808080">
                                <div class="panel-heading">GRUPOS</div>
                                <a href="../grupos/"style="color:#FFFFFF">  <div class="panel-body"><img src="https://image.flaticon.com/icons/svg/562/562142.svg" class="img-responsive" style="width:100%" alt="Image"></div>
                                    <div class="panel-footer" style="background:#808080"><h5 style="color:#808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>



                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background:#808080">
                                <div class="panel-heading">PERIODO</div>
                                <a href="../periodos/" style="color:#FFFFFF">  <div class="panel-body"><img src="https://image.flaticon.com/icons/svg/305/305139.svg" class="img-responsive" style="width:100%" alt="Image"></div>
                                    <div class="panel-footer" style="background:#808080"><h5 style="color:#808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>



                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary btn-lg" style="background:#808080">
                                <div class="panel-heading">PLAN</div>
                                <a href="../planes/">  <div class="panel-body"><img src="https://image.flaticon.com/icons/svg/855/855579.svg" class="img-responsive" style="width:100%" alt="Image"></div>
                                    <div class="panel-footer" style="background:#808080"><h5 style="color:#808080">Buy 50 mobiles and g</h5></div>
                            </button>
                        </div>
                    </div>

                </div>
            </center>


        </div>

        <?php
        getFooter();
        ?>
    </body>

</html>