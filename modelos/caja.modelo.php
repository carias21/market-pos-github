<?php

require_once "conexion.php";

class CajaModelo{

    /*=========================================================================================================================
    LISTAR LAS TABLA CAJA
    ==========================================================================================================================*/

    static public function mdlListarCaja(){
 
        $stmt = Conexion::conectar()->prepare("SELECT  id_caja,
                                                        codigo_producto,
                                                         fecha, 
                                                         descripcion,
                                                         CONCAT('Q. ',CONVERT(ROUND(entrada,2), CHAR)) as entrada,
                                                         CONCAT('Q. ',CONVERT(ROUND(salida,2), CHAR)) as salida,
                                                         CONCAT('Q. ',CONVERT(ROUND(saldo_actual,2), CHAR)) as saldo_actual,
                                                         '' as opciones
             
         FROM caja");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR INGRESO DE CAJA
    ====================================================================*/
    static public function mdlIngresoCaja($descripcion, $entrada){        

        try{
            $stmt = Conexion::conectar()->prepare("INSERT INTO caja(
                codigo_producto,
               descripcion,
               entrada,
               salida,
               saldo_actual)         
               VALUES(
               '',
               :descripcion,
               :entrada,
               '',
               '')");

           $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
           $stmt->bindParam(":entrada", $entrada, PDO::PARAM_STR);
        
            if($stmt -> execute()){
                $resultado = "ok";
             

            }else{
                $resultado = "error";
            }  
        
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        
        return $resultado;

        $stmt = null;

    }

        /*===================================================================
    REGISTRAR SALIDA DE CAJA
    ====================================================================*/
    static public function mdlSalidaCaja($descripcion, $salida){        

        try{
            $stmt = Conexion::conectar()->prepare("INSERT INTO caja(
                codigo_producto,
               descripcion,
               entrada,
               salida,
               saldo_actual)         
               VALUES(
               '',
               :descripcion,
               '',
               :salida,
               '')");

           $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
           $stmt->bindParam(":salida", $salida, PDO::PARAM_STR);
        
            if($stmt -> execute()){
                $resultado = "ok";
             

            }else{
                $resultado = "error";
            }  
        
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        
        return $resultado;

        $stmt = null;

    }

    static public function mdlGetTotal_Caja(){

        $stmt = Conexion::conectar()->prepare('call prc_Total_Caja()');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);

       
    }


}