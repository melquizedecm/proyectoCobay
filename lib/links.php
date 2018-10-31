<?php

function libnivel0() {
    require_once '../lib/meta.php';
    require_once '../lib/header.php';
    require_once '../lib/menu.php';
    require_once '../lib/footer.php';
    require_once '../lib/mensajes.php';
}

function libnivel1() {
    require_once("lib/session.php");
    require_once("lib/config.php");
    require_once("/lib/header.php");
    require_once("lib/movhistory.php");
    require_once("lib/consultas.php");
    require_once 'lib/mensajes.php';
}

function libnivel2() {

    require_once("../lib/session.php");
    require_once '../lib/meta.php';
    require_once '../lib/header.php';
    require_once '../lib/footer.php';
    require_once("../core/config.php");
    require_once("../lib/movhistory.php");
    require_once("../lib/ClassConsultas.php");
    require_once '../lib/mensajes.php';
}

function libnivel3() {

    //require_once("../../lib/session.php");
    require_once '../../lib/meta.php';
    require_once '../../lib/header.php';
    require_once '../../lib/footer.php';
    require_once("../../core/config.php");
    require_once("../../lib/movhistory.php");
    //require_once("../../lib/ClassConsultas.php");
    require_once '../../lib/mensajes.php';
}

function libnivel2Login() {
    require_once '../lib/meta.php';
    require_once '../lib/header.php';
    require_once '../lib/footer.php';
    require_once("../core/config.php");
    require_once("../lib/movhistory.php");
    require_once("../lib/consultas.php");
    require_once '../lib/mensajes.php';
}

function libreriasDocentes() {
    require_once '../../controllers/docentesController.php';
    require_once '../../models/Docentes.php';
    libnivel3();
}

function libreriasPeriodos() {
    require_once '../../controllers/periodoController.php';
    require_once '../../models/Periodos.php';
    libnivel3();
}
