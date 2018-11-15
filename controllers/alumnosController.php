<?php

//require_once '../core/config.php';
/*
 * Program:     docentesController.php
 * Author:      MTI. Brayan Cetina
 * Description: Programa que permite recibir los datos del alumno, 
 * los analiza, configura y almacena en la Base de Datos.
 * 
 * Function: 
 * evalua el tipo de acción proveniente analizando la variable button.
 * y realiza el algoritmo especificado en la acción.
 */
///////Agregar alumno///////
if (isset($_POST['buttonCreate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $alumnos = new alumnosController();
    $alumnos->create();
}
///////Modificar Datos de alumno///////
elseif (isset($_POST['buttonUpdate'])) {
    alumnosUpdate();
}
///////Consultar tabla de alumno///////
elseif (isset($_POST['buttonRead'])) {
    $alumnos = new alumnosController();
    $alumnos->read();
}
///////Consultar tabla de alumno por Id///////
elseif (isset($_POST['buttonReadId'])) {
    alumnosReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    require_once '../lib/links.php';
    libnivel2();
    $alumnos = new alumnosController();
    $alumnos->delete();
} else {
    return False;
}

class alumnosController {

    function index() {
        $objetoAlumno = new Alumno();
        $response = $objetoAlumno->read();
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

    function create() {
///1. recibir datos
        $matricula = $_POST['inputMatricula'];
        $nombre = $_POST['inputNombre'];
        $status = "1";
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $objetoAlumno = new Alumno();
        $response = $objetoAlumno->create($matricula, $nombre, $status);
//3.  enviar una respuesta
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoAlumno = new Alumno();
        $response = $objetoAlumno->read();
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

    function delete() {
        $matricula = $_POST['inputMatricula'];
        //$status = $_POST['inputStatus'];
        //llamar lib
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $objetoAlumno = new Alumno();
        $response = $objetoAlumno->Alumnodelete($matricula);
//3.  enviar una respuesta
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

}
