<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("..//core//conexion.php");

$cn = Conexion();

if (substr($_FILES['excel']['name'], -3) == "csv") {
    $fecha = date("Y-m-d");
    $carpeta = "tmp_excel/";
    $excel = $fecha . "-" . $_FILES['excel']['name'];

    move_uploaded_file($_FILES['excel']['tmp_name'], "$carpeta$excel");

    $row = 1;

    $fp = fopen("$carpeta$excel", "r");

    //fgetcsv. obtiene los valores que estan en el csv y los extrae.

    while ($data = fgetcsv($fp, 1000, ",")) {
        //si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
        if ($row != 1) {

            $num = count($data);
            $insertar = "INSERT INTO agenda_datos (nombres,apellidos,direccion,celular,email) 
						   VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
            $sql = mysql_query($insertar) or die(mysql_error());

            if (!$sql) {
                echo "<div>Hubo un problema al momento de importar porfavor vuelva a intentarlo</div >";
                exit;
            }
        }

        $row++;
    }

    fclose($fp);

    echo "<div>La importacion de archivo subio satisfactoriamente</div >";

    exit;
}
?>
