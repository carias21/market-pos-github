<?php

require_once "conexion.php";

class ReportesModelo{

   
    static public function  mdlCantidadVentasProductos(){
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
         $stmt = Conexion::conectar()->prepare('call prc_ListadoProductosVendidos');
     
         $stmt->execute();
     
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

     static public function  mdlTotalVentasMesA├▒o(){
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
         $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesesPorA├▒o');
     
         $stmt->execute();
     
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

}