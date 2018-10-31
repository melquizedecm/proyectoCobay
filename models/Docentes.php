<?php

require_once '../core/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docentes
 *
 * @author melqui
 */
class Docentes {

    function create($matricula, $nombre, $status) {
        $sql = "INSERT INTO maestros(matricula_maestro,nombre,id_status_maestro) VALUES ('" . $matricula . "','$nombre" . "','" . $status . "')";
        $link = conectar();
        $response= $link->query($sql);        
        if (!$response){
            return false;
        }
        else{
            return true;
        }
    }

}
