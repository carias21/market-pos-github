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


    static public function ctrListarCategoriaId($id_categoria){
        $producto = CatalogoModelo::mdlListarCategoriaId($id_categoria);
       
        return $producto;
    }


    
    
    static public function ctrListarCategorias(){
        
        $categorias = CatalogoModelo::mdlListarCategorias();

        return $categorias;

    }

    static public function ctrListarNombreProductosSlick(){
        $productosSlick = CatalogoModelo::mdlListarNombreProductosSlick();
       
        return $productosSlick;
    }

    


}