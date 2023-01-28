<?php
class AdministrarVentasControlador{

    static public function ctrListarVentas($fechaDesde, $fechaHasta) {

    $ventas = AdministrarVentasModelo::mdlListarVentas($fechaDesde, $fechaHasta);

        return $ventas;
    }

    static public function ctrEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto){
        $respuesta = AdministrarVentasModelo::mdlEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto);
        return $respuesta;
    }
    
}