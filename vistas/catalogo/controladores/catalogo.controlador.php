<?php


class CatalogoControlador
{


    static public function ctrListarProductos($codigoProducto){
        $producto = CatalogoModelo::mdlListarProductos($codigoProducto);
       
        return $producto;
    }

    static public function ctrListarNombreProductos(){
        $producto = CatalogoModelo::mdlListarNombreProductos();
       
        return $producto;
    }


}