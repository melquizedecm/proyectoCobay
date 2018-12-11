<?php
/*
 * Program:     periodosController.php
 * Author:      Miguel Ángel García Uc
 * Description: Programa que permite recibir los datos del periodo, 
 * los analiza, configura y almacena en la Base de Datos.
 * 
 * Function: 
 * evalua el tipo de acción proveniente analizando la variable button.
 * y realiza el algoritmo especificado en la acción.
 */
///////Agregar Periodo///////
if (isset($_POST['buttonCreate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->create();
}
///////Modificar Datos de Periodo///////
elseif (isset($_POST['buttonUpdate'])) {
    periodosUpdate();
}
///////Consultar tabla de Periodo///////
elseif (isset($_POST['buttonRead'])) {
    periodosRead();
}
///////Consultar tabla de Periodo por Id///////
elseif (isset($_POST['buttonReadId'])) {
    periodosReadId();
}
///////Eliminar Datos de Periodo///////
elseif (isset($_POST['buttonDelete'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->delete();
} elseif (isset($_POST['buttonDesactivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->desactivar();
} elseif (isset($_POST['buttonActivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->activar();
} elseif (isset($_POST['periodoActivo'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->periodoactivo();
} elseif (isset($_POST['buttonActualizar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->periodoactualizar();
} elseif (isset($_POST['buttonValidar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $periodos = new PeriodosController();
    $periodos->periodovalidar();
} else {
    return False;
}

class PeriodosController {

    function index() {
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->read();
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
        ///1. recibir datos MODIFICAR
        $id = $_POST['inputId'];
        $periodo = $_POST['inputPeriodo'];
        $status = "inputEstatus";
        //2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $response = NULL;
        $objetoPeriodos = new Periodos();
        if ($this->periodovalidar()) {
            $response = $objetoPeriodos->create($id, $periodo, $status);
        }
        //3.  enviar una respuesta
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->read();
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

    function delete() {
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->read();
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

    function desactivar() {
        $id_periodo = $_POST['inputId'];
        //2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodo = new Periodos();
        $response = $objetoPeriodo->desactivar($id_periodo);
        //3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function activar() {
        $id_periodo = $_POST['inputId'];
        //2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodo = new Periodos();
        $response = $objetoPeriodo->activar($id_periodo);
        //3.  enviar una respuestaç

        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function periodoactivo() {
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodo = new Periodos();
        $response = $objetoPeriodo->periodoactivo();

        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function periodoactualizar() {
        $id_periodo = $_POST['inputId'];
        $periodo = $_POST['inputPeriodo'];
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodo = new Periodos();
        $response = NULL;
        if ($this->periodovalidar()) {
            $response = $objetoPeriodo->actualizar($id_periodo, $periodo);
        }
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function periodovalidar() {
        $periodo = $_POST['inputPeriodo'];
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodo = new Periodos();
        $response = $objetoPeriodo->validar($periodo);
        if ($response) {
            return false;
        } else {
            return true;
        }
    }

}
