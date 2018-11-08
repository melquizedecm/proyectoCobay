<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Planes {
    

    function create($id_plan, $plan) {
        $sql = "INSERT INTO planes(id_plan,plan) VALUES ('" . NULL . "','$plan" . "')";
        $response = getResultSQL($sql);
        if (!$response) {
            return false;
        } else {
            return true;
        }
    }

    function read() {
        return getTabla("planes");
    }

}

