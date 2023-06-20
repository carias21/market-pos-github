<?php

require_once "conexion.php";

class AdministrarComprasModelo
{

    public $resultado;

    static public function mdlListarCompras($fechaDesde, $fechaHasta)
    {

        try {

            $stmt = Conexion::conectar()->prepare("SELECT c.id_compra,
                                                 c.codigo_producto, 
                                                 ca.nombre_categoria as categoria, 
                                                 p.descripcion_producto as producto, 
                                                 c.cantidad, 
                                                  CONCAT('Q. ',CONVERT(ROUND(c.precio_compra,2), CHAR)) as precio_compra,
                                                  CONCAT('Q. ',CONVERT(ROUND(c.total_compra,2), CHAR)) as total_compra,
                                                  c.fecha_compra,
                                                  c.comentarios,
                                                 '' as opciones
                                                 from compras c
                                                 inner join categorias ca on ca.id_categoria = c.fk_id_categoria
                                                 inner join productos p on p.id = c.fk_id_producto
                                   
                                                 where DATE(c.fecha_compra) >= DATE(:fechaDesde) and DATE(c.fecha_compra) <= DATE(:fechaHasta)  
                                                 order BY c.fecha_compra desc");

            $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            // return ("Todo bien hasta aqui");

        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }


        $stmt = null;
    }


    static public function mdlEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto,  $cantidad)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tableCompras WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_compra, PDO::PARAM_INT);

        if ($stmt->execute()) {

            //   return "Todo ok hasta aqui";
            $stmt = null;

            //disminuimos el stock del producto 
            $stmt = Conexion::conectar()->prepare("UPDATE productos SET stock_producto = stock_producto - :cantidad
                                           WHERE codigo_producto = :codigo_producto");


            $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);



            if ($stmt->execute()) {
                return "ok";
            }
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}
