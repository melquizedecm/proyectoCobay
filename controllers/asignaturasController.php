<?php
//require_once '../core/config.php';
/*
 * Program:     asignaturasController.php
 * Author:      Aaron Pech
 * Description: Programa que permite recibir los datos de las asignaturas, 
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
    $asignaturas=new AsignaturasController();
    $asignaturas->create();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    require_once '../lib/links.php';
    libnivel2();
     $asignaturas=new AsignaturasController();
      $asignaturas->asignaturaUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    $asignaturas=new AsignaturasController();
    $asignaturas->read();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    asignaturasReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    asignaturasDelete();
}
elseif (isset($_POST['buttonDesactivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $asignaturas=new AsignaturasController();
    $asignaturas->desactivar();
    
    
}
elseif (isset($_POST['buttonActivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $asignaturas=new AsignaturasController();
    $asignaturas->activar();
    
    
}else {
    return False;
}

class AsignaturasController {
    function index() {
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->read();
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
        $clave = $_POST['inputClave'];
        $nombre = $_POST['inputNombre'];
        $status=$_POST['inputStatus'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Asignaturas.php';
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->create($clave, $nombre,$status);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
    }

    function read() {
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->read();
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
    function asignaturaUpdate(){
     ///1. recibir datos
        $temp = $_POST['claveactual'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre'];
        
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Asignaturas.php';
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->update($temp,$clave, $nombre);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }   
        
    }
    function desactivar(){
        $clave = $_POST['inputClave']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Asignaturas.php';
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->desactivar($clave);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
    function activar(){
        $clave = $_POST['inputClave']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Asignaturas.php';
        $objetoAsignaturas = new Asignaturas();
        $response = $objetoAsignaturas->activar($clave);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
    /*function gruposUpdate(){
     ///1. recibir datos
          
       
        $temp = $_POST['inputId_grupoactual'];
        $id_grupo = $_POST['inputId_gruponuevo'];
       
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();

        $Res = $objetoGrupo->validarIdGrupo($id_grupo);

        if ($Res != $id_grupo && $Res != " ") {
            $c=0;
            $c++;
            if($c>1){
            $response = $objetoGrupo->update($temp, $id_grupo);
            
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
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
    */

}