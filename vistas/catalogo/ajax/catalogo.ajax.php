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

    public function ajaxListarCategorias(){

        $categorias = CatalogoControlador::ctrListarCategorias();

        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxListarProductosSlick()
    {
        $productosSlick = CatalogoControlador::ctrListarNombreProductosSlick();
        echo json_encode($productosSlick);
    }
}




if (isset($_POST['accion']) && $_POST['accion'] == 1) { //parametro para listar los productos

    $productos = new ajaxCatalogo();
    $productos->ajaxListarProductos();
}elseif (isset($_POST['accion']) && $_POST['accion'] == 50) { //parametro para listar los productos

    $productosSlick = new ajaxCatalogo();
    $productosSlick->ajaxListarProductosSlick();
}  else {

    $categorias = new ajaxCatalogo();
    $categorias->ajaxListarCategorias();
}
