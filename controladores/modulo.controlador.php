<?php

class ModuloControlador
{

    static public function ctrObtenerModulos()
    {
        $modulos = ModuloModelo::mdlObtenerModulos();
        return $modulos;
    }
    //VD 28 MIN 10:25
    static public function ctrObtenerModulosPorPerfil($id_perfil){
        $modulosPorPerfil = ModuloModelo::mdlObtenerModulosPorPerfil($id_perfil);

        return $modulosPorPerfil;
    }
    //VD 30 MIN 19.50
    static public function ctrObtenerModulosSistema(){
        $modulosSistema = ModuloModelo::mdlObtenerModulosSistema();
        return $modulosSistema;
    }
    //FUNCION PARA REORGANIZAR LOS MODULOS DEL SISTEMA
    //VD 31 MIN 12:50
    static public function ctrReorganizarModulos($modulos_ordenados){
        $modulosOrdenados = ModuloModelo::mdlReorganizarModulos($modulos_ordenados);
        return $modulosOrdenados;
    }
}
