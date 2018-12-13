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

    function read() {
        $sql = "SELECT id_periodo,periodo, periodo_status.status_periodo FROM periodos INNER JOIN periodo_status ON periodos.id_status_periodo = periodo_status.id_status_periodo";
        return getResultSQL($sql);
    }

    function periodoactivo() {
        $sql = "UPDATE periodos SET id_status_periodo='0' WHERE id_status_periodo='1'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function desactivar($id_grupo) {
        $sql = "UPDATE  periodos SET id_status_periodo='0' WHERE id_periodo='".$id_grupo."' ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function activar($id_grupo) {
        $sql = "UPDATE periodos SET id_status_periodo='1' WHERE id_periodo='".$id_grupo."'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function actualizar($id, $periodo) {
        $sql = "UPDATE periodos SET periodo='" . $periodo . "' WHERE id_periodo='" . $id . "'";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function validar($periodo) {
        $sql = "SELECT periodo FROM periodos WHERE periodo='" . $periodo . "'";
        $response = getResultSQL($sql);
        if ($response->num_rows >0) 
        {
            return true;
        } else {
            return false;
        }
    }

    function esActivo($periodo) {
        $sql = "SELECT periodos.periodo FROM periodos WHERE periodos.periodo='" . $periodo . "' AND periodos.id_status_periodo='1'";
        $response = getResultSQL($sql);
        if ($response->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
