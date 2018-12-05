<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plantel
 *
 * @author Jacob Luna
 */
class Plantel {
    //put your code here
    function comprovarPlantel($plantel){
        $respuesta=getFilaSql("planteles", "plantel", $plantel);
        if($respuesta){
            return true;
        }else{
            return false;
        }
    }
}
