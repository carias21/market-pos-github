<?php
class VentasControlador
{

    static public function ctrRegistrarVenta($datos)
    {
        $productos = VentasModelo::mdlRegistrarVenta($datos);
        return $productos;
    }


    
}
