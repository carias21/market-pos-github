<?php

session_start();

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas
{

  public $cantidad;
  public $precio_venta;
  public $descuento;
  public $total;
  public $precio_compra;
  public $id_tipo_pago;


  public function ajaxRegistrarVenta($datos)
  {
    date_default_timezone_set('America/Guatemala');
    $fecha_venta = date("Y-m-d H:i:s");

    $registroVenta = VentasControlador::ctrRegistrarVenta($datos, $fecha_venta);
    echo json_encode($registroVenta, JSON_UNESCAPED_UNICODE);
  }



  public function ajaxRegistrarVenta0()
  {
    $registrarVenta0 = VentasControlador::ctrRegistrarVenta0(

      $this->cantidad,
      $this->precio_venta,
      $this->descuento,
      $this->total,
      $this->precio_compra,
      $this->id_tipo_pago
    );

    echo json_encode($registrarVenta0);
  }

  //----------------------------------------------------------------------------------------------

}


if (isset($_POST["arr"])) {
  // Ambos están presentes, realizar la lógica deseada aquí
  $arr = $_POST["arr"];

  $registrar = new AjaxVentas();
  $registrar->ajaxRegistrarVenta($_POST["arr"]);

  // Resto de la lógica aquí
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) {
  $registrarVenta0 = new AjaxVentas();
  $registrarVenta0->cantidad = $_POST["cantidad"];
  $registrarVenta0->precio_venta = $_POST["precio_venta"];
  $registrarVenta0->descuento = $_POST["descuento"];
  $registrarVenta0->total = $_POST["total"];
  $registrarVenta0->precio_compra = $_POST["precio_compra"];
  $registrarVenta0->id_tipo_pago = $_POST["id_tipo_pago"];
  $registrarVenta0->ajaxRegistrarVenta0();
} else {
  echo "error al obtener el arr de la venta";
}
