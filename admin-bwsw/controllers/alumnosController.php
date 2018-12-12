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
//Actualizar
elseif (isset($_POST['buttonUpdate'])) {
    require_once '../lib/links.php';
    libnivel2();
    $alumnos = new alumnosController();
    $alumnos->AlumnoProceso();
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
} elseif (isset($_POST['buttonDesactivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $Des = new alumnosController();
    $Des->desactivar();
} elseif (isset($_POST['buttonActivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $ac = new alumnosController();
    $ac->activar();
} else {
    return False;
}

class alumnosController {

    function index() {
        $objetoAlumno = new AlumnoAdmin();
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
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $objetoAlumno = new AlumnoAdmin();
        $Res = $objetoAlumno->validarMatricula($matricula);
            if ($Res != " " && $Res != $matricula) {
                $response = $objetoAlumno->create($matricula, $nombre);
                if ($response) {
                    $this->read();
                } else {
                    echo "-1";
                }
            } else {
                echo "-2";
            }
    }

    function read() {
        $objetoAlumno = new AlumnoAdmin();
        $response = $objetoAlumno->read();
        $result = array();
        if (!$response) {
            //$link->error;
            echo "a" . $response;
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
        $objetoAlumno = new AlumnoAdmin();
        $response = $objetoAlumno->Alumnodelete($matricula);
//3.  enviar una respuesta
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function desactivar() {
        $matricula = $_POST['input_matricula'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $objetoAviso = new AlumnoAdmin();
        $response = $objetoAviso->desactivar($matricula);
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
    }

    function activar() {
        $matricula = $_POST['input_matricula'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $objetoAviso = new AlumnoAdmin();
        $response = $objetoAviso->activar($matricula);
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
    }

    ///AQUIIIIIIIIIIIIII
    function AlumnoProceso() {

        ///1. recibir datos

        $AcualMatricula = $_POST['Matricula'];
        $nuevaMatricula = $_POST['imputMatriculaNueva'];
        $nuevoNombre = $_POST['inputNombreNuevo'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Alumnos.php';
        $ObjetoMatricula = new AlumnoAdmin();

        if ($AcualMatricula === $nuevaMatricula) {
            $response = $ObjetoMatricula->updateAlumno($AcualMatricula, $nuevaMatricula, $nuevoNombre);
            if ($response) {
                $this->read();
            } else {
                echo "-1";
            }
        } else {
            $Res = $ObjetoMatricula->validarMatricula($nuevaMatricula);
            if ($Res != " " && $Res != $nuevaMatricula) {
                $response = $ObjetoMatricula->updateAlumno($AcualMatricula, $nuevaMatricula, $nuevoNombre);
                if ($response) {
                    $this->read();
                } else {
                    echo "-1";
                }
            } else {
                echo "-2";
            }
        }
    }

}
