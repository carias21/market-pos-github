<?php

class VentasControlador
{
    

    static public function ctrRegistrarVenta($datos, $fecha_venta,  $usuario)
    {
        $productos = VentasModelo::mdlRegistrarVenta($datos, $fecha_venta,  $usuario);
        return $productos;
    }


    
}
