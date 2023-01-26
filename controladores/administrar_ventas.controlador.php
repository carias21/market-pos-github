<?php
class AdministrarVentasControlador{

    static public function ctrListarVentas($fechaDesde, $fechaHasta) {

    $ventas = AdministrarVentasModelo::mdlListarVentas($fechaDesde, $fechaHasta);

        return $ventas;
    }

    static public function ctrEliminarVenta($tableVentas, $id_venta, $nameId){
        $respuesta = AdministrarVentasModelo::mdlEliminarVenta($tableVentas, $id_venta, $nameId);
        return $respuesta;
    }
    
}