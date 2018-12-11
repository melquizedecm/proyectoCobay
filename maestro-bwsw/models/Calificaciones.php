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
require_once '../lib/consultas.php';
require_once '../lib/mensajes.php';
require_once '../models/Periodos.php';


class Calificaciones {

    //put your code here

    function excelValido($data) {
        $objPeriodo = new Periodos();
        $id_plantel = $data[0];
        $periodo = $data[1];
        $plan = $data[2];
        //$id_semestre = $data[3];
        $matricula_maestro = $data[4];
        $grupo = $data[5];
        $id_asignatura = $data[6];
        $asignatura = $data[7];
        $matricula = $data[8];
        $nombre = $data[9];
        //echo $nombre;
        //$parcial_uno = $data[10];
        //$parcial_dos = $data[11];
        //$ordinario = $data[12];
        $error = [];
        //SECCION PARA CONFIGURAR DATOS

        //plantel
        $respuesta = getFilaSql("planteles", "id_plantel", $id_plantel);
        ($respuesta == true) ? '' : array_push($error, "1");
        //periodo
        $respuesta = getFilaSql("periodos", "periodo", $periodo);
        ($respuesta == true) ? '' : array_push($error, "2");
        //plan
        $respuesta = getFilaSql("planes", "plan", $plan);
        ($respuesta == true) ? '' : array_push($error, "3");
        //semestre
        //$respuesta = getFilaSql("grupos", "id_grupo", $grupo);
        //($respuesta == true) ? '' : array_push($error, "4");
        //matricula de maestro
        $respuesta = getFilaSql("maestros", "matricula_maestro", $matricula_maestro);
        ($respuesta == true) ? '' : array_push($error, "5");
        //grupo
        $respuesta = getFilaSql("grupos", "id_grupo", $grupo);
        ($respuesta == true) ? '' : array_push($error, "6");
        //matricula asignatura
        $respuesta = getFilaSql("asignaturas", "id_asignatura", $id_asignatura);
        ($respuesta == true) ? '' : array_push($error, "7");
        //nombre asignatura
        $respuesta = getFilaSql("asignaturas", "asignatura", $asignatura);
        ($respuesta == true) ? '' : array_push($error, "8");
        //matricula alumno
        $respuesta = getFilaSql("alumnos", "matricula", $matricula);
        ($respuesta == true) ? '' : array_push($error, "9");
        //nombre alumno
        $respuesta = "SELECT * FROM alumnos WHERE nombre='".$nombre."'";
        $res1 = getFila($respuesta);
        
        //echo $res1['nombre'];
        ($res1['nombre'] == $nombre) ? '' : array_push($error, "10");
         $periodoValido = $objPeriodo->esActivo($periodo);
        ($periodoValido==true)? '':array_push($error,"11");
        
        $banderaError = "";
        foreach ($error as $valor) {
            if ($valor != "") {
                $banderaError = $valor;
            }
        }
        return $banderaError;
    }
   

}

