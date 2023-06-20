<?php

session_start();

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas
{

  public function ajaxRegistrarVenta($datos)
  {
      date_default_timezone_set('America/Guatemala');
      $fecha_venta = date("Y-m-d H:i:s");
  
      $registroVenta = VentasControlador::ctrRegistrarVenta($datos, $fecha_venta);
      echo json_encode($registroVenta, JSON_UNESCAPED_UNICODE);
  }
  
  //----------------------------------------------------------------------------------------------

}


if (isset($_POST["arr"])) {
  // Ambos están presentes, realizar la lógica deseada aquí
  $arr = $_POST["arr"];

  $registrar = new AjaxVentas();
  $registrar->ajaxRegistrarVenta($_POST["arr"]);
  
  // Resto de la lógica aquí
} else {
  echo "error al obtener el arr de la venta";
}
