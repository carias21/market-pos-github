<?php

class VentasControlador
{
    

    static public function ctrRegistrarVenta($datos, $fecha_venta)
    {
        $productos = VentasModelo::mdlRegistrarVenta($datos, $fecha_venta);
        return $productos;
    }

    static public function ctrRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago) {

        $registrarCliente = VentasModelo::mdlRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago);

        return $registrarCliente;
    }

    
}
