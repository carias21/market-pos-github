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
    
   
}