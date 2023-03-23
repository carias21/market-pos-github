<?php

session_start();

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas
{

  public function ajaxRegistrarVenta($datos)
  {
    //obtener usuario que realizo venta
    $usuario = $_SESSION["usuario1"]->usuario;
 
    date_default_timezone_set('America/Guatemala');
    $fecha_venta = date("Y-m-d H:i:s");
    
    $registroVenta = VentasControlador::ctrRegistrarVenta($datos,  $fecha_venta, $usuario);
    echo json_encode($registroVenta, JSON_UNESCAPED_UNICODE);
  }
//----------------------------------------------------------------------------------------------

}


  if ((isset($_POST["arr"]))) {//REGISTRAR VENTA

    $registrar = new AjaxVentas();
    $registrar->ajaxRegistrarVenta($_POST["arr"]);
   //   echo json_encode($_POST["arr"]);
  }


