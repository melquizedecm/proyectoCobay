<?php

//Author: Ángel García

class Periodos 
{
    function create($id, $periodo, $status) 
    {
        $sql = "INSERT INTO periodos(id_periodo,periodo,id_status_periodo) VALUES ('" . $id . "','$periodo" . "','" . $status . "')";
        $response = getResultSQL($sql);
        if (!$response) 
        {
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function read() 
    {
        return getTabla("periodos");
    }

}

