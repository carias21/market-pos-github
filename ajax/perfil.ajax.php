<?php

require_once "../controladores/perfil.controlador.php";
require_once "../modelos/perfil.modelo.php";

class AjaxPerfiles{

    public $idPerfil;
    public $perfil;
    public $estado;


    public function ajaxObtenerPerfiles(){
        $perfiles = PerfilControlador::ctrObtenerPerfiles();
        echo json_encode($perfiles);
    }
    public function ajaxGuardarPerfil($accion){
        $guardarPerfil = PerfilControlador::ctrGuardarPerfil($accion, $this->idPerfil, $this->perfil, $this->estado);
        echo json_encode($guardarPerfil, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxEliminarPerfil(){
        $tablePerfiles = "perfiles";
        $id_perfil= $_POST["id_perfil"];
        $nameId = "id_perfil";
        $respuesta = PerfilControlador::ctrEliminarPerfil($tablePerfiles, $id_perfil, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}

if(isset($_POST['accion']) && $_POST['accion']==1){
    $perfiles = new AjaxPerfiles;
    $perfiles->ajaxObtenerPerfiles();
    //si es mayor a 0 procede a realizar una edicion
}else if(isset($_POST['idPerfil'])&& $_POST['idPerfil'] > 0){//EDITAR PERFIL

    $editarPerfil = new AjaxPerfiles();
    $editarPerfil->idPerfil = $_POST['idPerfil'];
    $editarPerfil->perfil = $_POST['perfil'];
    $editarPerfil->estado = $_POST['estado'];
    $editarPerfil->ajaxGuardarPerfil(0);

}else if(isset($_POST['idPerfil'])&& $_POST['idPerfil']==0){//REGISTRAR PERFIL
    $registrarPerfil = new AjaxPerfiles();
    $registrarPerfil->idPerfil = $_POST['idPerfil'];
    $registrarPerfil->perfil = $_POST['perfil'];
    $registrarPerfil->estado = $_POST['estado'];
    $registrarPerfil->ajaxGuardarPerfil(1);
}else if(isset($_POST['accion'])&& $_POST['accion']==2){//ELIMINAR
    $eliminarPerfil = new AjaxPerfiles();
    $eliminarPerfil -> ajaxEliminarPerfil();
}else{

    $perfiles = new AjaxPerfiles();
    $perfiles -> ajaxObtenerPerfiles();
    }