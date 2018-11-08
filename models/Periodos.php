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
        return getDataId("periodos","periodo_status");
    }
    
    function getDataId($table,$table2)
{
    $link = conectar();
    $consulta="SELECT ".$table.".id_periodo,".$table.".periodo,".$table2."status_periodo FROM ".$table.",".$table2." WHERE ".$table.".id_status_periodo=".$table2.".id_status_periodo";
    return $link->query($consulta);
}

}

