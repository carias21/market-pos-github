<?php

require_once "conexion.php";
require_once "../config.php";

class AdministrarVentasModelo
{

    public $resultado;
    static public function mdlListarVentas($fechaDesde, $fechaHasta, $sel_Usuario, $sel_Tipo_Pago)
    {

        global $session_id_usuario;
        $session_id_usuario = $session_id_usuario->id_usuario;


        try {

            if ($session_id_usuario == 1) {

                if (!empty($sel_Usuario)  && !empty($sel_Tipo_Pago)) {
                    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                    v.codigo_producto, 
                    ca.nombre_categoria, 
                    p.descripcion_producto as producto, 
                    v.cantidad, 
                     CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                     CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                     CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                     v.fecha_venta,
                     u.usuario,
                     precio_compra,
                     tp.tipo_pago,
                     c.nombre_cliente,
                    '' as opciones
                    from ventas v

                    inner join categorias ca on ca.id_categoria = v.fk_id_categoria
                    inner join productos p on p.id = v.fk_id_producto
                    inner join usuarios u on u.id_usuario = v.usuario
                    inner join tipo_pago tp on tp.id = v.fk_tipo_pago
                    inner join clientes c on c.id_cliente = v.fk_id_cliente

                    where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta) 
                    AND v.usuario = :sel_usuario
                    AND v.fk_tipo_pago = :sel_Tipo_Pago
                    order BY v.fecha_venta desc");


                    $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
                    $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);
                    $stmt->bindParam(":sel_usuario", $sel_Usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":sel_Tipo_Pago", $sel_Tipo_Pago, PDO::PARAM_STR);




                    $stmt->execute();

                    return $stmt->fetchAll();
                } else if (!empty($sel_Usuario) && empty($sel_Tipo_Pago)) {
                    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                  v.codigo_producto, 
                  ca.nombre_categoria, 
                  p.descripcion_producto as producto, 
                  v.cantidad, 
                  CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                  CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                  CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                  v.fecha_venta,
                  u.usuario,
                  precio_compra,
                  tp.tipo_pago,
                  c.nombre_cliente,
                  '' as opciones
                  from ventas v
                  inner join categorias ca on ca.id_categoria = v.fk_id_categoria
                  inner join productos p on p.id = v.fk_id_producto
                  inner join usuarios u on u.id_usuario = v.usuario
                  inner join tipo_pago tp on tp.id = v.fk_tipo_pago
                  inner join clientes c on c.id_cliente = v.fk_id_cliente
                  where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta) 
                  AND v.usuario = :sel_usuario
                  order BY v.fecha_venta desc");

                    $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
                    $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);
                    $stmt->bindParam(":sel_usuario", $sel_Usuario, PDO::PARAM_STR);

                    $stmt->execute();

