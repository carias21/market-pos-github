<?php

require_once "conexion.php";
require_once "../config.php";


class CajaModelo
{

    /*=========================================================================================================================
    LISTAR LAS TABLA CAJA
    ==========================================================================================================================*/

    static public function mdlListarCaja()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  id_caja,
                                                        codigo_producto,
                                                         fecha, 
                                                         descripcion,
                                                         cantidad,
                                                         CONCAT('Q. ',CONVERT(ROUND(entrada,2), CHAR)) as entrada,
                                                         CONCAT('Q. ',CONVERT(ROUND(salida,2), CHAR)) as salida,
                                                         CONCAT('Q. ',CONVERT(ROUND(saldo_actual,2), CHAR)) as saldo_actual,
                                                         u.usuario,
                                                         tipo_pago,
                                                         '' as opciones
                                                        FROM caja
                                                        inner join usuarios u on u.id_usuario = fk_usuario
                                                        inner join tipo_pago tp on tp.id = fk_tipo_pago");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR INGRESO DE CAJA
    ====================================================================*/
    static public function mdlIngresoCaja($descripcion, $entrada)
    {

        global $session_id_usuario;

        $id_usuario = $session_id_usuario->id_usuario;
        date_default_timezone_set('America/Guatemala');
        $fecha_caja = date("Y-m-d H:i:s");

        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO caja(
                codigo_producto,
                fecha,
               descripcion,
               cantidad,
               entrada,
               salida,
               saldo_actual, 
               fk_usuario,
               fk_tipo_pago)         
               VALUES(
               '',
               :fecha,
               :descripcion,
               0,
               :entrada,
               '',
               '',
               :id_usuario,
               '1')");

            $stmt->bindParam(":fecha", $fecha_caja, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":entrada", $entrada, PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);

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

    /*===================================================================
    REGISTRAR SALIDA DE CAJA
    ====================================================================*/
    static public function mdlSalidaCaja($descripcion, $salida)
    {
        global $session_id_usuario;
        $id_usuario = $session_id_usuario->id_usuario;
        date_default_timezone_set('America/Guatemala');
        $fecha_caja = date("Y-m-d H:i:s");

        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO caja(
                codigo_producto,
                fecha,
               descripcion,
               cantidad,
               entrada,
               salida,
               saldo_actual, 
               fk_usuario,
               fk_tipo_pago)         
               VALUES(
               '',
               :fecha,
               :descripcion,
               0,
               '',
               :salida,
               '',
               :id_usuario,
               '1')");

            $stmt->bindParam(":fecha", $fecha_caja, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":salida", $salida, PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);

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

    static public function mdlGetTotal_Caja()
    {

        $stmt = Conexion::conectar()->prepare('call prc_Total_Caja()');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    static public function mdlEliminarCaja($tbl_Caja, $id_Caja, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tbl_Caja  WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_Caja, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }

    static public function mdlCierreDeCaja($tbl_Caja)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tbl_Caja");
        
         if ($stmt->execute()) {
            return "caja_eliminada";
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}
