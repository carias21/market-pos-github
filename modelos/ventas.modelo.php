<?php
require_once "conexion.php";
require_once "../config.php";

class VentasModelo
{
    public $resultado;
    public $resultado2;
    public $alertaStock;

    static public function mdlRegistrarVenta($datos)
    {

        date_default_timezone_set('America/Guatemala');
        $fecha_venta = date("Y-m-d H:i:s");

        global $session_id_usuario;
        $session_id_usuario = $session_id_usuario->id_usuario;

        $listaProductos = [];

        for ($i = 0; $i < count($datos); ++$i) {
            $producto = explode(",", $datos[$i]);
            $listaProductos[] = $producto;
        }

        try {
            $conn = Conexion::conectar();
            // Configurar PDO para que lance excepciones en caso de errores.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();

            $stmt = $conn->prepare("INSERT INTO ventas (codigo_producto, fk_id_categoria, fk_id_producto, cantidad, precio_venta, descuento_venta, total_venta, fecha_venta, usuario, precio_compra, fk_tipo_pago, fk_id_cliente)
                                        VALUES (:codigo_producto, :id_categoria, :id, :cantidad, :precio_venta_producto, :descuento, :total_venta, :fecha_venta, :usuario, :precio_compra, :tipo_pago, :id_cliente)");

            $stmtCaja = $conn->prepare("INSERT INTO caja (codigo_producto, fecha, descripcion, cantidad, entrada, salida, saldo_actual, fk_usuario, fk_tipo_pago)
                                        VALUES (:codigo_producto, :fecha, :descripcion_producto, :cantidad, :total_venta, '', '', :usuario, :tipo_pago)");

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
                $stmt->bindParam(":usuario", $session_id_usuario, PDO::PARAM_STR);
                $stmt->bindParam(":precio_compra",  $producto[7], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_pago",  $producto[8], PDO::PARAM_STR);
                $stmt->bindParam(":id_cliente",  $producto[9], PDO::PARAM_STR);

                $stmtCaja->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtCaja->bindParam(":descripcion_producto", $producto[10], PDO::PARAM_STR);
                $stmtCaja->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);
                $stmtCaja->bindParam(":total_venta", $producto[6], PDO::PARAM_STR);
                $stmtCaja->bindParam(":fecha", $fecha_venta, PDO::PARAM_STR);
                $stmtCaja->bindParam(":usuario", $session_id_usuario, PDO::PARAM_STR);
                $stmtCaja->bindParam(":tipo_pago",  $producto[8], PDO::PARAM_STR);

                $stmtStock->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtStock->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);

                $stmt->execute();
                $stmtCaja->execute();
                $stmtStock->execute();

                self::verificarStock($conn, $producto[10], $producto[0]);

            }

            $conn->commit();

            $resultado = $fecha_venta;
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "ERROR REGISTRO VENTA " . $e;
            // Aquí puedes agregar código para registrar el mensaje de error completo en un archivo de registro o mostrar un mensaje de error más específico según tus necesidades.
        }

        return $resultado;
    }

    public static function verificarStock($conn, $producto, $codigo_producto)
    {
        try {

            $stmtVerificarStock = $conn->prepare("SELECT codigo_producto, stock_producto, minimo_stock_producto FROM productos WHERE codigo_producto = :codigo_producto");
            $stmtVerificarStock->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_INT);
    
            $stmtVerificarStock->execute();
    
            // Obtener los resultados
            $resultadoStock = $stmtVerificarStock->fetch(PDO::FETCH_ASSOC);

            if ($resultadoStock && ($resultadoStock['stock_producto'] == $resultadoStock['minimo_stock_producto'])) {

                $_POST["alertaStock"] = "ALERTA: EL PRODUCTO $producto CON CÓDIGO: $codigo_producto HA ALCANZADO EL MÍNIMO STOCK."
                    . " EXISTENCIA ACTUAL:  $resultadoStock[stock_producto]";
                include_once '../vistas/enviar_correo.php';
            
            
                return $_POST["alertaStock"];
            } elseif($resultadoStock && ($resultadoStock['stock_producto'] == 0)){
                $_POST["stock0"] = "ALERTA: EL PRODUCTO $producto CON CÓDIGO: $codigo_producto SE HA AGOTADO";
                include_once '../vistas/enviar_correo.php';
    
                return $_POST["stock0"];
            }
            else {
                return;
            }
        } catch (PDOException $e) {

            return "Error al verificar el stock: " . $e->getMessage();
        }
    }


    public static function mdlRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago)
    {

        global $session_id_usuario;


        date_default_timezone_set('America/Guatemala');
        $fecha_actual = date("Y-m-d");
        $fecha_venta =  date("Y-m-d H:i:s");
        $id_usuario = $session_id_usuario->id_usuario;
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


    static  public function mdlObtenerDetalleVenta($fecha_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT v.total_venta, 
                                                        v.fecha_venta,
                                                        v.codigo_producto,
                                                        upper(p.descripcion_producto) as descripcion_producto,
                                                        v.cantidad,
                                                        v.precio_venta,
                                                        v.descuento_venta,
                                                        v.total_venta,
                                                        u.nombre_usuario,
                                                        u.apellido_usuario,
                                                        c.nombre_cliente, 
                                                        c.numero_tel,
                                                        c.nit_cliente,
                                                        c.correo_electronico,
                                                        c.direccion

                                                FROM ventas v 
                                                INNER JOIN productos p ON p.codigo_producto = v.codigo_producto
                                                INNER JOIN usuarios u on u.id_usuario = v.usuario
                                                INNER JOIN clientes c on c.id_cliente = v.fk_id_cliente
                                                WHERE v.fecha_venta = :fecha_venta");

        $stmt->bindParam(":fecha_venta", $fecha_venta, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return "error";
        }
    }
}
