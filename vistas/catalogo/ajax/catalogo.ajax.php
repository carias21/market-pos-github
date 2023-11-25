<?php

require_once "../controladores/catalogo.controlador.php";
require_once "../modelos/catalogo.modelo.php";


class ajaxCatalogo
{

    public function ajaxListarProductos()
    {
   $NombreProductos = CatalogoControlador::ctrListarNombreProductos();
        echo json_encode($NombreProductos);
    }

}




if (isset($_POST['accion']) && $_POST['accion'] == 1) { //parametro para listar los productos

    $productos = new ajaxCatalogo();
    $productos->ajaxListarProductos();
} 