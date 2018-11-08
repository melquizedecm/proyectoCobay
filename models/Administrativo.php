<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docentes
 *
 * @author 
 */
class Administrativo {
    

    function create($matricula, $password, $tipo) {
        $sql = "INSERT INTO usuarios_maestros(matricula,password,id_tipo) VALUES ('" . $matricula . "','".$password . "','" . $tipo . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("usuarios_maestros");
    }

}