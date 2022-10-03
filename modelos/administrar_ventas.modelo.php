<?php
require_once "conexion.php";

class AdministrarVentasModelo{

    public $resultado;

static public function mdlListarVentas(/*$fechaDesde,$fechaHasta*/){

try {

    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                                                 v.codigo_producto, 
                                                 v.categoria, 
                                                 v.descripcion as producto, 
                                                 v.cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                                                
                                                  TIMESTAMP(v.fecha_venta) as fecha_venta,
                                                 '' as opciones
                                                 FROM ventas v order BY fecha_venta desc");

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