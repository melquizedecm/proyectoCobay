<?php
function getFila($sql){  ///DEVUELVE LA FILA DE LA CONSULTA SQL///
	$link=  conectar();
        $tabla= $link->query($sql);
	$fila = $tabla->fetch_array(MYSQLI_BOTH);
	return $fila;
}

function getTablaUTF8($tabla, $campo, $valor){
	$link = conectar();
	$link->set_charset("utf8");
        if (!empty($campo) && !empty($valor)) {
            $sql="SELECT * FROM ".$tabla. " WHERE ".$campo." = '".$valor."'";
        } else {
            $sql="SELECT * FROM ".$tabla;
        }
        
	$res = $link->query($sql);
	if (!$res) {
		//echo $link->error;
		return null;
	}
	else{
		return $res;
	}
}

function getTabla($tabla)
{
	$link = conectar();
	$sql="SELECT * FROM ".$tabla;
	$res = $link->query($sql);
	if (!$res) 
        {
		//echo $link->error;
		return null;
	}
	else
        {
		return $res;
	}
}

function sqlUpdate($table,$campo, $valor, $campoId, $id){
	$link=conectar();
	$sql="UPDATE ".$table." SET ".$campo."='".$valor."' WHERE ".$campoId."='".$id."'";
	$res = $link->query($sql);
	if (!$res) {
		echo $link->error;
		return false;
	}
	else{
		return true;
	}
}

function getFilaSql($table,$campoId,$id){
	$link=conectar();
	$consulta="SELECT * FROM ".$table." WHERE ".$campoId."='".$id."'";
		if ($result= $link->query($consulta)){
			$fila=$result->fetch_array(MYSQLI_BOTH);
			liberar($result);
			cerrar($link);
			return $fila;
		}
		else{
			return false;
		}
}

function getResultSQL($sql){
        $link = conectar();
	$res = $link->query($sql);
	if (!$res) {
		//echo $link->error;
		return $res;
	}
	else{
		return $res;
	}
}

function getFilaSql2($sql){
	$link = conectar();
		if ($result= $link->query($sql)){
			$fila=$result->fetch_array(MYSQLI_BOTH);
			return $fila;
			liberar($result);
			cerrar($link);
		}
		else{
			return false;
		}
}

function getTablaWhere($table,$campo,$valor){
        $link = conectar();
	$consulta="SELECT * FROM ".$table." WHERE ".$campo."='".$valor."' ORDER BY ".$campo." ASC";
		return $link->query($consulta);
		cerrar($link);
}

function getTablaWhereDesc($link,$table,$campoId,$id){
	$consulta="SELECT * FROM ".$table." WHERE ".$campoId."='".$id."' ORDER BY ".$campoId." DESC";
		return $link->query($consulta);
}

function formatoMoneda($monto){
	return "$ ".number_format($monto,'2','.',',');
}

