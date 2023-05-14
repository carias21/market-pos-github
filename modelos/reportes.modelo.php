<?php

require_once "conexion.php";

class ReportesModelo
{


    static public function  mdlCantidadVentasProductos()
    {
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ListadoProductosVendidos');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function  mdlTotalVentasMesAño()
    {
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesesPorAño');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlVentasPorCategoria()
    {

        $stmt = Conexion::conectar()->prepare('call prc_top_ventas_categorias');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlGananciaNeta()
    {

        $stmt = Conexion::conectar()->prepare('call prc_GananciaNeta');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlGananciaBruta()
    {

        $stmt = Conexion::conectar()->prepare('call prc_GananciaBruta');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlVentas_Por_Usuario()
    {

        $stmt = Conexion::conectar()->prepare('call prc_total_ventas_usuarios');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlFiltrar_Ventas_Mes($sel_Mes)
    {

        $stmt = Conexion::conectar()->prepare('SELECT vc.fecha_venta,
                                                SUM(ROUND(vc.total_venta, 2)) AS total_venta
                                                FROM ventas vc
                                                WHERE MONTH(vc.fecha_venta) = :sel_Mes
                                                AND DATE(vc.fecha_venta) <= LAST_DAY(DATE(CURRENT_DATE))
                                                GROUP BY DATE(vc.fecha_venta)');
        $stmt->bindParam(":sel_Mes", $sel_Mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
