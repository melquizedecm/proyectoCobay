<?php

/////////////verificar si esta autorizado para ver un modulo/////////////////
/*
 * 1. OBTENER EL TIPO DE USUARIO
 * 2. OBTENER EL NOMBRE DEL MODULO ACTUAL Y COMPARARLO CON LOS AUTORIZADOS PARA EL USUARIO
 * 3. SI COINCIDEN ACCEDER, SINO MANDAR A INDEX
 */
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../login/");
}
?>