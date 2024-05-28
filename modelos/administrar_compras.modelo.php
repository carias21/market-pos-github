<?php

require_once "conexion.php";

class AdministrarComprasModelo
{

    public $resultado;

    static public function mdlListarCompras($compras_desde, $compras_hasta, $idProveedor)
{

    try {
        if (!empty($idProveedor)) {

            $stmt = Conexion::conectar()->prepare("SELECT c.id_compra,
                c.codigo_producto, 
                ca.nombre_categoria as categoria, 
                p.descripcion_producto as producto, 
                c.cantidad, 
                CONCAT('Q. ', CONVERT(ROUND(c.precio_compra, 2), CHAR)) as precio_compra,
                CONCAT('Q. ', CONVERT(ROUND(c.total_compra, 2), CHAR)) as total_compra,
                c.fecha_compra,
                c.comentarios,
                prov.nombre,
                '' as opciones
                FROM compras c
                INNER JOIN categorias ca ON ca.id_categoria = c.fk_id_categoria
                INNER JOIN productos p ON p.id = c.fk_id_producto
                INNER JOIN proveedores prov ON prov.id_proveedor = p.fk_id_proveedor
                WHERE DATE(c.fecha_compra) >= DATE(:compras_desde) AND DATE(c.fecha_compra) <= DATE(:compras_hasta) AND p.fk_id_proveedor = :idProveedor
                ORDER BY c.fecha_compra DESC");

            $stmt->bindParam(":compras_desde", $compras_desde, PDO::PARAM_STR);
            $stmt->bindParam(":compras_hasta", $compras_hasta, PDO::PARAM_STR);
            $stmt->bindParam(":idProveedor", $idProveedor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT c.id_compra,
                c.codigo_producto, 
                ca.nombre_categoria as categoria, 
                p.descripcion_producto as producto, 
                c.cantidad, 
                CONCAT('Q. ', CONVERT(ROUND(c.precio_compra, 2), CHAR)) as precio_compra,
                CONCAT('Q. ', CONVERT(ROUND(c.total_compra, 2), CHAR)) as total_compra,
                c.fecha_compra,
                c.comentarios,
                prov.nombre,
                '' as opciones
                FROM compras c
                INNER JOIN categorias ca ON ca.id_categoria = c.fk_id_categoria
                INNER JOIN productos p ON p.id = c.fk_id_producto
                inner join proveedores prov on prov.id_proveedor = p.fk_id_proveedor
                WHERE DATE(c.fecha_compra) >= DATE(:compras_desde) AND DATE(c.fecha_compra) <= DATE(:compras_hasta)
                ORDER BY c.fecha_compra DESC");

            $stmt->bindParam(":compras_desde", $compras_desde, PDO::PARAM_STR);
            $stmt->bindParam(":compras_hasta", $compras_hasta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }
    } catch (PDOException $e) {
        throw new Exception('Excepción capturada: ' . $e->getMessage());
    }
}


    static public function mdlEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto,  $cantidad)
    {

        try {
            $conn = Conexion::conectar();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();

            // Eliminar la compra
            $stmtDeleteCompra = $conn->prepare("DELETE FROM $tableCompras WHERE $nameId = :$nameId");
            $stmtDeleteCompra->bindParam(":" . $nameId, $id_compra, PDO::PARAM_STR);
            $stmtDeleteCompra->execute();

            // Actualizar la cantidad de productos
            $stmtUpdateProductos = $conn->prepare("UPDATE productos SET stock_producto = stock_producto - :cantidad
            WHERE codigo_producto = :codigo_producto");
            $stmtUpdateProductos->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmtUpdateProductos->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmtUpdateProductos->execute();

            // Si llega aquí, ambas operaciones fueron exitosas, entonces confirmar la transacción
            $conn->commit();
            $resultado = "ok";
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "ERROR ELIMINAR COMPRA " . $e;
        }
        return $resultado;
    }
}
