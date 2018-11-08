<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumno
 *
 * @author Brayan
 */
class Alumno {
    

    function create($matricula, $nombre, $status) {
        $sql = "INSERT INTO alumnos(matricula,nombre,id_status) VALUES ('" . $matricula . "','$nombre" . "','" . $status . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("alumnos");
    }

}