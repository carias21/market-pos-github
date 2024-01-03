<?php

class CatalogoControlador
{
    static public function ctrObtenerCatalogo(){

        $catalogo = CatalogoModelo::mdlObtenerCatalogo();

        return $catalogo;
    }


    
    static public function ctrRegistrarSlider($name,$descripcionSlider ) {

        $registrarSlider = CatalogoModelo::mdlRegistrarSlider($name,$descripcionSlider );

        return $registrarSlider;
    }


    static public function ctrEliminarSlider($tableCatalogo, $id_slider, $nameId){
        $respuesta = CatalogoModelo::mdlEliminarSlider($tableCatalogo, $id_slider, $nameId);
        return $respuesta;
    }
    
}
