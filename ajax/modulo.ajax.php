<?php
require_once "../controladores/modulo.controlador.php";
require_once "../modelos/modulo.modelo.php";

class AjaxModulos{
    public function ajaxObtenerModulos(){
        $modulos = ModuloControlador::ctrObtenerModulos();
        echo json_encode($modulos);
    }
    //VD 28 MIN 9:30
    public function ajaxObtenerModulosPorPerfil($id_perfil){
        $modulosPerfil = ModuloControlador::ctrObtenerModulosPorPerfil($id_perfil);
        echo json_encode($modulosPerfil);
    }
    //VD 30 MIN 19.15
    public function ajaxObtenerModulosSistema(){
        $modulosSistema = ModuloControlador::ctrObtenerModulosSistema();

        echo json_encode($modulosSistema);
    }
    public function ajaxReorganizarModulos($modulos_ordenados){
        $modulosOrdenados = ModuloControlador::ctrReorganizarModulos($modulos_ordenados);
        echo json_encode($modulosOrdenados);
    }
}

if(isset($_POST['accion']) && $_POST['accion']==1){
    $modulos = new AjaxModulos;
    $modulos->ajaxObtenerModulos();
//VD 28 MIN 8:06
}else if(isset($_POST['accion']) && $_POST['accion']==2){
    $modulosPerfil = new AjaxModulos();
    $modulosPerfil->ajaxObtenerModulosPorPerfil($_POST['id_perfil']);
//VD 30 MIN 18.40 
//SOLICITUD PARA OBTENER MODULOS DEL SISTEMA
}else if(isset($_POST['accion']) && $_POST['accion']==3){
    $modulosSistema = new AjaxModulos;
    $modulosSistema->ajaxObtenerModulosSistema();
}
//SOLICITUD PARA REORGANIZAR LOS MODULOS
//VD 31 MIN 11:30
else if(isset($_POST['accion']) && $_POST['accion']==4){
    $organizar_modulos = new AjaxModulos;
    $organizar_modulos->ajaxReorganizarModulos($_POST["modulos"]);
}