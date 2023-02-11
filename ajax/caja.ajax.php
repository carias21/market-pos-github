<?php

require_once "../controladores/caja.controlador.php";
require_once "../modelos/caja.modelo.php";

class AjaxCaja
{

    public $descripcion;
    public $entrada;
    public $salida;
    public $id_caja;


    public function ajaxListarCaja()
    {
        $ListarCaja = CajaControlador::ctrListarCaja();
        echo json_encode($ListarCaja);
    }

    public function ajaxIngresoCaja()
    {
        $descripcion = $_POST["descripcion"];
        $entrada = $_POST["entrada"];
        $IngresoCaja = CajaControlador::ctrIngresoCaja($descripcion, $entrada);
        echo json_encode($IngresoCaja);
    }

    public function ajaxSalidaCaja()
    {
        $descripcion = $_POST["descripcion"];
        $salida = $_POST["salida"];
        $SalidaCaja = CajaControlador::ctrSalidaCaja($descripcion, $salida);
        echo json_encode($SalidaCaja);
    }
    public function getTotal_Caja(){

        $datos = CajaControlador::ctrGetTotal_Caja();

        echo json_encode($datos);
    }
    public function ajaxEliminarCaja(){

        $tbl_Caja = "caja";
        $id_Caja = $_POST["id_caja"];
         $nameId = "id_caja";
        $respuesta = CajaControlador::ctrEliminarCaja($tbl_Caja, $id_Caja, $nameId );

        echo json_encode($respuesta);
    }
}




if (isset($_POST['accion']) && $_POST['accion'] == 2) {
    $ListarCaja = new AjaxCaja;
    $ListarCaja->ajaxListarCaja();
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { //parametro para ingreso de caja

    $IngresoCaja = new AjaxCaja();

    $IngresoCaja->descripcion = $_POST["descripcion"];
    $IngresoCaja->entrada = $_POST["entrada"];

    $IngresoCaja->ajaxIngresoCaja();
} else if (isset($_POST['accion']) && $_POST['accion'] == 4) { //parametro para salida de caja

    $SalidaCaja = new AjaxCaja();

    $SalidaCaja->descripcion = $_POST["descripcion"];
    $SalidaCaja->salida = $_POST["salida"];

    $SalidaCaja->ajaxSalidaCaja();
}else if (isset($_POST['accion']) && $_POST['accion'] == 5) { //parametro para eliminar registro caja

    $EliminarCaja = new AjaxCaja();
    $EliminarCaja->id_caja = $_POST["id_caja"];
    $EliminarCaja->ajaxEliminarCaja();

} else {
    $datos = new AjaxCaja();
    $datos->getTotal_Caja();
}
