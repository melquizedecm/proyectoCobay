<?php

/* 
 * Author: José Luis Rivera
 * Program: consultarcalificacionController
 * Description: Aqui se crearann todas las consultas para el alumno
 */

class Consulta{
    
    function validarSesion($matricula) {
        //validar que la matricula del alumno el alumno exista 
        $sql = "SELECT nombre FROM `alumnos` WHERE id ='" . $matricula . "'";
        $response = getResultSQL($sql);
        if (!$response) { //si el alumno no existe
            return false;
        } else {
            return response;
        }
    }

    function read($matricula) {

        $sql = "SELECT nombre FROM `alumnos` WHERE matricula = '" . $matricula . "'";
        $response = getResultSQL($sql);
        return $response;
    }

    function leerSemestre($matricula) {
        $sql = "SELECT semestres.id_semestre FROM semestres,excel,alumnos"
                . " WHERE alumnos.matricula='" . $matricula . "' AND alumnos.matricula=excel.matricula "
                . "AND excel.id_semestre=semestres.id_semestre";
        $response = getResultSQL($sql);
        return $response;
    }

    function leerGrupo($matricula) {
        $sql = "SELECT grupos.id_grupo FROM grupos,excel,alumnos WHERE alumnos.matricula='" . $matricula . "' AND alumnos.matricula=excel.matricula AND grupos.id_grupo=excel.id_grupo";
        $response = getResultSQL($sql);
        return $response;
    }

    function llenarTabla($matricula) {
        /**
          SELECT asignaturas.asignatura, calificaciones.parcial_uno,calificaciones.parcial_dos,calificaciones.ordinario FROM asignaturas,calificaciones,excel_asignatura,excel,alumnos WHERE alumnos.matricula='17B003000004' and alumnos.matricula=excel.matricula and excel_asignatura.id_excel=excel.id_excel

         * asignaturas.id_asignatura= excel_asignatura.id_asignatura and calificaciones.id_calificaciones=excel_asignatura.id_calificaciones
         *  */
        $sql = "SELECT asignaturas.asignatura, calificaciones.parcial_uno,calificaciones.parcial_dos,calificaciones.ordinario "
                . "FROM asignaturas,calificaciones,excel_asignatura,excel,alumnos "
                . "WHERE alumnos.matricula='" . $matricula . "' and alumnos.matricula=excel.matricula "
                . "and excel.id_excel=excel_asignatura.id_excel "
                . "and excel_asignatura.id_calificaciones=calificaciones.id_calificaciones and excel_asignatura.id_asignatura=asignaturas.id_asignatura";
        $response = getResultSQL($sql);
        return $response;
    }

    function obtenerEstatus($matricula) {
        $sql = "SELECT `id_status`FROM `alumnos` WHERE matricula='" . $matricula . "'";
        $response = getResultSQL($sql);
        return $response;
    }

}
