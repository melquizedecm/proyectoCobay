<?php
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
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTablaWhereNot("maestros","id_status_maestro","0");
    }
    function update($campoClave,$valorClave, $nombre, $status){
         $sql = "UPDATE  maestros SET nombre='".$nombre."',id_status_maestro='".$status."' WHERE ".$campoClave."='" . $valorClave. "'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
    // nuevo codigo 
    function delete($matricula_maestro){
         //$sql = "DELETE maestros(matricula_maestro,nombre) VALUES ('" . $matricula_maestro ."')"; DELETE FROM maestros WHERE maestros.matricula_maestro=19  //agregar lo de values/
        
        $response = sqlUpdate("maestros", "id_status_maestro", "0", "matricula_maestro", $matricula_maestro);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
}
