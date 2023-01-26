<?php

require_once "conexion.php";

class ReportesModelo{

   
    static public function  mdlCantidadVentasProductos(){
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
         $stmt = Conexion::conectar()->prepare('call prc_ListadoProductosVendidos');
     
         $stmt->execute();
     
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

     static public function  mdlTotalVentasMesAño(){
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
         $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesesPorAño');
     
         $stmt->execute();
     
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

     static public function mdlVentasPorCategoria(){
    
        $stmt = Conexion::conectar()->prepare('call prc_top_ventas_categorias');
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}