                    return $stmt->fetchAll();
                } else if (empty($sel_Usuario) && !empty($sel_Tipo_Pago)) {
                    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                    v.codigo_producto, 
                    ca.nombre_categoria, 
                    p.descripcion_producto as producto, 
                    v.cantidad, 
                    CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                    CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                    CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                    v.fecha_venta,
                    u.usuario,
                    precio_compra,
                    tp.tipo_pago,
                    c.nombre_cliente,
                    '' as opciones
                    from ventas v
                    inner join categorias ca on ca.id_categoria = v.fk_id_categoria
                    inner join productos p on p.id = v.fk_id_producto
                    inner join usuarios u on u.id_usuario = v.usuario
                    inner join tipo_pago tp on tp.id = v.fk_tipo_pago
                    inner join clientes c on c.id_cliente = v.fk_id_cliente
                    where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta) 
                    AND v.fk_tipo_pago = :sel_Tipo_Pago
                    order BY v.fecha_venta desc");

                    $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
                    $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);
                    $stmt->bindParam(":sel_Tipo_Pago", $sel_Tipo_Pago, PDO::PARAM_STR);

                    $stmt->execute();

                    return $stmt->fetchAll();
                } else {
                    $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                    v.codigo_producto, 
                    ca.nombre_categoria, 
                    p.descripcion_producto as producto, 
                    v.cantidad, 
                    CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                    CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                    CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                    v.fecha_venta,
                    u.usuario,
                    precio_compra,
                    tp.tipo_pago,
                    c.nombre_cliente,
                    '' as opciones
                    FROM ventas v
                    inner join categorias ca on ca.id_categoria = v.fk_id_categoria
                    inner join productos p on p.id = v.fk_id_producto
                    INNER JOIN usuarios u ON u.id_usuario = v.usuario
                    INNER JOIN tipo_pago tp ON tp.id = v.fk_tipo_pago
                    inner join clientes c on c.id_cliente = v.fk_id_cliente
                    WHERE DATE(v.fecha_venta) >= DATE(:fechaDesde) AND DATE(v.fecha_venta) <= DATE(:fechaHasta)
                    ORDER BY v.fecha_venta DESC");


                    $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
                    $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);

                    $stmt->execute();
                    return $stmt->fetchAll();
                }
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT v.id_venta,
                v.codigo_producto, 
                ca.nombre_categoria, 
                p.descripcion_producto as producto,  
                v.cantidad, 
                 CONCAT('Q. ',CONVERT(ROUND(v.precio_venta,2), CHAR)) as precio_venta,
                 CONCAT('Q. ',CONVERT(ROUND(v.descuento_venta,2), CHAR)) as descuento_venta,
                 CONCAT('Q. ',CONVERT(ROUND(v.total_venta,2), CHAR)) as total_venta,
                 v.fecha_venta,
                 u.usuario,
                 precio_compra,
                 tp.tipo_pago,
                 c.nombre_cliente,
                '' as opciones
                from ventas v
                inner join categorias ca on ca.id_categoria = v.fk_id_categoria
                inner join productos p on p.id = v.fk_id_producto
                inner join usuarios u on u.id_usuario = v.usuario
                inner join tipo_pago tp on tp.id = fk_tipo_pago
                inner join clientes c on c.id_cliente = v.fk_id_cliente
                where DATE(v.fecha_venta) >= DATE(:fechaDesde) and DATE(v.fecha_venta) <= DATE(:fechaHasta) and v.usuario = :usuario
                order BY v.fecha_venta desc");

                $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
                $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);
                $stmt->bindParam(":usuario", $session_id_usuario, PDO::PARAM_STR);


                $stmt->execute();

                return $stmt->fetchAll();

                //return ("Todo bien hasta aqui");
            }
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
        $stmt = null;
    }


    static public function mdlEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto, $fecha_venta)
    {
        try {
            $conn = Conexion::conectar();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();

            // Eliminar la venta
            $stmtEliminarVenta = $conn->prepare("DELETE FROM $tableVentas WHERE $nameId = :$nameId");
            $stmtEliminarVenta->bindParam(":" . $nameId, $id_venta, PDO::PARAM_STR);
            $stmtEliminarVenta->execute();

            // Actualizar el stock de productos y ventas
            $stmtUpdateProductos = $conn->prepare("UPDATE productos SET stock_producto = stock_producto + :cantidad, ventas_producto = ventas_producto - :cantidad
            WHERE codigo_producto = :codigo_producto");
            $stmtUpdateProductos->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmtUpdateProductos->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmtUpdateProductos->execute();


            $stmtEliminarCaja = $conn->prepare("DELETE FROM caja 
            WHERE codigo_producto = :codigo_producto AND fecha = :fecha_venta");
            $stmtEliminarCaja->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmtEliminarCaja->bindParam(":fecha_venta", $fecha_venta, PDO::PARAM_STR);
            $stmtEliminarCaja->execute();



            // Si llega aquí, ambas operaciones fueron exitosas, entonces confirmar la transacción
            $conn->commit();
            $resultado = "ok";
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "ERROR AL ELIMINAR VENTA: " . $e->getMessage();
        }
        return $resultado;
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