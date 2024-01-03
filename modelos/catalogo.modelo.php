<?php

require_once "conexion.php";

class CatalogoModelo
{


    /*=========================================================================================================================
    LISTAR LAS CATEGORIAS
    ==========================================================================================================================*/

    static public function mdlObtenerCatalogo()
    {

        $stmt = Conexion::conectar()->prepare("SELECT   id, foto, descripcion, 
                                                                                             '' as opciones
         FROM catalogo  order BY id ASC");

        $stmt->execute();

        return $stmt->fetchAll();
    }


        /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL INVENTARIO
    ====================================================================*/
    static public function mdlRegistrarSlider($name,$descripcionSlider) {

        try {


            $stmt = Conexion::conectar()->prepare("INSERT INTO catalogo(foto, 
                                                                        descripcion) 
                                                VALUES (:foto, 
                                                        :descripcion)");


            $stmt->bindParam(":foto",  $name, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcionSlider, PDO::PARAM_STR);


            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmt = null;
    }







      /*=========================================================================================================================
    ELIMINACION DE SLIDER
    ==========================================================================================================================*/
    static public function mdlEliminarSlider($tableCatalogo, $id_slider, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tableCatalogo WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_slider, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";;
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }

}
