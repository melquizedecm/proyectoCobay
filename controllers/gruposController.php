<?php
//require_once '../core/config.php';
/*
 * Program:     GruposController.php
 * Author:      Christian Eduardo Garcia Chan
 * Description: Programa que permite recibir los datos del grupo, 
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
    require_once '../lib/links.php';
    libnivel2();
     $grupos=new GruposController();
      $grupos->gruposUpdate();
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
    require_once '../lib/links.php';
    libnivel2();
    $grupos=new GruposController();
    $grupos->delete();
    
    
}
elseif (isset($_POST['buttonDesactivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $grupos=new GruposController();
    $grupos->desactivar();
    
    
}
elseif (isset($_POST['buttonActivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $grupos=new GruposController();
    $grupos->activar();
    
    
}
else {
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
        $status=$_POST['inputStatus'];
        
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();
        $Res=$objetoGrupo->validarIdGrupo($id_grupo);
        
        if($Res!=$id_grupo && $Res!=" "){
               $response = $objetoGrupo->create($id_grupo,$status);
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        }
            
        }
        else {
     echo "-2";
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
    function delete(){
    ///1. recibir datos
        $id_grupo = $_POST['Id_grupo'];
       
        
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->delete($id_grupo);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
    }
    function desactivar(){
        $id_grupo = $_POST['inputId_grupo']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->desactivar($id_grupo);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
    function activar(){
        $id_grupo = $_POST['inputId_grupo']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();
        $response = $objetoGrupo->activar($id_grupo);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
      function gruposUpdate(){
     ///1. recibir datos
          
       
        $temp = $_POST['inputId_grupoactual'];
        $id_grupo = $_POST['inputId_gruponuevo'];
       
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Grupos.php';
        $objetoGrupo = new Grupos();

        $Res = $objetoGrupo->validarIdGrupo($id_grupo);

        if ($Res != $id_grupo && $Res != " ") {
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
