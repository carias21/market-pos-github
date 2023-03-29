<?php

require_once "../controladores/reportes.controlador.php";
require_once "../modelos/reportes.modelo.php";

class AjaxReportes
{

    public function getCantidadVentasProductos()
    {

        $CantidadventasProductos = ReportesControlador::ctrCantidadVentasProductos(); //prc_ListarProductosMasVendidos

        echo json_encode($CantidadventasProductos);
    }

    public function getTotalVentasMesAño() //prc_top_ventas_categorias
    {

        $TotalVentasMesAño = ReportesControlador::ctrTotalVentasMesAño();

        echo json_encode($TotalVentasMesAño);
    }
    public function getVentasPorCategorias()
    {
        $ventasPorCategorias = ReportesControlador::ctrVentasPorCategoria(); //prc_ObtenerVentasMesesPorAño

        echo json_encode($ventasPorCategorias, JSON_NUMERIC_CHECK);
    }
    public function getGananciaNeta()
    {
        $GananciaNeta= ReportesControlador::ctrGananciaNeta(); //prc_TotalGananciaNeta


        echo json_encode($GananciaNeta);
        
    }

    public function getGananciaBruta()
    {
        $GananciaBruta= ReportesControlador::ctrGananciaBruta(); //prc_TotalGananciaNeta


        echo json_encode($GananciaBruta);
        
    }
}


if (isset($_POST['accion']) && $_POST['accion'] == 4) { //Ejecutar function cantidad productos  vendidos prc_ListarProductosMasVendidos (Grafico de Barras)
    $CantidadventasProductos = new AjaxReportes();
    $CantidadventasProductos->getCantidadVentasProductos();
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { //Ejecutar function de grafico de doughnut prc_top_ventas_categorias	
    $ventasPorCategorias = new AjaxReportes();
    $ventasPorCategorias->getVentasPorCategorias();
} else if (isset($_POST['accion']) && $_POST['accion'] == 1) { //Ejecutar function prc_ObtenerVentasMesesPorAño	(Grafico de Barras)
    $TotalVentasMesAño = new AjaxReportes();
    $TotalVentasMesAño->getTotalVentasMesAño();
}else if (isset($_POST['accion']) && $_POST['accion'] == 5) { //Ejecutar function prc_TotalVentasComprasCaja VENTAS, COMPRAS, GANANCIA
    $GananciaNeta = new AjaxReportes();
    $GananciaNeta->getGananciaNeta();
}else if(isset($_POST['accion'])&& $_POST['accion'] == 6){
    $GananciaBruta = new AjaxReportes();
    $GananciaBruta->getGananciaBruta();
}
