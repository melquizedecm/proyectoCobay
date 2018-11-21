<?php
/////////////verificar si esta autorizado para ver un modulo/////////////////
/*
 * 1. OBTENER EL TIPO DE USUARIO
 * 2. OBTENER EL NOMBRE DEL MODULO ACTUAL Y COMPARARLO CON LOS AUTORIZADOS PARA EL USUARIO
 * 3. SI COINCIDEN ACCEDER, SINO MANDAR A INDEX
 */
session_start();
require_once("consultas.php");
if(!isset($_SESSION['session_username'])) {
    header("location: ../Login/");
}

?>