<?php

// incializacion de rutas;
$ROOT_PATH = $_SERVER['DOCUMENT_ROOT'] . "/proyectoCobay/";
$CONTROLLER_PATH = $ROOT_PATH . 'controllers/';
$MODEL_PATH = $ROOT_PATH . 'models/';
$VIEW_PATH = $ROOT_PATH . 'views/';
$LIB_PATH = $ROOT_PATH . 'lib/';
$CONFIG_PATH = $ROOT_PATH . 'core/';

function libnivel0() {
    require_once '../lib/meta.php';
    require_once '../lib/header.php';
    require_once '../lib/menu.php';
    require_once '../lib/footer.php';
    require_once '../lib/mensajes.php';
}

function libnivel1() {
    require_once("lib/session.php");
    require_once("core/config.php");
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
    require_once("../../lib/session.php");
    require_once '../../lib/meta.php';
    require_once '../../lib/estilos.php';
    require_once '../../lib/header.php';
    require_once '../../lib/footer.php';
    require_once("../../core/config.php");
    require_once("../../lib/movhistory.php");
    require_once("../../lib/consultas.php");
    require_once '../../lib/mensajes.php';
}

function libreriasBasicas() {
    global $LIB_PATH;
    global $ROOT_PATH;
    global $CONFIG_PATH;
    require_once $CONFIG_PATH . "config.php";
    require_once $LIB_PATH . "consultas.php";
    require_once $LIB_PATH . "mensajes.php";
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
//    global $CONTROLLER_PATH;
//    global $MODEL_PATH;
//    require_once $CONTROLLER_PATH . "docentesController.php";
//    require_once $MODEL_PATH."Docentes.php";
//    libreriasBasicas(); 
}

function libreriasPeriodos() {
    require_once '../../controllers/periodoController.php';
    require_once '../../models/Periodos.php';
    libnivel3();
}
