<?php


class ComprasControlador
{

    //LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO 
    //VD 15 MIN 27:18
    static public function ctrListarNombreProductos($id_proveedor){
        $producto = ComprasModelo::mdlListarNombreProductos($id_proveedor);
       
        return $producto;
    }
    //BUSCAR PRODUCTO POR SU CODIGO DE BARRAS

    static public function ctrGetDatosProducto($codigo_producto){
        $producto = ComprasModelo::mdlGetDatosProducto($codigo_producto);
        return $producto;
    }



    static public function ctrRegistrarCompra($datos) //REGISTRAR COMPRA
    {
        $productos = ComprasModelo::mdlRegistrarCompra($datos);
        return $productos;
    }


}
