<?php

//require_once '../core/config.php';
/*
 * Program:     docentesController.php
 * Author:      MTI. Melquizedec Moo Medina
 * Description: Programa que permite recibir los datos del docente, 
 * los analiza, configura y almacena en la Base de Datos.
 * 
 * Function: 
 * evalua el tipo de acción proveniente analizando la variable button.
 * y realiza el algoritmo especificado en la acción.
 */
///////Agregar Docente///////
if (isset($_POST['buttonCreate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $docentes = new DocentesController();
    $docentes->create();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $docentes = new DocentesController();
    $docentes->docenteUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    $docentes = new DocentesController();
    $docentes->read();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    docenteReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    require_once '../lib/links.php';
    libnivel2();
    $docentes = new DocentesController();
    $docentes->delete();
} else {
    return False;
}

class DocentesController {

    function index() {
        $objetoDocente = new Docentes();
        $response = $objetoDocente->read();
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
        require_once '../models/Docentes.php';
        $objetoDocente = new Docentes();
        $response = $objetoDocente->create($matricula, $nombre, $status);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoDocente = new Docentes();
        $response = $objetoDocente->read();
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

    function docenteUpdate() {
        ///1. recibir datos
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $status = "1";
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Docentes.php';
        $objetoDocente = new Docentes();
        $response = $objetoDocente->update("matricula_maestro", $matricula, $nombre, $status);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    // nuevo codigo
    function delete() {
        ///1. recibir datos
        $matricula_maestro = $_POST['matricula_maestro'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Docentes.php';
        $objetoDocentes = new Docentes();
        $response = $objetoDocentes->delete($matricula_maestro);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
    }

}
