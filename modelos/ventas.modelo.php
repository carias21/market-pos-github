<?php
require_once "conexion.php";

class VentasModelo
{
    public $resultado;
    public $resultado2;



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

            $stmt = $conn->prepare("INSERT INTO ventas (codigo_producto, fk_id_categoria, fk_id_producto, cantidad, precio_venta, descuento_venta, total_venta, fecha_venta, usuario, precio_compra, fk_tipo_pago, fk_id_cliente)
                                    VALUES (:codigo_producto, :id_categoria, :id, :cantidad, :precio_venta_producto, :descuento, :total_venta, :fecha_venta, :usuario, :precio_compra, :tipo_pago, :id_cliente)");

            $stmtCaja = $conn->prepare("INSERT INTO caja (codigo_producto, fecha, descripcion, entrada, salida, saldo_actual, fk_usuario, fk_tipo_pago)
                                        VALUES (:codigo_producto, :fecha, :descripcion_producto, :total_venta, '', '', :usuario, :tipo_pago)");

            $stmtStock = $conn->prepare("UPDATE productos SET stock_producto = stock_producto - :cantidad, ventas_producto = ventas_producto + :cantidad WHERE codigo_producto = :codigo_producto");

            foreach ($listaProductos as $producto) {
                $stmt->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmt->bindParam(":id_categoria", $producto[1], PDO::PARAM_STR);
                $stmt->bindParam(":id", $producto[2], PDO::PARAM_STR);
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
                $stmtCaja->bindParam(":descripcion_producto", $producto[10], PDO::PARAM_STR);
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
            $resultado = "error: Se produjo un error al registrar la venta." . $e;
            // Aquí puedes agregar código para registrar el mensaje de error completo en un archivo de registro o mostrar un mensaje de error más específico según tus necesidades.
        }

        return $resultado;
    }


    public static function mdlRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago)
    {
        date_default_timezone_set('America/Guatemala');
        $fecha_actual = date("Y-m-d");
        $fecha_venta =  date("Y-m-d H:i:s");
        $id_usuario = $_SESSION["usuario1"]->id_usuario;

        try {

            $conexion = Conexion::conectar();

            // Verificar existencia de registro con fecha actual
            $stmt_verificar = $conexion->prepare("SELECT COUNT(*) AS cantidad_registros FROM ventas WHERE fecha_venta LIKE :fecha_actual");
            $fecha_actual = '%' . $fecha_actual . '%'; // Asegúrate de tener la variable $fecha_actual con el formato adecuado
            $stmt_verificar->bindParam(':fecha_actual', $fecha_actual);
            $stmt_verificar->execute();

            $cantidad_registros = $stmt_verificar->fetch(PDO::FETCH_ASSOC)['cantidad_registros'];

     

            if ($cantidad_registros > 0) {
                // Ya existe un registro con la fecha actual
                return "error_ya_registros";
            } else {
                // Insertar el nuevo registro
                $stmt = $conexion->prepare("INSERT INTO ventas(cantidad, precio_venta, descuento_venta, total_venta, fecha_venta, usuario, precio_compra, fk_tipo_pago)
                                            VALUES(:cantidad, :precio_venta, :descuento, :total_venta, :fecha_venta, :usuario, :precio_compra, :id_tipo_pago)");

                $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
                $stmt->bindParam(":precio_venta", $precio_venta, PDO::PARAM_STR);
                $stmt->bindParam(":descuento", $descuento, PDO::PARAM_STR);
                $stmt->bindParam(":total_venta", $total, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_venta", $fecha_venta, PDO::PARAM_STR);
                $stmt->bindParam(":usuario", $id_usuario, PDO::PARAM_STR);
                $stmt->bindParam(":precio_compra", $precio_compra, PDO::PARAM_STR);
                $stmt->bindParam(":id_tipo_pago", $id_tipo_pago, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    return "ok";
                } else {
                    return "error";
                }
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage() . "\n";
        }
    }
}
