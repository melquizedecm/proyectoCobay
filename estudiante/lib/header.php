<?php
    function getHeaderAlumno() {
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
                        
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="../login/logout.php"><span class="glyphicon glyphicon-user"></span> Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <?php
    }
