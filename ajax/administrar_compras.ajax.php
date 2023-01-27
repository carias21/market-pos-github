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


    public function ajaxEliminarVenta()
    {
        $tableVentas = "compras";
        $id_venta = $_POST["id_venta"];
        $nameId = "id_venta";
        $respuesta = AdministrarVentasControlador::ctrEliminarVenta($tableVentas, $id_venta, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}
if (isset($_POST["accion"]) && $_POST["accion"] == 2) { // LISTADO DE compras POR RANGO DE FECHAS

    $compras = new AjaxAdministrarCompras();
    $compras->ajaxListarCompras($_POST["fechaDesde"], $_POST["fechaHasta"]);
    
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) {
    $eliminarCompra = new AjaxAdministrarCompras();
    $eliminarCompra->ajaxEliminarVenta();
}/*else{
$listarVentas = new AjaxAdministrarVentas();
$listarVentas -> ajaxListarVentas($fechaDesde,$fechaHasta);
} */