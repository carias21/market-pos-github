<?php
class AdministrarComprasControlador{

    static public function ctrListarCompras($compras_desde, $compras_hasta, $idProveedor) {

    $compras = AdministrarComprasModelo::mdlListarCompras($compras_desde, $compras_hasta, $idProveedor);

        return $compras;
    }

    static public function ctrEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto, $cantidad){
        $respuesta = AdministrarComprasModelo::mdlEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto, $cantidad);
        return $respuesta;
    }
    
}