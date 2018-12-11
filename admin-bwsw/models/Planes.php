<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Planes {

    function create($id_plan, $plan) {
        $sql2 = "INSERT INTO planes(id_plan,plan,id_status_plan) VALUES ('" .NULL. "','" . $plan . "','.1.')";
        $response2 = getResultSQL($sql2);
        if (!$response2) {
            return false;
        } else {
            return true;
        }
    }

    function update($temp, $nuevoplan) {
        $sql = "UPDATE planes SET plan= ('" . $nuevoplan . "') WHERE plan=( '" . $temp . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        $sql = "SELECT id_plan,plan, plan_status.status_plan FROM planes INNER JOIN plan_status ON planes.id_status_plan = plan_status.id_status_plan";

        return getResultSQL($sql);
    }

    function delete($id_plan) {
        /* $sql = "DELETE grupos(id_grupo,grupo) VALUES ('" . $id_grupo ."')"; DELETE FROM grupos WHERE grupos.id_grupo=19 /*agregar lo de values */
        $sql = "DELETE  FROM planes WHERE planes.id_plan = ( " . $id_plan . " )";

        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function desactivar($id_plan) {
        $sql = "UPDATE  planes SET id_status_plan= (" . 0 . ") WHERE id_plan=( '" . $id_plan . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function activar($id_plan) {
        $sql = "UPDATE  planes SET id_status_plan= (" . 1 . ") WHERE id_plan=( '" . $id_plan . "' ) ";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }
    function validarIdPlan($plan) {
        $result = getFilaSql("planes", "plan", $plan);
        $valor=$result['plan'];
        return $valor;
      
    }

}
