<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

///////Agregar Docente///////
if (isset($_POST['buttonCreate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $planes=new PlanesController();
    $planes->create();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    planesUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    $planes=new PlanesController();
    $planes->read();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    planesReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    planesDelete();
} else {
    return False;
}

class PlanesController {
    function index() {
        $objetoPlan = new Planes();
        $response = $objetoPlan->read();
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
        $id_plan = $_POST['inputID_Plan'];
        $plan = $_POST['inputPlan'];
        $estatus = $_POST['inputEstatus'];;
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlanes= new Planes();
        $response = $objetoPlanes->create($id_plan, $plan, $estatus);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoPlanes = new Planes();
        $response = $objetoPlanes->read();
        $result = array();
        if (!$response) {
            echo $response;
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

