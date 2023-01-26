<?php

//VD 29 MIN 11:40
class perfilModuloControlador{
    static public function ctrRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio){
        $registroPerfilModulo = PerfilModuloModelo::mdlRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio);
       //retornamos la respuesta al archivo de ajax
        return $registroPerfilModulo;
    }
    
}
