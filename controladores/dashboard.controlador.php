<?php

class DashboardControlador{

    static public function ctrGetDatosDashboard(){

        $datos = DashboardModelo::mdlGetDatosDashboard();

        return $datos;
    }

    static public function ctrGetVentasMesActual(){

        $ventasMesActual = DashboardModelo::mdlGetVentasMesActual();

        return $ventasMesActual;
    }

    static public function ctrProductosMasVendidos(){
    
        $productosMasVendidos = DashboardModelo::mdlProductosMasVendidos();
    
        return $productosMasVendidos;
    
    }

    static public function ctrProductosPocoStock(){
    
        $productosPocoStock = DashboardModelo::mdlProductosPocoStock();
    
        return $productosPocoStock;
    
    }

    static public function ctrGetUltimasVentas(){
    
        $ultimasVentas = DashboardModelo::mdlGetUltimasVentas();
    
        return $ultimasVentas;
    
    }

    static public function ctrFiltrarGraficoBarras($fechaDesde, $fechaHasta){
    
        $filtrarGraficoBarras = DashboardModelo::mdlFiltrarGraficoBarras($fechaDesde, $fechaHasta);
    
        return $filtrarGraficoBarras;
    
    }

    static public function ctrCantidadVentas($mes, $anio){
    
        $cantidadVentas = DashboardModelo::mdlCantidadVentas($mes, $anio);
    
        return $cantidadVentas;
    
    }

    static public function ctrTopProductoPeriodo(){
    
        $topProductoPeriodo = DashboardModelo::mdlTopProductoPeriodo();
    
        return $topProductoPeriodo;
    
    }

    static public function ctrgetBarraDeProgreso(){
    
        $BarraDeProgreso = DashboardModelo::mdlGetBarraDeProgreso();
    
        return $BarraDeProgreso;
    
    }
    

    
    static public function ctrgetMetas(){
    
        $metas = DashboardModelo::mdlgetMetas();
    
        return $metas;
    
    }
    

     
    static public function ctrRecursosMeta(){
    
        $RecursosMeta = DashboardModelo::mdlRecursosMeta();
    
        return $RecursosMeta;
    
    }


    static public function ctrEditarMetas($id, $valorMeta){
    
        $editarMetas = DashboardModelo::mdlEditarMetas($id, $valorMeta);
    
        return $editarMetas;
    
    }

    
    static public function ctrSiNoEsUltimoDiaMes($dato){
    
        $siNoEsUltimoDiaMes = DashboardModelo::mdlSiNoEsUltimoDiaMes($dato);
    
        return $siNoEsUltimoDiaMes;
    
    }


    

    
    
   
}