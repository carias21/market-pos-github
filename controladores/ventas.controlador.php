<?php

class VentasControlador
{


    static public function ctrRegistrarVenta($datos)
    {
        $productos = VentasModelo::mdlRegistrarVenta($datos);
        return $productos;
    }

    static public function ctrRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago)
    {

        $registrarCliente = VentasModelo::mdlRegistrarVenta0($cantidad, $precio_venta, $descuento, $total, $precio_compra, $id_tipo_pago);

        return $registrarCliente;
    }

    static public function ctrObtenerDetalleVenta($fecha_venta)
    {
        $detalle_venta = VentasModelo::mdlObtenerDetalleVenta($fecha_venta);
        return $detalle_venta;
    }
}
