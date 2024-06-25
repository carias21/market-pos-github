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
    static public function mdlRegistrarSlider($name, $descripcionSlider)
    {

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



    /*=========================================================================================================================
    HABILITAR O DESHABILITAR MOSTRAR PRECIO CATALOGO
    ==========================================================================================================================*/
    static public function mdlMostrarOcultarPrecio($dato)
    {

        try {

            $stmtMostrarOcultarPrecio = Conexion::conectar()->prepare("UPDATE  recursos set dato = :dato WHERE id = 'CATA-PRECIO'");

            $stmtMostrarOcultarPrecio->bindParam(":dato",  $dato, PDO::PARAM_STR);


            if ($stmtMostrarOcultarPrecio->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmtMostrarOcultarPrecio = null;
    }

    /*=========================================================================================================================
    HABILITAR O DESHABILITAR MOSTRAR EXISTENCIAS CATALOGO
    ==========================================================================================================================*/
    static public function mdlMostrarOcultareExistencia($dato)
    {

        try {

            $stmtMostrarOcultarExistencia = Conexion::conectar()->prepare("UPDATE  recursos set dato = :dato WHERE id = 'CATA2-EXIST'");

            $stmtMostrarOcultarExistencia->bindParam(":dato",  $dato, PDO::PARAM_STR);


            if ($stmtMostrarOcultarExistencia->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmtMostrarOcultarExistencia = null;
    }



    static public function mdlVerificarEstadoPrecioExistencia()
    {
        try {
            $conn = Conexion::conectar();
            $stmt = $conn->prepare("
            SELECT 
                (SELECT dato FROM recursos WHERE id = 'CATA-PRECIO') AS datoPrecio, 
                (SELECT dato FROM recursos WHERE id = 'CATA2-EXIST') AS datoExistencia
            FROM dual
            WHERE EXISTS (SELECT 1 FROM recursos WHERE id = 'CATA-PRECIO')
              AND EXISTS (SELECT 1 FROM recursos WHERE id = 'CATA2-EXIST');
        ");

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC); 
            } else {
                return "Error en la ejecución de la consulta.";
            }
        } catch (PDOException $e) {
            return 'Excepción de PDO capturada: ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Excepción general capturada: ' . $e->getMessage();
        } finally {
            if ($stmt) {
                $stmt = null; 
            }
            if ($conn) {
                $conn = null; 
            }
        }
    }
}
