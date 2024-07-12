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

    public function getUltimasVentas(){
    
        $ultimasVentas = DashboardControlador::ctrGetUltimasVentas();
    
        echo json_encode($ultimasVentas);
    
    }

    public function ajaxFiltrarGraficoBarras($fechaDesde, $fechaHasta){
    
        $filtrarGraficoBarras = DashboardControlador::ctrFiltrarGraficoBarras($fechaDesde, $fechaHasta);
    
        echo json_encode($filtrarGraficoBarras);
    
    }

    public function ajaxCantidadVentas($mes, $anio){
    
        $cantidadVentas = DashboardControlador::ctrCantidadVentas($mes, $anio);
    
        echo json_encode($cantidadVentas);
    
    }

    public function getTopProductoPeriodo(){
    
        $topProductoPeriodo = DashboardControlador::ctrTopProductoPeriodo();
    
        echo json_encode($topProductoPeriodo);
    
    }
    public function getBarraDeProgreso(){
    
        $BarraDeProgreso = DashboardControlador::ctrgetBarraDeProgreso();
    
        echo json_encode($BarraDeProgreso);
    
    }

    public function getMetas(){
    
        $metas = DashboardControlador::ctrgetMetas();
    
        echo json_encode($metas);
    
    }

    public function getRecursosMeta(){
    
        $RecursosMeta = DashboardControlador::ctrRecursosMeta();
    
        echo json_encode($RecursosMeta);
    
    }


    public function ajaxEditarMetas($id, $valorMeta){
    
        $editarMetas = DashboardControlador::ctrEditarMetas($id, $valorMeta);
    
        echo json_encode($editarMetas);
    
    }

    
    public function ajaxSiNoEsUltimoDiaMes($dato){
    
        $siNoEsUltimoDiaMes = DashboardControlador::ctrSiNoEsUltimoDiaMes($dato);
    
        echo json_encode($siNoEsUltimoDiaMes);
    
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

}else if(isset($_POST['accion']) && $_POST['accion'] == 6){ //ObtenerCantidadVentas
    $ultimasVentas = new AjaxDashboard();
    $ultimasVentas->getUltimasVentas();

}else if(isset($_POST['accion']) && $_POST['accion'] == 7){ //Obtener top producto por periodo
    $topProductoPeriodo = new AjaxDashboard();
    $topProductoPeriodo->getTopProductoPeriodo();

}else if(isset($_POST['accion']) && $_POST['accion'] == 8){ //Obtener top producto por periodo
    $BarraDeProgreso = new AjaxDashboard();
    $BarraDeProgreso->getBarraDeProgreso();

}else if(isset($_POST['accion']) && $_POST['accion'] == 9){ //obtener datos metas
    $metas = new AjaxDashboard();
    $metas->getMetas();

}else if(isset($_POST['accion']) && $_POST['accion'] == 10){ //obtener tabla recursos para editar metas
    $RecursosMeta = new AjaxDashboard();
    $RecursosMeta->getRecursosMeta();

}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ //editar metas
    $editarMetas = new AjaxDashboard();
    $editarMetas->ajaxEditarMetas($_POST["id"], $_POST["valorMeta"]);

}else if(isset($_POST['accion']) && $_POST['accion'] == 12){ //HABILITAR O DESHBAILITAR MOSTRAR EXISTENCIAS
    $siNoEsUltimoDiaMes = new AjaxDashboard();
    $siNoEsUltimoDiaMes->ajaxSiNoEsUltimoDiaMes($_POST["dato"]);

}else{
    //tarjetas informativas
    $datos = new AjaxDashboard();
    $datos -> getDatosDashboard();
}