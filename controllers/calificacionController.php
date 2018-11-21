<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("../core/config.php");
require_once '../lib/links.php';
libnivel2();
require_once '../lib/consultas.php';
$link = conectar();


if (substr($_FILES['excel']['name'], -3) == "csv") {
    $fecha = date("Y-m-d");
    $carpeta = "tmp_excel/";
    $excel = $fecha . "-" . $_FILES['excel']['name'];

    move_uploaded_file($_FILES['excel']['tmp_name'], "$carpeta$excel");

    $row = 1;

    $fp = fopen("$carpeta$excel", "r");

    //fgetcsv. obtiene los valores que estan en el csv y los extrae.
    $id_plantel = "";
    $id_periodo = "";
    $id_plan = "";
    $id_semestre = "";
    $matricula_maestro = "";
    $id_grupo = "";
    $id_asignatura = "";
    $asignatura = "";
    $matricula = "";
    $nombre = "";
    $parcial_uno = "";
    $parcial_dos = "";
    $ordinario = "";
    $data = fgetcsv($fp, 1000, ",");
    
    while ($data = fgetcsv($fp, 1000, ",")) {
        //si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
        if ($row != 1) {
            $id_plantel = $data[0];
            $periodo = $data[1];
            $plan = $data[2];
            $id_semestre = $data[3];
            $matricula_maestro = $data[4];
            $grupo = $data[5];
            $id_asignatura = $data[6];
            $asignatura = $data[7];
            $matricula = $data[8];
            $nombre = $data[9];
            $parcial_uno = $data[10];
            $parcial_dos = $data[11];
            $ordinario = $data[12];
            $error=[];
            //SECCION PARA CONFIGURAR DATOS
            
            $respuesta = getFilaSql("planteles", "id_plantel", $id_plantel);
            ($respuesta==true)? '':array_push($error, "1"); 
            $respuesta = getFilaSql("periodos", "periodo", $periodo);
            ($respuesta==true)? '':array_push($error, "2"); 
            $respuesta = getFilaSql("planes", "plan", $plan);
            ($respuesta==true)? '':array_push($error, "3");
            $respuesta = getFilaSql("semestres", "id_semestre", $id_semestre);
            ($respuesta==true)? '':array_push($error, "4");
            $respuesta = getFilaSql("maestros", "matricula_maestro", $matricula_maestro);
            ($respuesta==true)? '':array_push($error, "5");
            $respuesta = getFilaSql("planes", "plan", $plan);
            ($respuesta==true)? '':array_push($error, "6");
            $respuesta = getFilaSql("grupos", "grupo", $grupo);
            ($respuesta==true)? '':array_push($error, "7");
            $respuesta = getFilaSql("asignaturas", "id_asignatura", $id_asignatura);
            ($respuesta==true)? '':array_push($error, "8");
            $respuesta = getFilaSql("asignaturas", "asignatura", $asignatura);
            ($respuesta==true)? '':array_push($error, "9");
            $respuesta = getFilaSql("alumnos", "matricula", $matricula);
            ($respuesta==true)? '':array_push($error, "10");
            $respuesta = getFilaSql("alumnos", "nombre", $nombre);
            ($respuesta==true)? '':array_push($error, "11");
            
           foreach( $error as $valor){
               if($valor!=""){
                   header("Location: ../views/calificaciones/index.php?error=".$valor);
               } 
            }
            

            $insertar = "INSERT INTO calificaciones (id_calificaciones,parcial_uno,parcial_dos,ordinario) 
						   VALUES ('','$parcial_uno','$parcial_dos','$ordinario')";
            $sql = mysqli_query($link, $insertar) or die(mysqli_error($link));

            if (!$sql) {
                echo "<div>Hubo un problema al momento de importar porfavor vuelva a intentarlo</div >";
                exit;
            }

            $select1 = "SELECT id_calificaciones FROM calificaciones WHERE parcial_uno='$data[10]' and parcial_dos='$data[11]' and ordinario='$data[12]'";
            $res1 = $link->query($select1);

            $select2 = "SELECT id_excel FROM excel WHERE matricula='$data[8]'";
            $res2 = $link->query($select2);

            $actualizar = "UPDATE excel_asignatura SET id_calificaciones='" . $res1 . "' WHERE id_excel='" . $res2 . "'";
            if ($link->query($actualizar)) {
                echo 'se actualizo ';
            } else {
                echo 'error no se actualizo' . $link->error;
            }
        }

        $row++;
    }

    fclose($fp);

    echo "<div>La importacion de archivo subio satisfactoriamente</div >";

    exit;
}
?>
