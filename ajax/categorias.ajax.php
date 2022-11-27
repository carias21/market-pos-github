<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{
    public $idCategoria;
    public $categoria;
    public $medida;

    

    public function ajaxListarCategorias(){

        $categorias = CategoriasControlador::ctrListarCategorias();

        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxGuardarCategoria($accion){
        $guardarCategorias = CategoriasControlador::ctrGuardarCategoria($accion, $this->idCategoria, $this->categoria, $this->medida);
        echo json_encode($guardarCategorias, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxEliminarCategoria(){
        $tableCategorias = "categorias";
        $id_categoria= $_POST["id_categoria"];
        $nameId = "id_categoria";
        $respuesta = CategoriasControlador::ctrEliminarCategoria($tableCategorias, $id_categoria, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}

//si es mayor a 0 procede a realizar una edicion
if(isset($_POST['idCategoria'])&& $_POST['idCategoria'] > 0){//Editar

    $editarCategoria = new AjaxCategorias();
    $editarCategoria->idCategoria = $_POST['idCategoria'];
    $editarCategoria->categoria = $_POST['categoria'];
    $editarCategoria->medida = $_POST['medida'];
    $editarCategoria->ajaxGuardarCategoria(0);
//Accion 5, eliminacion
}else if(isset($_POST['accion'])&& $_POST['accion']==5){//ELIMINAR
    $eliminarCategoria = new AjaxCategorias();
    $eliminarCategoria -> ajaxEliminarCategoria();
//cuando el valor es igual a 0 registra
}else if(isset($_POST['idCategoria'])&& $_POST['idCategoria']==0){//REGISTRAR
    $registrarCategoria = new AjaxCategorias();
    $registrarCategoria->idCategoria = $_POST['idCategoria'];
    $registrarCategoria->categoria = $_POST['categoria'];
    $registrarCategoria->medida = $_POST['medida'];
    $registrarCategoria->ajaxGuardarCategoria(1);
}else{

$categorias = new AjaxCategorias();
$categorias -> ajaxListarCategorias();
}