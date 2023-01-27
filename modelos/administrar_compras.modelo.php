<?php

require_once "conexion.php";

class AdministrarComprasModelo{

    public $resultado;

static public function mdlListarCompras($fechaDesde,$fechaHasta){

try {

    $stmt = Conexion::conectar()->prepare("SELECT c.id_compra,
                                                 c.codigo_producto, 
                                                 c.categoria, 
                                                 c.descripcion as producto, 
                                                 c.cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(c.precio_compra,2), CHAR)) as precio_compra,
                                                 
                                                  CONCAT('Q. ',CONVERT(ROUND(c.total_compra,2), CHAR)) as total_compra,
                                                  c.fecha_compra,
                                                  c.comentarios,
                                                 '' as opciones
                                                 from compras c
                                                 where DATE(c.fecha_compra) >= DATE(:fechaDesde) and DATE(c.fecha_compra) <= DATE(:fechaHasta)  
                                                 order BY c.fecha_compra desc");

$stmt -> bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
$stmt -> bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt->fetchAll();

   // return ("Todo bien hasta aqui");

} catch (Exception $e) {
    return 'Excepción capturada: '.  $e->getMessage(). "\n";
}


$stmt = null;
}


static public function mdlEliminarVenta($tableVentas, $id_venta, $nameId){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tableVentas WHERE $nameId = :$nameId");
    
    $stmt -> bindParam(":".$nameId, $id_venta, PDO::PARAM_INT);

    if ($stmt -> execute()){
        return "ok";
    }else{
        return Conexion::conectar()->errorInfo();
    }

    }

}
