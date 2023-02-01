<?php

class CajaControlador
{
    static public function ctrListarCaja(){
        $ListarCaja = CajaModelo::mdlListarCaja();
        return $ListarCaja;
    }

    static public function ctrIngresoCaja($descripcion, $entrada){
        $IngresoCaja = CajaModelo::mdlIngresoCaja($descripcion, $entrada);
        return $IngresoCaja;
    }

    static public function ctrSalidaCaja($descripcion, $salida){
        $SalidaCaja = CajaModelo::mdlSalidaCaja($descripcion, $salida);
        return $SalidaCaja;
    }
    static public function ctrGetTotal_Caja(){

        $datos = CajaModelo::mdlGetTotal_Caja();

        return $datos;
    }
}
