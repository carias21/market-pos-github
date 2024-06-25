<?php

require_once "../controladores/catalogo.controlador.php";
require_once "../modelos/catalogo.modelo.php";

class AjaxCatalogo
{

    public $img;
    public  $descripcionSlider;


    public function ajaxObtenerCatalogo()
    {
        $catalogo = CatalogoControlador::ctrObtenerCatalogo();
        echo json_encode($catalogo);
    }


    public function ajaxRegistrarSlider()
    {
        $img = $_FILES['imagen'];
        $name = $img['name'];

        $destino = $_SERVER['DOCUMENT_ROOT'] . '/market-pos-github/vistas/assets/imagenes/slider/' . $name;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        if (empty($name)) {
            $name = "default.png";
        }
        $registrarSlider = CatalogoControlador::ctrRegistrarSlider($name,$this->descripcionSlider );
        echo json_encode($registrarSlider);
    }


    
    public function ajaxEliminarSlider(){
        $tableCatalogo = "catalogo";
        $id_slider= $_POST["id_slider"];
        $nameId = "id";
        $respuesta = CatalogoControlador::ctrEliminarSlider($tableCatalogo, $id_slider, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxMostrarOcultarPrecio($dato){
    
        $mostrarOcultarPrecio = CatalogoControlador::ctrMostrarOcultarPrecio($dato);
    
        echo json_encode($mostrarOcultarPrecio);
    
    }

    
    public function ajaxMostrarOcultareExistencia($dato){
    
        $mostrarOcultarExistencia = CatalogoControlador::ctrMostrarOcultareExistencia($dato);
    
        echo json_encode($mostrarOcultarExistencia);
    
    }

    

    public function ajaxVerificarEstadoPrecioExistencia(){
    
        $VerificarEstadoPrecio = CatalogoControlador::ctrVerificarEstadoPrecioExistencia();
    
        echo json_encode($VerificarEstadoPrecio);
    
    }
}




if (isset($_POST['accion']) && $_POST['accion'] == 1) {
    $catalogo = new AjaxCatalogo;
    $catalogo->ajaxObtenerCatalogo();
    //si es mayor a 0 procede a realizar una edicion
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) { //parametro para registrar un nuevo producto

    $registrarSlider = new AjaxCatalogo();
    $registrarSlider->descripcionSlider = $_POST["descripcionSlider"];
    $registrarSlider->ajaxRegistrarSlider();
} else if(isset($_POST['accion'])&& $_POST['accion']==3){//ELIMINAR
    $eliminarSlider = new AjaxCatalogo();
    $eliminarSlider -> ajaxEliminarSlider();
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){ //HABILITAR O DESHBAILITAR MOSTRAR PRECIO
    $mostrarOcultarPrecio = new AjaxCatalogo();
    $mostrarOcultarPrecio->ajaxMostrarOcultarPrecio($_POST["dato"]);

}else if(isset($_POST['accion']) && $_POST['accion'] == 6){ //VERIFICAR EL ESTADO QUE SE MUESTRA O NO EL PRECIO
    $VerificarEstadoPrecio = new AjaxCatalogo();
    $VerificarEstadoPrecio->ajaxVerificarEstadoPrecioExistencia();

}else if(isset($_POST['accion']) && $_POST['accion'] == 7){ //HABILITAR O DESHBAILITAR MOSTRAR EXISTENCIAS
    $mostrarOcultarExistencia = new AjaxCatalogo();
    $mostrarOcultarExistencia->ajaxMostrarOcultareExistencia($_POST["dato"]);

}else {

    $catalogo = new AjaxCatalogo();
    $catalogo->ajaxObtenerCatalogo();
}
