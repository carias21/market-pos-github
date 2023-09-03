<?php

require_once "../controladores/gastos.controlador.php";
require_once "../modelos/gastos.modelo.php";


class AjaxGastos
{

    public $idCategoriaGasto;
    public $iptCategoriaGasto;

    public $selCategoriaModal;
    public $iptDescripcionModal;
    public $iptMontoModal;

    public function  ajaxListarCategoriaGastos()
    {
        $ListarCategoriaGastos = GastosControlador::ctrListarCategoriaGastos();

        echo json_encode($ListarCategoriaGastos, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxGuardarCategoriaGasto($accion)
    {
        $guardarCategoriasGasto = GastosControlador::ctrGuardarCategoriaGasto($accion, $this->idCategoriaGasto, $this->iptCategoriaGasto);
        echo json_encode($guardarCategoriasGasto, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxGuardarGastoOp()
    {
        $guardarGastoOp = GastosControlador::ctrGuardarGastoOp($this->selCategoriaModal, $this->iptDescripcionModal, $this->iptMontoModal);
        echo json_encode($guardarGastoOp, JSON_UNESCAPED_UNICODE);
    }


    public function ajaxEliminarCategoriaGasto()
    { //ELIMINAR CATEGORIA GASTO
        $tableTipoGastos = "tipo_gasto";
        $id_Categoria_Gasto = $_POST["id_tipo_gasto"];
        $nameId = "id_tipo_gasto";

        $eliminarCategoriaGasto = GastosControlador::ctrEliminarCategoriaGasto($tableTipoGastos, $id_Categoria_Gasto, $nameId);
        echo json_encode($eliminarCategoriaGasto, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxEliminarGastoOp()
    { //ELIMINAR GASTO OPERATIVO
        $tableGastosOp = "gastos_operativos";
        $id_gasto_op = $_POST["id_gasto"];
        $nameId = "id_gasto";

        $eliminarGastoOp = GastosControlador::ctrEliminarGastoOp($tableGastosOp, $id_gasto_op, $nameId);
        echo json_encode($eliminarGastoOp, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxListarGastosOp()
    {
        $ListarGastosOp = GastosControlador::ctrListarGastosOp();
        echo json_encode($ListarGastosOp);
    }

    public function ajaxListarGastosPorFecha($gastosDesde, $gastosHasta)
    {
        $ListarGastosPorFecha = GastosControlador::ctrListarGastosPorFecha($gastosDesde, $gastosHasta);

        echo json_encode($ListarGastosPorFecha, JSON_UNESCAPED_UNICODE);
    }
}

//si es mayor a 0 procede a realizar una edicion
if (isset($_POST['idCategoriaGasto']) && $_POST['idCategoriaGasto'] > 0) { //Editar

    $editarCategoriaGasto = new AjaxGastos();
    $editarCategoriaGasto->idCategoriaGasto = $_POST['idCategoriaGasto'];
    $editarCategoriaGasto->iptCategoriaGasto = $_POST['categoriaGasto'];
    $editarCategoriaGasto->ajaxGuardarCategoriaGasto(0);
    //Accion 5, eliminacion
} else if (isset($_POST['accion']) && $_POST['accion'] == 1) { //ELIMINAR CATEGORIA GASTO
    $eliminarCategoriaGasto = new AjaxGastos();
    $eliminarCategoriaGasto->ajaxEliminarCategoriaGasto();
    //cuando el valor es igual a 0 registra
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { //ELIMINAR GASTO OPERACIONAL
    $eliminarGastoOp = new AjaxGastos();
    $eliminarGastoOp->ajaxEliminarGastoOp();
    //cuando el valor es igual a 0 registra
} else if (isset($_POST['idCategoriaGasto']) && $_POST['idCategoriaGasto'] == 0) { //REGISTRAR CATEGORIA GASTO
    $registrarCategoriaGasto = new AjaxGastos();
    $registrarCategoriaGasto->idCategoriaGasto = $_POST['idCategoriaGasto'];
    $registrarCategoriaGasto->iptCategoriaGasto = $_POST['categoriaGasto'];
    $registrarCategoriaGasto->ajaxGuardarCategoriaGasto(1);
} else if (isset($_POST['accion']) && $_POST['accion'] == 5) { //REGISTRAR GASTO OPERATIVO
    $registrarGastoOp = new AjaxGastos();
    $registrarGastoOp->selCategoriaModal = $_POST['selCategoriaModal'];
    $registrarGastoOp->iptDescripcionModal = $_POST['iptDescripcionModal'];
    $registrarGastoOp->iptMontoModal = $_POST['iptMontoModal'];
    $registrarGastoOp->ajaxGuardarGastoOp();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 2) { //LISTAR GASTOS OPERATIVOS
    $ListarGastosOp = new AjaxGastos();
    $ListarGastosOp->ajaxListarGastosOp();
}else if (isset($_POST["accion"]) && $_POST["accion"] == 6) { // LISTADO DE VENTAS POR RANGO DE FECHAS
    $ListarGastosPorFecha = new AjaxGastos();
    $ListarGastosPorFecha->ajaxListarGastosPorFecha($_POST["gastosDesde"], $_POST["gastosHasta"]);
} else {
    $ListarCategoriaGastos = new AjaxGastos();
    $ListarCategoriaGastos->ajaxListarCategoriaGastos();
}
