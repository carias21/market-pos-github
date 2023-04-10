<?php

class VentasControlador
{
    

    static public function ctrRegistrarVenta($datos, $fecha_venta)
    {
        $productos = VentasModelo::mdlRegistrarVenta($datos, $fecha_venta);
        return $productos;
    }


    
}
