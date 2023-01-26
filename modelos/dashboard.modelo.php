<?php

require_once "conexion.php";

class DashboardModelo{

    static public function mdlGetDatosDashboard(){

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerDatosDashboard()');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);

       
    }

    static public function mdlGetVentasMesActual(){

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesActual');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlProductosMasVendidos(){
    //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosMasVendidos()');
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlProductosPocoStock(){
       //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosPocoStock');
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}