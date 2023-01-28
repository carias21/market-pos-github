<?php

require_once "../controladores/administrar_ventas.controlador.php";
require_once "../modelos/administrar_ventas.modelo.php";

class AjaxAdministrarVentas
{
    

 // VD 21 MIN 13:10
public function ajaxListarVentas($fechaDesde,$fechaHasta){

$ventas = AdministrarVentasControlador::ctrListarVentas($fechaDesde,$fechaHasta);

echo json_encode($ventas, JSON_UNESCAPED_UNICODE);
    }


    public function ajaxEliminarVenta(){
        $tableVentas = "ventas";
        $id_venta = $_POST["id_venta"];
        $codigo_producto = $_POST["codigo_producto"];
        $cantidad = $_POST["cantidad"];
        $nameId = "id_venta";
        $respuesta = AdministrarVentasControlador::ctrEliminarVenta($tableVentas, $id_venta, $nameId, $cantidad, $codigo_producto);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }

}
if (isset($_POST["accion"]) && $_POST["accion"] == 2) { // LISTADO DE VENTAS POR RANGO DE FECHAS

    $ventas = new AjaxAdministrarVentas();
    $ventas->ajaxListarVentas($_POST["fechaDesde"], $_POST["fechaHasta"]);

}else if(isset($_POST['accion'])&& $_POST['accion'] == 3){
    $eliminarVenta = new AjaxAdministrarVentas();
    $eliminarVenta -> ajaxEliminarVenta();
  
}/*else{
$listarVentas = new AjaxAdministrarVentas();
$listarVentas -> ajaxListarVentas($fechaDesde,$fechaHasta);
} */