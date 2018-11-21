<?php

//Author: Ángel García

class Periodos {

    function create($id, $periodo, $status) {
        $sql = "INSERT INTO periodos(id_periodo,periodo,id_status_periodo) VALUES ('" . $id . "','$periodo" . "','" . $status . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() 
    {
        $sql = "SELECT id_periodo,periodo, periodo_status.status_periodo FROM periodos INNER JOIN periodo_status ON periodos.id_status_periodo = periodo_status.id_status_periodo";
        return getResultSQL($sql);
    }
    
    function delete()
    {
        
    }
}
