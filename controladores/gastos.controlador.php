<?php

class GastosControlador
{

    static public function ctrListarCategoriaGastos()
    {

        $ListarCategoriaGastos = GastosModelo::mdlListarCategoriaGastos();

        return $ListarCategoriaGastos;
    }

    static public function ctrGuardarCategoriaGasto($accion, $idCategoriaGasto, $iptCategoriaGasto)
    {
        $guardarCategoriasGasto = GastosModelo::mdlGuardarCategoriaGasto($accion, $idCategoriaGasto, $iptCategoriaGasto);
        return $guardarCategoriasGasto;
    }



    static public function ctrGuardarGastoOp($selCategoriaModal, $iptDescripcionModal, $iptMontoModal)
    {
        $guardarGastoOp = GastosModelo::mdlGuardarGastoOp($selCategoriaModal, $iptDescripcionModal, $iptMontoModal);
        return $guardarGastoOp;
    }


    static public function ctrEliminarCategoriaGasto($tableTipoGastos, $id_Categoria_Gasto, $nameId)
    { //ELIMINAR CATEGORIA GASTO
        $respuesta = GastosModelo::mdlEliminarCategoriaGasto($tableTipoGastos, $id_Categoria_Gasto, $nameId);
        return $respuesta;
    }

    static public function ctrEliminarGastoOp($tableGastosOp, $id_gasto_op, $nameId)
    { //ELIMINAR GASTOS OPERATIVOS
        $respuesta = GastosModelo::mdlEliminarGastoOp($tableGastosOp, $id_gasto_op, $nameId);
        return $respuesta;
    }

    static public function ctrListarGastosOp()
    {
        $ListarGastosOp = GastosModelo::mdlListarGastosOp();

        return $ListarGastosOp;
    }

    static public function ctrListarGastosPorFecha($gastosDesde, $gastosHasta)
    {

        $ListarGastosPorFecha = GastosModelo::mdlListarGastosPorFecha($gastosDesde, $gastosHasta);

        return $ListarGastosPorFecha;
    }
}
