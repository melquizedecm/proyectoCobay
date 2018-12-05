<?php

require_once("../core/config.php");

class ClassConsultas {

    function __construct() {
    if (!$this->link = conectar()){
        echo "error en la conexion";
    }
        
    }

    public function getFila($sql) {  ///DEVUELVE LA FILA DE LA CONSULTA SQL///
        $tabla = $this->link->query($sql);
        $fila = $tabla->fetch_array(MYSQLI_BOTH);
        return $fila;
    }

    public function getTablaUTF8($tabla, $campo, $valor) {
        $this->link->set_charset("utf8");
        if (!empty($campo) && !empty($valor)) {
            $sql = "SELECT * FROM " . $tabla . " WHERE " . $campo . " = '" . $valor . "'";
        } else {
            $sql = "SELECT * FROM " . $tabla;
        }

        $res = $this->link->query($sql);
        if (!$res) {
            //echo $this->link->error;
            return null;
        } else {
            return $res;
        }
    }

    public function getTabla($tabla) {
        $sql = "SELECT * FROM " . $tabla;
        $res = $this->link->query($sql);
        if (!$res) {
            //echo $this->link->error;
            return null;
        } else {
            return $res;
        }
    }

    public function sqlUpdate($table, $campo, $valor, $campoId, $id) {
        $sql = "UPDATE " . $table . " SET " . $campo . "='" . $valor . "' WHERE " . $campoId . "='" . $id . "'";
        $res = $this->link->query($sql);
        if (!$res) {
            echo $this->link->error;
            return false;
        } else {
            return true;
        }
    }

    public function getFilaSql($table, $campoId, $id) {
        $consulta = "SELECT * FROM " . $table . " WHERE " . $campoId . "='" . $id . "'";
        if ($result = $this->link->query($consulta)) {
            $fila = $result->fetch_array(MYSQLI_BOTH);
            liberar($result);
            cerrar($this->link);
            return $fila;
        } else {
            return false;
        }
    }

    public function getResultSQL($sql) {
        $res = $this->link->query($sql);
        if (!$res) {
            //echo $this->link->error;
            return $res;
        } else {
            return $res;
        }
    }

    public function getFilaSql2($sql) {
        if ($result = $this->link->query($sql)) {
            $fila = $result->fetch_array(MYSQLI_BOTH);
            return $fila;
            liberar($result);
            cerrar($this->link);
        } else {
            return false;
        }
    }

    public function getTablaWhere($table, $campo, $valor) {
        $consulta = "SELECT * FROM " . $table . " WHERE " . $campo . "='" . $valor . "' ORDER BY " . $campo . " ASC";
        return $this->link->query($consulta);
        cerrar($this->link);
    }

    public function getTablaWhereDesc($table, $campoId, $id) {
        $consulta = "SELECT * FROM " . $table . " WHERE " . $campoId . "='" . $id . "' ORDER BY " . $campoId . " DESC";
        return $this->link->query($consulta);
    }

    public function formatoMoneda($monto) {
        return "$ " . number_format($monto, '2', '.', ',');
    }

}
