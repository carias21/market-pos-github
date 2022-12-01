<?php

class ReportesControlador{


    static public function ctrCantidadVentasProductos(){
    
        $CantidadVentasProductos = ReportesModelo::mdlCantidadVentasProductos();
    
        return $CantidadVentasProductos;
    
    }

    
    static public function ctrTotalVentasMesAño(){
    
        $TotalVentasMesAño = ReportesModelo::mdlTotalVentasMesAño();
    
        return $TotalVentasMesAño;
    
    }



   
}