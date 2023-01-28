<?php

require_once "../controladores/administrar_compras.controlador.php";
require_once "../modelos/administrar_compras.modelo.php";

class AjaxAdministrarCompras
{


    // VD 21 MIN 13:10
    public function ajaxListarCompras($fechaDesde, $fechaHasta)
    {

        $compras = AdministrarComprasControlador::ctrListarCompras($fechaDesde, $fechaHasta);

        echo json_encode($compras, JSON_UNESCAPED_UNICODE);
    }


    public function ajaxEliminarCompra()
    {
        $tableCompras = "compras";
        $id_compra = $_POST["id_compra"];
        $codigo_producto = $_POST["codigo_producto"];
        $cantidad = $_POST["cantidad"];
        $nameId = "id_compra";
        $respuesta = AdministrarComprasControlador::ctrEliminarCompra($tableCompras, $id_compra, $nameId, $codigo_producto,   $cantidad);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
if (isset($_POST["accion"]) && $_POST["accion"] == 2) { // LISTADO DE compras POR RANGO DE FECHAS

    $compras = new AjaxAdministrarCompras();
    $compras->ajaxListarCompras($_POST["fechaDesde"], $_POST["fechaHasta"]);
    
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) {
    $eliminarCompra = new AjaxAdministrarCompras();
    $eliminarCompra->ajaxEliminarCompra();
}/*else{
$listarVentas = new AjaxAdministrarVentas();
$listarVentas -> ajaxListarVentas($fechaDesde,$fechaHasta);
} */