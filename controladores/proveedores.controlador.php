<?php

class ProveedoresControlador{

    static public function ctrListarProveedores(){
        
        $proveedores = ProveedoresModelo::mdlListarProveedores();

        return $proveedores;

    }
    static public function ctrGuardarProveedor($accion, $id_Proveedores, $nombre, 
                                                $direccion, $telefono, $correo,
                                                $tipo_producto, $estado){
        $guardarProveedor = ProveedoresModelo::mdlGuardarProveedor($accion, $id_Proveedores, $nombre, 
                                                                    $direccion, $telefono, $correo,
                                                                    $tipo_producto, $estado);
        return $guardarProveedor;
    }
    static public function ctrEliminarProveedor($tableProveedor, $id_Proveedores, $nameId){
        $respuesta = ProveedoresModelo::mdlEliminarProveedor($tableProveedor, $id_Proveedores, $nameId);
        return $respuesta;
    }
    
}