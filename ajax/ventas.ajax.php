<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas
{


  public function ajaxRegistrarVenta($datos)
  {

    $registroVenta = VentasControlador::ctrRegistrarVenta($datos);
    echo json_encode($registroVenta, JSON_UNESCAPED_UNICODE);
  }
//----------------------------------------------------------------------------------------------

}


  if ((isset($_POST["arr"]))) {//REGISTRAR VENTA

    $registrar = new AjaxVentas();
    $registrar->ajaxRegistrarVenta($_POST["arr"]);
   //   echo json_encode($_POST["arr"]);
  }


