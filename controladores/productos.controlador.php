<?php


class ProductosControlador
{

    static public function ctrCargaMasivaProductos($fileProductos)
    {

        $respuesta = ProductosModelo::mdlCargaMasivaProductos($fileProductos);

        return $respuesta;
    }

    static public function ctrListarProductos()
    {

        $productos = ProductosModelo::mdlListarProductos();

        return $productos;
    }

    static public function ctrRegistrarProducto($codigo_producto,$id_categoria_producto,$descripcion_producto,$precio_compra_producto,
$precio_venta_producto,$utilidad,$stock_producto,$minimo_stock_producto,$ventas_producto, $name, $img, $tmpname, $destino ) {

        $registroProducto = ProductosModelo::mdlRegistrarProducto(
            $codigo_producto,
            $id_categoria_producto,
            $descripcion_producto,
            $precio_compra_producto,
            $precio_venta_producto,
            $utilidad,
            $stock_producto,
            $minimo_stock_producto,
            $ventas_producto,
            $name,
            $img, $tmpname, $destino 
        );

        return $registroProducto;
    }

    static public function ctrActualizarStock($table, $data, $id, $nameId)
    {

        $respuesta = ProductosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

        return $respuesta;
    }

    static public function ctrActualizarProducto($table, $data, $id, $nameId)
    {

        $respuesta = ProductosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

        return $respuesta;
    }

    static public function ctrEliminarProducto($table, $id, $nameId)
    {
        $respuesta = ProductosModelo::mdlEliminarInformacion($table, $id, $nameId);

        return $respuesta;
    }

    //LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO 
    //VD 15 MIN 27:18
    static public function ctrListarNombreProductos(){
        $producto = ProductosModelo::mdlListarNombreProductos();
       
        return $producto;
    }
    //BUSCAR PRODUCTO POR SU CODIGO DE BARRAS

    static public function ctrGetDatosProducto($codigo_producto){
        $producto = ProductosModelo::mdlGetDatosProducto($codigo_producto);
        return $producto;
    }

    
    static public function ctrVerificaStockProducto($codigo_producto,$cantidad_a_comprar){

        $respuesta = ProductosModelo::mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar);
    
        return $respuesta;
    }

}
