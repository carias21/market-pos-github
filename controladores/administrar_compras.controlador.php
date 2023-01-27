<?php
class AdministrarComprasControlador{

    static public function ctrListarCompras($fechaDesde, $fechaHasta) {

    $compras = AdministrarComprasModelo::mdlListarCompras($fechaDesde, $fechaHasta);

        return $compras;
    }

    static public function ctrEliminarCompra($tableCompras, $id_venta, $nameId){
        $respuesta = AdministrarVentasModelo::mdlEliminarCompra($tableCompras, $id_venta, $nameId);
        return $respuesta;
    }
    
}