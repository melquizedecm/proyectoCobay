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

    function create($matricula, $password, $cargo, $nombre) {
        $sql = "INSERT INTO administrativos(matricula,password,cargo,nombre) VALUES ('" . $matricula . "','" . $password . "','" . $cargo . "','" . $nombre . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("administrativos");
    }
    function update($matricula, $password, $cargo, $nombre,$usuarioact) {
        $sql = "UPDATE administrativos SET matricula=('" . $matricula . "'), password=('" . $password . "'), cargo=('" . $cargo . "'), nombre=('" . $nombre . "') WHERE matricula=('" .$usuarioact. "')";


        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

 function delete($matricula){
        $sql = "DELETE FROM administrativos WHERE matricula='".$matricula."'";
        
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
}
