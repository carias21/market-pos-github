<?php
require_once "conexion.php";

class AdministrarVentasModelo{

    public $resultado;

static public function mdlListarVentas(/*$fechaDesde,$fechaHasta*/){

try {

    $stmt = Conexion::conectar()->prepare("SELECT id_venta,
                                                 codigo_producto, 
                                                 categoria, 
                                                 descripcion as producto, 
                                                 cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(precio_venta,2), CHAR)) as precio_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(descuento_venta,2), CHAR)) as descuento_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(total_venta,2), CHAR)) as total_venta,
                                                
                                                 DATE(fecha_venta) as fecha_venta,
                                                 '' as opciones
                                                 FROM ventas c order BY fecha_venta desc");

    $stmt -> execute();

    return $stmt->fetchAll();

    return ("Todo bien hasta aqui");

} catch (Exception $e) {
    return 'Excepción capturada: '.  $e->getMessage(). "\n";
}


$stmt = null;
}


static public function mdlEliminarVenta($tableVentas, $id_venta, $nameId){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tableVentas WHERE $nameId = :$nameId");
    
    $stmt -> bindParam(":".$nameId, $id_venta, PDO::PARAM_INT);

    if ($stmt -> execute()){
        return "ok";;
    }else{
        return Conexion::conectar()->errorInfo();
    }

    }

}