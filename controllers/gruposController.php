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
    $grupos=new GruposController();
    $grupos->create();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    grupoUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    $grupos=new GruposController();
    $grupos->read();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    gruposReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    gruposDelete();
} else {
    return False;
}

class GruposController {
    function index() {
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->read();
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
        $id_grupo = $_POST['inputId_grupo'];
        $grupo = $_POST['inputGrupo'];
        
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->create($id_grupo, $grupo);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->read();
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
