<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grupos
 *
 * Autor= Christian Eduardo Garci Chan
 */
class Grupos {

    function create($id_grupo, $status) {
        //falta comprobar si ya existe, el codigo siguiente se supone lo hace pero me esta creando un conflicto $respose al decir que es diferente a $grupo
      
        /* comprobar si existe, si no existe ingresarlo, una vez ingresado insertar todo a latabla principal */

        /* if ($response===($grupo)) { */
        $sql2 = "INSERT INTO grupos(id_grupo,id_status_grupo) VALUES ('" . $id_grupo . "','.1.')"; /* agregar lo de values */
        $response2 = getResultSQL($sql2);

        if (!$response2) {
            return false;
        } else {

            return true;
        }
        /* } else {
          return true;
          } */

        //agregar por si las dudas
    }

    function update($temp, $id_grupo) {
        $sql = "UPDATE  grupos SET id_grupo= ('" . $id_grupo . "') WHERE id_grupo=( '" . $temp . "' ) ";

        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        $sql = "SELECT id_grupo,status_grupo.status FROM grupos INNER JOIN status_grupo ON grupos.id_status_grupo = status_grupo.id_status_grupo";

        return getResultSQL($sql);
    }

    function delete($id_grupo) {
        /* $sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values */
        $sql = "DELETE  FROM grupos WHERE grupos.id_grupo = ( " . $id_grupo . " )";




        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function desactivar($id_grupo) {
        /* $sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values */
        /* $sql="DELETE  FROM grupos WHERE grupos.id_grupo = ( ".$id_grupo." )"; */
        /* ATE `grupos` SET `id_status_grupo`=0 WHERE id_grupo=1 */
        $sql = "UPDATE  grupos SET id_status_grupo= (" . 0 . ") WHERE id_grupo=( '" . $id_grupo . "' ) ";

        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function activar($id_grupo) {
        /* $sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values */
        /* $sql="DELETE  FROM grupos WHERE grupos.id_grupo = ( ".$id_grupo." )"; */
        /* ATE `grupos` SET `id_status_grupo`=0 WHERE id_grupo=1 */
        $sql = "UPDATE  grupos SET id_status_grupo= (" . 1 . ") WHERE id_grupo=( '" . $id_grupo . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function validarIdGrupo($id_grupo) {
        $result = getFilaSql("grupos", "id_grupo", $id_grupo);
        $valor=$result['id_grupo'];
        return $valor;
      
    }

}
