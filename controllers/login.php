<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$matricula=$_POST['inputMatricula'];
$password=$_POST['inputPassword'];


session_start();
$_SESSION['username']=$matricula;