<?php

/* 
 * Author: José Luis Rivera
 * Program: consultarcalificacionController
 * Description:
 * Aqui se crearan las funciones que se necesitaran para mostrarle al alumno
 *  1.- Sus datos personales
 *  2.- Sus materias
 *  3.- Su calificacion respecto a la matera
 *  4.- Su semestre y grupo
 */
//require_once '../lib/links.php';


class consultarcalificacionController {
    //Variable global
   

        function ObtenerNombre($matricula) {
        $objeto = new Consulta();
        $response = $objeto->read($matricula);
        $result = array();
        if (!$response) {
            $link->error;
        } else {
            $i = 0;
            while ($row = $response->fetch_assoc()) {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
    
    function obtenerSemestre($matricula){
        $objeto = new Consulta();
        $response = $objeto->leerSemestre($matricula);
        $result = array();
        if (!$response) {
            $link->error;
        } else {
            $i = 0;
            while ($row = $response->fetch_assoc()) {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
    function obtenerGrupo($matricula){
        $objeto = new Consulta();
        $response = $objeto->leerGrupo($matricula);
        $result = array();
        if (!$response) {
            $link->error;
        } else {
            $i = 0;
            while ($row = $response->fetch_assoc()) {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
    function llenarTabla($matricula)
    {
        $objeto = new Consulta();
        $response = $objeto->llenarTabla($matricula);
        $result = array();
        if (!$response) {
            $link->error;
        } else {
            $i = 0;
            while ($row = $response->fetch_assoc()) {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
    
   function obtenerEstatus($matricula) {
        $objeto = new Consulta();
        $response = $objeto->obtenerEstatus($matricula);
        $result = array();
        if ($response->num_rows > 0) {
            $i = 0;
            while ($row = $response->fetch_assoc()) {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        } else {
            return FALSE;
        }
    }

}
