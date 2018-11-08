<?php

/* 
 * Author: José Luis Rivera
 * Program: consultarcalificacionController
 * Description: Aqui se crearann todas las consultas para el alumno
 */

class Consulta{
    
    function validarSesion($matricula){
        //validar que la matricula del alumno el alumno exista 
        $sql = "SELECT nombre FROM `alumnos` WHERE id ='" . $matricula . "'";
        $response = getResultSQL($sql);
        if (!$response) { //si el alumno no existe
            return false;
        } else {
            return response;
        }
    }
    function read($matricula){
       // getTabla("alumnos");
        $sql ="SELECT nombre FROM `alumnos` WHERE matricula = '".$matricula."'";
        $response = getResultSQL($sql);
        return $response;
    }
    function leerSemestre($matricula){
        /*
SELECT semestres.id_semestre FROM semestres,excel,alumnos WHERE alumnos.matricula='17B003000037' AND alumnos.matricula=excel.matricula AND excel.id_semestre=semestres.id_semestre
         *          */
        $sql ="SELECT semestres.id_semestre FROM semestres,excel,alumnos"
              . " WHERE alumnos.matricula='".$matricula."' AND alumnos.matricula=excel.matricula "
                . "AND excel.id_semestre=semestres.id_semestre";
        $response = getResultSQL($sql);
        return $response;
    }
    function leerGrupo($matricula){
        /*
SELECT grupos.grupo FROM grupos,excel,alumnos WHERE alumnos.matricula='17B003000004' AND alumnos.matricula=excel.matricula AND grupos.id_grupo=excel.id_grupo         */
    $sql ="SELECT grupos.grupo FROM grupos,excel,alumnos WHERE alumnos.matricula='".$matricula."' AND alumnos.matricula=excel.matricula AND grupos.id_grupo=excel.id_grupo";
        $response = getResultSQL($sql);
        return $response;
        
    }
}
