<?php

require_once "conexion.php";

class AdministrarVentasModelo
{

    public $resultado;

    static public function mdlListarVentas($fechaDesde, $fechaHasta)
    {

        try {

            $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                                                 v.codigo_producto, 
                                                 v.categoria, 
                                                 v.descripcion as producto, 
                                                 v.cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                                                  v.fecha_venta,
                                                 '' as opciones
                                                 from ventas v
                                                 where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta)  
                                                 order BY v.fecha_venta desc");

            $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            return ("Todo bien hasta aqui");
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }


        $stmt = null;
    }


    static public function mdlEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto, $fecha_venta)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tableVentas WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_venta, PDO::PARAM_INT);

        if ($stmt->execute()) {

            //   return "Todo ok hasta aqui";
            $stmt = null;

            //disminuimos el stock despues de la venta
            $stmt = Conexion::conectar()->prepare("UPDATE PRODUCTOS SET stock_producto = stock_producto + :cantidad, ventas_producto = ventas_producto - :cantidad
                                           WHERE codigo_producto = :codigo_producto");

            $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);


            //ELIMINAMOS EN LA TABLA CAJA EL DATO OBTENIDO POR LA VENTA
            if ($stmt->execute()) {


                //   return "Todo ok hasta aqui";
                $stmt = null;

                //disminuimos el stock del producto 
                $stmt = Conexion::conectar()->prepare("DELETE FROM caja 
                                           WHERE codigo_producto = :codigo_producto AND fecha = :fecha_venta");


                $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_venta", $fecha_venta, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    return "ok";
                }
            }
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}





























/*require_once "conexion.php";

class AdministrarVentasModelo{

    public $resultado;

     // VD 21 MIN 13:10
static public function mdlListarVentas($fechaDesde,$fechaHasta){

try {

    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                                                 v.codigo_producto, 
                                                 v.categoria, 
                                                 v.descripcion as producto, 
                                                 v.cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                                                  CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                                                
                                                  DATE(v.fecha_venta) as fecha_venta,
                                               
                                                 '' as opciones
                                                where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta) 
                                                 FROM ventas v order BY fecha_venta desc");

$stmt -> bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
$stmt -> bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);


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

*/