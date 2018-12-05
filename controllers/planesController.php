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
    require_once '../lib/links.php';
    libnivel2();
     $planes=new PlanesController();
      $planes->planesUpdate();
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
      require_once '../lib/links.php';
    libnivel2();
    $planes=new PlanesController();
    $planes->delete();
    
    
}
elseif (isset($_POST['buttonDesactivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $planes=new PlanesController();
    $planes->desactivar();
    
    
}
elseif (isset($_POST['buttonActivar'])) {
    require_once '../lib/links.php';
    libnivel2();
    $planes=new PlanesController();
    $planes->activar();
    
  
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
        
        $id_plan = $_POST['inputId_plan'];
        $plan = $_POST['inputPlan'];
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlanes= new Planes();
        $response = $objetoPlanes->create($id_plan, $plan);
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
        $plan = $_POST['Id_plan'];
       
        
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlan = new Planes();
        $response = $objetoPlan->delete($id_plan);
//$response=$objetoDocente->create($matricula,$nombre,$status);
//3.  enviar una respuestaç
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
    }
    function desactivar(){
        $id_plan = $_POST['inputId_plan']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlan = new Planes();
        $response = $objetoPlan->desactivar($id_plan);
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
    function activar(){
        $id_plan = $_POST['inputId_plan']; 
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlan = new Planes();
        $response = $objetoPlan->activar($id_plan);
        if ($response) {
            $this->read();
        } else {
            echo "-1";
        };
        
        
    }
      function planesUpdate(){
     ///1. recibir datos
          
       
        $temp = $_POST['inputId_planactual'];
        $id_plan = $_POST['inputId_plannuevo'];
       
//2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Planes.php';
        $objetoPlan = new Planes();
        
        $Res = $objetoGrupo->validarIdGrupo($id_grupo);
        if ($Res != $id_grupo && $Res != " ") {
        $response = $objetoPlan->update($temp,$id_plan);
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

