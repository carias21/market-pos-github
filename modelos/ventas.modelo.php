<?php
require_once "conexion.php";

class VentasModelo
{
    public $resultado;

    static public function mdlRegistrarVenta($datos, $fecha_venta)
    {
        $id_usuario = $_SESSION["usuario1"]->id_usuario;
        $listaProductos = [];
    
        for ($i = 0; $i < count($datos); ++$i) {
            $producto = explode(",", $datos[$i]);
            $listaProductos[] = $producto;
        }
    
        try {
            $conn = Conexion::conectar();
            $conn->beginTransaction();
    
            $stmt = $conn->prepare("INSERT INTO ventas (codigo_producto, categoria, descripcion, cantidad, precio_venta, descuento_venta, total_venta, fecha_venta, usuario, precio_compra, fk_tipo_pago, fk_id_cliente)
                                    VALUES (:codigo_producto, :nombre_categoria, :descripcion_producto, :cantidad, :precio_venta_producto, :descuento, :total_venta, :fecha_venta, :usuario, :precio_compra, :tipo_pago, :id_cliente)");
    
            $stmtCaja = $conn->prepare("INSERT INTO caja (codigo_producto, fecha, descripcion, entrada, salida, saldo_actual, fk_usuario, fk_tipo_pago)
                                        VALUES (:codigo_producto, :fecha, :descripcion_producto, :total_venta, '', '', :usuario, :tipo_pago)");
    
            $stmtStock = $conn->prepare("UPDATE productos SET stock_producto = stock_producto - :cantidad, ventas_producto = ventas_producto + :cantidad WHERE codigo_producto = :codigo_producto");
    
            foreach ($listaProductos as $producto) {
                $stmt->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_categoria", $producto[1], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion_producto", $producto[2], PDO::PARAM_STR);
                $stmt->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);
                $stmt->bindParam(":precio_venta_producto", $producto[4], PDO::PARAM_STR);
                $stmt->bindParam(":descuento", $producto[5], PDO::PARAM_STR);
                $stmt->bindParam(":total_venta", $producto[6], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_venta", $fecha_venta, PDO::PARAM_STR);
                $stmt->bindParam(":usuario", $id_usuario, PDO::PARAM_STR);
                $stmt->bindParam(":precio_compra",  $producto[7], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_pago",  $producto[8], PDO::PARAM_STR);
                $stmt->bindParam(":id_cliente",  $producto[9], PDO::PARAM_STR);
    
                $stmtCaja->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtCaja->bindParam(":descripcion_producto", $producto[2], PDO::PARAM_STR);
                $stmtCaja->bindParam(":total_venta", $producto[6], PDO::PARAM_STR);
                $stmtCaja->bindParam(":fecha", $fecha_venta, PDO::PARAM_STR);
                $stmtCaja->bindParam(":usuario", $id_usuario, PDO::PARAM_STR);
                $stmtCaja->bindParam(":tipo_pago",  $producto[8], PDO::PARAM_STR);
    
                $stmtStock->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtStock->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);
    
                $stmt->execute();
                $stmtCaja->execute();
                $stmtStock->execute();
            }
    
            $conn->commit();
    
            $resultado = "ok";
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "error: Se produjo un error al registrar la venta.".$e;
            // Aquí puedes agregar código para registrar el mensaje de error completo en un archivo de registro o mostrar un mensaje de error más específico según tus necesidades.
        }
    
        return $resultado;
    }
    
}
