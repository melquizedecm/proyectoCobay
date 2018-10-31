<?php

require_once '../models/Docentes.php';

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
        visualizar();
    } else {
        echo "-1";
    }
}

function visualizar() {
    $sql = "SELECT * FROM maestros";
    $result = array();
    $link = conectar();
    $response = $link->query($sql);
    if (!$response) {
        return $link->error;
    } else {
        while ($row = $response->fetch_assoc()) {
            array_push($result, $row);
        }
        echo json_encode($result);
    }
}
