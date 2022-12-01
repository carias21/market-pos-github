<?php

require_once "../controladores/reportes.controlador.php";
require_once "../modelos/reportes.modelo.php";

class AjaxReportes
{

    public function getCantidadVentasProductos()
    {

        $CantidadventasProductos = ReportesControlador::ctrCantidadVentasProductos();

        echo json_encode($CantidadventasProductos);
    }

    public function getTotalVentasMesAño()
    {

        $TotalVentasMesAño = ReportesControlador::ctrTotalVentasMesAño();

        echo json_encode($TotalVentasMesAño);
    }
}


if (isset($_POST['accion']) && $_POST['accion'] == 4) { //Ejecutar function  productos  vendidos (Grafico de Barras)


    $CantidadventasProductos = new AjaxReportes();
    $CantidadventasProductos->getCantidadVentasProductos();
}else if (isset($_POST['accion']) && $_POST['accion'] == 1) { //Ejecutar function  productos  vendidos (Grafico de Barras)


    $TotalVentasMesAño = new AjaxReportes();
    $TotalVentasMesAño->getTotalVentasMesAño();
}
