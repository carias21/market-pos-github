<?php
class AdministrarComprasControlador{

    static public function ctrListarCompras($fechaDesde, $fechaHasta) {

    $compras = AdministrarComprasModelo::mdlListarCompras($fechaDesde, $fechaHasta);

        return $compras;
    }

    static public function ctrEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto, $cantidad){
        $respuesta = AdministrarComprasModelo::mdlEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto, $cantidad);
        return $respuesta;
    }
    
}