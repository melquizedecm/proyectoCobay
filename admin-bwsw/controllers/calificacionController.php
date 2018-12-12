<?php
/**
 *  ALGORITMO PARA SUBIR LAS CALIFICACIONES
 * 
 * 1. ABRIR ARCHIVO
 * 2. OBTENER LOS DATOS.
 * 3. VALIDAR QUE LOS DATOS DEL EXCEL EXISTAN EN SUS TABLAS PRIMARIAS
 * 4. REVISAR SI EL REGISTRO QUE SE VA A SUBIR, EXISTE
 * 4A. SI EXISTE SE ACTUALIZA
 * 4B. SINO EXISTE SE INSERTA
 * 5. REGRESAR MENSAJE DE ERROR O EXITO.
 * 
 * * */
require_once '../lib/links.php';
libnivel2();
require_once '../lib/mensajes.php';
require_once '../models/Calificaciones.php';
///////1. ABRIR ARCHIVO///////
$objCalificaciones = new Calificaciones();
$link = conectar();
$error = "";
if (substr($_FILES['excel']['name'], -3) == "csv") {
    $fecha = date("Y-m-d");
    $carpeta = "tmp_excel/";
    $excel = $fecha . "-" . $_FILES['excel']['name'];

    move_uploaded_file($_FILES['excel']['tmp_name'], "$carpeta$excel");

    $row = 1;

    $fp = fopen("$carpeta$excel", "r");
}

///////2 Y 3. OBTENER LOS DATOS Y VALIDARLOS///////
$retornoError="";
$message2="";
$type2="";
while ($data = fgetcsv($fp, 1000, ",")) {
    //si la linea es igual a 1 no guardamos por que serian los titulos de la hoja del excel.
    if ($row != 1) {
        $message = $objCalificaciones->excelValido($data);
        if ($message != "") {
            $type = "004";
            //header("Location: ../views/calificaciones/index.php?message=".$message."&type=".$type);
            $message2=$message;
            $type2=$type;
            $retornoError = "1";
            break;
        } else {
            $retornoError = "2";
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
            $error = [];

            ////////// Valiar Periodo Activo///////////
            //////////4. REVISAR SI EL REGISTRO QUE SE VA A AGREGAR YA EXISTE ////////////
            ///// 4A. 

            $filaPeriodo = getFilaSql("periodos", "periodo", $periodo);
            $id_periodo = $filaPeriodo['id_periodo'];
            $filaGrupo = getFilaSql("grupos", "grupo", $grupo);
            $id_grupo = $filaGrupo['id_grupo'];
            $filaplan = getFilaSql("planes", "plan", $plan);
            $id_plan = $filaplan['id_plan'];
            $sql1 = "SELECT excel.id_excel FROM excel WHERE excel.id_plantel='" . $id_plantel . "'  AND excel.id_periodo='" . $id_periodo . "' AND excel.id_grupo='" . $id_grupo . "' AND excel.matricula='" . $matricula . "'";
            $res1 = $link->query($sql1);

            if ($res1->num_rows > 0) {

                $filaExcel = $res1->fetch_array(MYSQLI_BOTH);
                $id_excel = $filaExcel['id_excel'];
                $sql2 = "SELECT excel_asignatura.id_excel_asignatura, excel_asignatura.id_asignatura, excel_asignatura.matricula_maestro, excel_asignatura.id_plan FROM excel_asignatura WHERE excel_asignatura.id_excel='" . $id_excel . "' AND excel_asignatura.id_asignatura='" . $id_asignatura . "' AND excel_asignatura.matricula_maestro='" . $matricula_maestro . "' AND excel_asignatura.id_plan='" . $id_plan . "'";
                $res2 = $link->query($sql2);
                if ($res2->num_rows > 0) {
                    $filaExcel2 = $res2->fetch_array(MYSQLI_BOTH);
                    $id_excel_asignatura = $filaExcel2['id_excel_asignatura'];

                    $sqlUpdate = "UPDATE excel_asignatura SET parcial_uno='100',parcial_dos='" . $parcial_dos . "', ordinario='" . $ordinario . "' WHERE id_excel_asignatura='" . $id_excel_asignatura . "'";
                    $res3 = getResultSQL($sqlUpdate);
                } else {

                    $insertarsq2 = "INSERT INTO excel_asignatura (id_asignatura,matricula_maestro,id_excel,id_plan,parcial_uno,parcial_dos,ordinario) 
                    VALUES ('" . $id_asignatura . "','" . $matricula_maestro . "','" . $id_excel . "','" . $id_plan . "','" . $parcial_uno . "','" . $parcial_dos . "','" . $ordinario . "')";
                    $insertarExcel = mysqli_query($link, $insertarsq2);
                }
            } else {
                $insertarsql = "INSERT INTO excel (id_plantel,id_periodo,id_grupo,matricula) 
						   VALUES ('" . $id_plantel . "','" . $id_periodo . "','" . $id_grupo . "','" . $matricula . "')";
                $insertarExcel = mysqli_query($link, $insertarsql);
                $res1 = $link->query($sql1);
                $filaExcel = $res1->fetch_array(MYSQLI_BOTH);
                $id_excel = $filaExcel['id_excel'];
                $sql2 = "SELECT excel_asignatura.id_asignatura, excel_asignatura.matricula_maestro, excel_asignatura.id_plan FROM excel_asignatura WHERE excel_asignatura.id_excel='" . $id_excel . "'";
                $res2 = $link->query($sql2);
                if ($res2->num_rows > 0) {
                    $filaExcel2 = $res2->fetch_array(MYSQLI_BOTH);
                    $id_excel_asignatura = $filaExcel2['id_excel_asignatura'];
                    $sqlUpdate = "UPDATE excel_asignatura SET parcial_uno='" . $parcial_uno . "',parcial_dos='" . $parcial_dos . "', ordinario='" . $ordinario . "' WHERE id_excel_asignatura='" . $id_excel_asignatura . "'";
                    $res3 = getResultSQL($sqlUpdate);
                } else {

                    $insertarsq2 = "INSERT INTO excel_asignatura (id_asignatura,matricula_maestro,id_excel,id_plan,parcial_uno,parcial_dos,ordinario) 
                    VALUES ('" . $id_asignatura . "','" . $matricula_maestro . "','" . $id_excel . "','" . $id_plan . "','" . $parcial_uno . "','" . $parcial_dos . "','" . $ordinario . "')";
                    $insertarExcel = mysqli_query($link, $insertarsq2);
                }
            }
        }
    }
    $row++;
}


fclose($fp);

    header("Location: ../views/calificaciones/index.php?message=".$message2."&type=".$type2."&action=".$retornoError);

exit;
?>




