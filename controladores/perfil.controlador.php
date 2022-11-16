<?php

class PerfilControlador{
    static public function ctrObtenerPerfiles(){
        $perfiles = PerfilModelo::mdlObtenerPerfiles();
        return $perfiles;
    }
  
    static public function ctrGuardarPerfil($accion, $idPerfil, $perfil, $estado){
        $guardarPerfil = PerfilModelo::mdlGuardarPerfil($accion, $idPerfil, $perfil, $estado);
        return $guardarPerfil;
    }

    static public function ctrEliminarPerfil($tablePerfiles, $id_Perfil, $nameId){
        $respuesta = PerfilModelo::mdlEliminarPerfil($tablePerfiles, $id_Perfil, $nameId);
        return $respuesta;
    }
}