<?php
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
    docenteCreate();
}
///////Modificar Datos de Docente///////
elseif (isset($_POST['buttonUpdate'])) {
    docenteUpdate();
}
///////Consultar tabla de Docente///////
elseif (isset($_POST['buttonRead'])) {
    docenteRead();
}
///////Consultar tabla de Docente por Id///////
elseif (isset($_POST['buttonReadId'])) {
    docenteReadId();
}
///////Eliminar Datos de Docente///////
elseif (isset($_POST['buttonDelete'])) {
    docenteDelete();
} else {
    echo "False";
}

function docenteCreate() {
    ///1. recibir datos
    $matricula = $_POST['inputMatricula'];
    $nombre = $_POST['inputNombre'];
    $status = "1";

    //2. guardar datos en el modelo
    $objetoDocente = new Docentes();
    $response = $objetoDocente->create($matricula, $nombre, $status);
    //$response=$objetoDocente->create($matricula,$nombre,$status);
    //3.  enviar una respuestaç
    if ($response) {
        docenteRead();
    } else {
        echo "-1";
    }
}

function docenteRead() {
    $sql = "SELECT * FROM maestros";
    $link = conectar();
    $response = $link->query($sql);
    $result = array();
    if (!$response) {
        echo $link->error;
    } else {
        $i=0;
        while ($row = $response->fetch_assoc()) {
            $result[$i]=$row;
            $i++;
        }
        return json_encode($result);
    }    
}
