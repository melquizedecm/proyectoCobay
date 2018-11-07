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
if (isset($_POST['buttonCreate'])) 
{
    $periodos=new PeriodosController();
    $periodos->create();
}
///////Modificar Datos de Periodo///////
elseif (isset($_POST['buttonUpdate'])) 
{
    periodosUpdate();
}
///////Consultar tabla de Periodo///////
elseif (isset($_POST['buttonRead'])) 
{
    periodosRead();
}
///////Consultar tabla de Periodo por Id///////
elseif (isset($_POST['buttonReadId'])) 
{
    periodosReadId();
}
///////Eliminar Datos de Periodo///////
elseif (isset($_POST['buttonDelete'])) 
{
    periodosDelete();
} 
else 
{
    return False;
}

class PeriodosController 
{
    function index() 
    {
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->read();
        $result = array();
        if (!$response)
        {
            $link->error;
        } 
        else 
        {
            $i = 0;
            while ($row = $response->fetch_assoc()) 
            {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
    
    function create() 
    {
    ///1. recibir datos MODIFICAR
        $matricula = $_POST['inputMatricula'];
        $nombre = $_POST['inputNombre'];
        $status = "1";
    //2. guardar datos en el modelo
        require_once '../lib/consultas.php';
        require_once '../models/Periodos.php';
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->create($matricula, $nombre, $status);
    //$response=$objetoDocente->create($matricula,$nombre,$status);
    //3.  enviar una respuestaç
        if ($response) 
        {
            read();
        } 
        else 
        {
            echo "-1";
        }
    }

    function read() 
    {
        $objetoPeriodos = new Periodos();
        $response = $objetoPeriodos->read();
        $result = array();
        if (!$response) 
        {
            $link->error;
        } 
        else 
        {
            $i = 0;
            while ($row = $response->fetch_assoc()) 
            {
                $result[$i] = $row;
                $i++;
            }
            return json_encode($result);
        }
    }
}

