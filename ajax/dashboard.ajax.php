<?php

require_once "../controladores/dashboard.controlador.php";
require_once "../modelos/dashboard.modelo.php";

class AjaxDashboard{

    public function getDatosDashboard(){

        $datos = DashboardControlador::ctrGetDatosDashboard();

        echo json_encode($datos);
    }

    public function getVentasMesActual(){
        $ventasMesActual = DashboardControlador::ctrGetVentasMesActual();
        echo json_encode($ventasMesActual);
    }
    
    public function getProductosMasVendidos(){
    
        $productosMasVendidos = DashboardControlador::ctrProductosMasVendidos();
    
        echo json_encode($productosMasVendidos);
    
    }
    public function getProductosPocoStock(){
    
        $productosPocoStock = DashboardControlador::ctrProductosPocoStock();
    
        echo json_encode($productosPocoStock);
    
    }

    public function ajaxFiltrarGraficoBarras($fechaDesde, $fechaHasta){
    
        $filtrarGraficoBarras = DashboardControlador::ctrFiltrarGraficoBarras($fechaDesde, $fechaHasta);
    
        echo json_encode($filtrarGraficoBarras);
    
    }

    public function ajaxCantidadVentas($mes, $anio){
    
        $cantidadVentas = DashboardControlador::ctrCantidadVentas($mes, $anio);
    
        echo json_encode($cantidadVentas);
    
    }
}


if(isset($_POST['accion']) && $_POST['accion'] == 1){ //Ejecutar function ventas del mes (Grafico de Barras)

    $ventasMesActual = new AjaxDashboard();
    $ventasMesActual -> getVentasMesActual();

}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ //Ejecutar function de productos mas vendidos

    $produtosMasVendidos = new AjaxDashboard();
    $produtosMasVendidos -> getProductosMasVendidos();

}else if(isset($_POST['accion']) && $_POST['accion'] == 3){ //Ejecutar function de productos poco stock


    $productosPocoStock = new AjaxDashboard();
    $productosPocoStock -> getProductosPocoStock();

}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ //FILTRAR VENTAS POR FECHAS
    $filtrarGraficoBarras = new AjaxDashboard();
    $filtrarGraficoBarras->ajaxFiltrarGraficoBarras($_POST["fechaDesde"], $_POST["fechaHasta"]);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){ //ObtenerCantidadVentas
    $cantidadVentas = new AjaxDashboard();
    $cantidadVentas->ajaxCantidadVentas($_POST["mes"], $_POST["anio"]);

}else{
    //tarjetas informativas
    $datos = new AjaxDashboard();
    $datos -> getDatosDashboard();
}