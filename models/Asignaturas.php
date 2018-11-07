<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Asignaturas {
    

    function create($clave, $nombre) {
        $sql = "INSERT INTO asignaturas(id_asignatura,asignatura) VALUES ('" . $clave . "','" . $nombre . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("asignaturas");
    }

}