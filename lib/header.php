<?php
    function getHeader() {
        ?>
        <meta charset="UTF-16">
        <header>
            <div>
                <div class="container text-center">
                    <div>
                        <img src="../../img/cobay.png" style="left:20px;bottom:550px;position:absolute" width="150" height="100"/>
                    </div>
                    <center><h2>COBAY</h2></center>
                    <p>Colegio De Bachilleres Del Estado De Yucatán</p>
                </div>
            </div>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Accesos</a></li>
                            <li><a href="#">Configuraciones</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <?php
    }


?>