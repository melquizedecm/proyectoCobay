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
//require_once '../lib/links.php';}

if (isset($_POST['buttonLogin'])) {
  /* require_once  '../lib/links.php';//'../lib/links.php';
   libnivel3();*/
    
    $consulta =new consultarcalificacionController();
    $consulta->inicioSesion();
}

class consultarcalificacionController {
    //Variable global
   
    //1.-
    function inicioSesion() {
      
        $matricula = $_POST['inputMatricula'];
        //2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Consulta.php';
        $objetoConsulta = new Consulta();
        $response = $objetoConsulta->validarSesion($matricula);
        //$response=$objetoDocente->create($matricula,$nombre,$status);
        //3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }
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
}
