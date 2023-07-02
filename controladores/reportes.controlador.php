<?php

class ReportesControlador
{


    static public function ctrCantidadVentasProductos()
    {

        $CantidadVentasProductos = ReportesModelo::mdlCantidadVentasProductos();

        return $CantidadVentasProductos;
    }


    static public function ctrTotalVentasMesAño()
    {

        $TotalVentasMesAño = ReportesModelo::mdlTotalVentasMesAño();

        return $TotalVentasMesAño;
    }

    static public function ctrVentasPorCategoria()
    {
        $ventasPorCategorias = ReportesModelo::mdlVentasPorCategoria();

        return $ventasPorCategorias;
    }

    static public function ctrGananciaNeta()
    {
        $GananciaNeta = ReportesModelo::mdlGananciaNeta();

        return $GananciaNeta;
    }

    static public function ctrGananciaBruta()
    {
        $GananciaNeta = ReportesModelo::mdlGananciaBruta();

        return $GananciaNeta;
    }

    static public function ctrVentas_Por_Usuario()
    {
        $Ventas_Por_Usuario = ReportesModelo::mdlVentas_Por_Usuario();

        return $Ventas_Por_Usuario;
    }

    static public function ctrFiltrar_Ventas_Mes($sel_Mes)
    {
        $Filtrar_Ventas_Mes = ReportesModelo::mdlFiltrar_Ventas_Mes($sel_Mes);

        return $Filtrar_Ventas_Mes;
    }

    static public function ctrFiltrar_Promedios($sel_Promedio, $fechaDesde, $fechaHasta)
    {
        $Filtrar_Promedios = ReportesModelo::mdlFiltrar_Promedios($sel_Promedio, $fechaDesde, $fechaHasta);

        return $Filtrar_Promedios;
    }
}
