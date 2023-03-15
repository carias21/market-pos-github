<?php

require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";

require_once "../vendor/autoload.php";

class AjaxCompras
{


    public $codigo_producto;
    public $cantidad_a_comprar;

    /*LISTAR EL NOMBRE DE PRODUCTOS PARA EL INPUT DE AUTO COMPLETADO ----- */
    //VD 15 MIN 26:35
    public function ajaxListarNombreProductos()
    {
        $NombreProductos = ComprasControlador::ctrListarNombreProductos();
        echo json_encode($NombreProductos);
    }
    //BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    public function ajaxGetDatosProducto()
    {
        $producto = ComprasControlador::ctrGetDatosProducto($this->codigo_producto);
        echo json_encode($producto);
    }


    public function ajaxRegistrarCompra($datos)//REGISTRAR COMPRA
    {

        $registroCompra = ComprasControlador::ctrRegistrarCompra($datos);
        echo json_encode($registroCompra, JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_POST["accion"]) && $_POST["accion"] == 6) { //traer listado de productos para el autocompletable del input
    $nombreProductos = new AjaxCompras();
    $nombreProductos->ajaxListarNombreProductos();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 7) {
    $listaProducto = new AjaxCompras();
    $listaProducto->codigo_producto = $_POST["codigo_producto"];
    $listaProducto->ajaxGetDatosProducto();
} else { //REGISTRAR COMPRA

    if ((isset($_POST["arr"]))) {

        $registrar = new AjaxCompras();
        $registrar->ajaxRegistrarCompra($_POST["arr"]);
    }
}
