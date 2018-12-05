<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumno
 *
 * @author Brayan Cetina
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

    function Alumnodelete($matricula) {
        $sql = "UPDATE alumnos SET id_status = (" . 0 . ") WHERE matricula = '" . $matricula . "'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        $sql = "SELECT matricula, nombre, alumno_status.status, avisos.aviso FROM alumnos INNER JOIN alumno_status ON alumnos.id_status=alumno_status.id_status INNER JOIN avisos ON alumnos.id_avisos = avisos.id_avisos";
        return getResultSQL($sql);
    }

    function desactivar($matricula) {
        $sql = "UPDATE  alumnos SET id_avisos= (" . 1 . ") WHERE matricula=( '" . $matricula . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
    
     function activar($matricula){
        $sql = "UPDATE  alumnos SET id_avisos= (" . 0 . ") WHERE matricula=( '" . $matricula . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
        
        
        
    }

}
