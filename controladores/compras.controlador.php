<?php


class ComprasControlador
{

    //LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO 
    //VD 15 MIN 27:18
    static public function ctrListarNombreProductos(){
        $producto = ComprasModelo::mdlListarNombreProductos();
       
        return $producto;
    }
    //BUSCAR PRODUCTO POR SU CODIGO DE BARRAS

    static public function ctrGetDatosProducto($codigo_producto){
        $producto = ComprasModelo::mdlGetDatosProducto($codigo_producto);
        return $producto;
    }

    
    static public function ctrVerificaStockProducto($codigo_producto,$cantidad_a_comprar){

        $respuesta = ComprasModelo::mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar);
    
        return $respuesta;
    }

    static public function ctrRegistrarCompra($datos) //REGISTRAR COMPRA
    {
        $productos = ComprasModelo::mdlRegistrarCompra($datos);
        return $productos;
    }


}
