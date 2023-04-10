<?php
class AdministrarVentasControlador{

    static public function ctrListarVentas($fechaDesde, $fechaHasta, $sel_Usuario, $sel_Tipo_Pago) {

    $ventas = AdministrarVentasModelo::mdlListarVentas($fechaDesde, $fechaHasta, $sel_Usuario, $sel_Tipo_Pago);

        return $ventas;
    }

    static public function ctrEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto, $fecha_venta){
        $respuesta = AdministrarVentasModelo::mdlEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto, $fecha_venta);
        return $respuesta;
    }
    
}