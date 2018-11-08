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
    $administrativo=new AdministrativoController();
    $administrativo->create();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    administrativoUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    $administrativo=new AdministrativoController();
    $administrativo->read();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    administrativoReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    administrativoDelete();
} else {
    return False;
}

class administrativoController {
    function index() {
        $objetoAdministrativo = new Administrativo();
        $response = $objetoAdministrativo->read();
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
        $password = $_POST['inputPassword'];
        $cargo = $_POST['inputCargo'];
        $nombre = $_POST['inputNombre'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Administrativo.php';
        $objetoAdministrativo = new Administrativo();
        $response = $objetoAdministrativo->create($matricula, $password, $cargo, $nombre);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoAdministrativo = new Administrativo();
        $response = $objetoAdministrativo->read();
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
