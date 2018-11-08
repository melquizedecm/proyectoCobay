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
class Grupos {
    

    function create($id_grupo, $grupo) {
        $sql = "INSERT INTO grupos(id_grupo,grupo) VALUES ('" . NULL . "','$grupo" .  "')"; /*agregar lo de values*/
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("grupos");
    }

}


