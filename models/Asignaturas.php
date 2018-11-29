<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Asignaturas {
    

    function create($clave, $nombre,$status) {
        $sql = "INSERT INTO asignaturas(id_asignatura,asignatura,id_status_asignatura) VALUES ('" . $clave . "','" . $nombre . "','.1.')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        $sql = "SELECT id_asignatura,asignatura,status_asignatura.status FROM asignaturas INNER JOIN status_asignatura ON asignaturas.id_status_asignatura = status_asignatura.id_status_asignatura";
        return getResultSQL($sql);
    }
    function update($campoClave,$valorClave, $nombre){
         $sql = "UPDATE  asignaturas SET asignatura='".$nombre."' WHERE ".$campoClave."='" . $valorClave. "'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
    function desactivar($clave){
          /*$sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values*/
        /*$sql="DELETE  FROM grupos WHERE grupos.id_grupo = ( ".$id_grupo." )";*/
        /*ATE `grupos` SET `id_status_grupo`=0 WHERE id_grupo=1*/
         $sql = "UPDATE  asignaturas SET id_status_asignatura= (" . 0 . ") WHERE id_asignatura=( '".$clave."' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
        
        
        
    }
    
     function activar($clave){
          /*$sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values*/
        /*$sql="DELETE  FROM grupos WHERE grupos.id_grupo = ( ".$id_grupo." )";*/
        /*ATE `grupos` SET `id_status_grupo`=0 WHERE id_grupo=1*/
         $sql = "UPDATE  asignaturas SET id_status_asignatura= (" . 1 . ") WHERE id_asignatura=( '".$clave."' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
        
        
        
    }

}