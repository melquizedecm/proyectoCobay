<?php
    function getHeader() {
        ?>
<body style="background-color:#66CDAA;">
        <meta charset="UTF-16">
        <header>
            <div>
                <div class="container text-center">
                    <div>
                        <center><img src="../../img/cobay.png" style="right:89px;bottom:650px;float: left;" width="150" height="100"/>
                    </div>
                    <h2>COBAY</h2></center>
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
                            <li class="active"><a href="../Menu/">Home</a></li>
                            <li><a href="../perfil/">Perfil</a></li>
                            <li><a href="../calificaciones/">Subir Calificaciones</a></li>
                            <li><a href="../administrativos/">Usuarios</a></li>
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
