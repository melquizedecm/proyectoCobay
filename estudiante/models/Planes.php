<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Planes {
    

    function create($id_plan, $plan, $estatus) {
        $sql = "INSERT INTO planes(id_plan,plan,id_status_plan) VALUES ('" . $id_plan . "','$plan" . "','" . $estatus . "')";
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
}

