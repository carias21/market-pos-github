<?php

require_once "conexion.php";

class GastosModelo
{

    /*=========================================================================================================================
    LISTAR CATEGORIA GASTOS
    ==========================================================================================================================*/

    static public function mdlListarCategoriaGastos()
    {

        $stmtListarCategoriaGastos = Conexion::conectar()->prepare("SELECT  id_tipo_gasto, 
                                                                            descripcion, 
                                                                            date(fecha_creacion) as fecha_creacion, 
                                                                            '' as opciones
                                                                        FROM tipo_gasto order BY id_tipo_gasto desc");

        $stmtListarCategoriaGastos->execute();

        return $stmtListarCategoriaGastos->fetchAll();
    }

    /*=========================================================================================================================
    LISTAR CATEGORIA GASTOS OPERATIVOS
    ==========================================================================================================================*/

    static public function mdlListarGastosOp()
    {

        $stmtListarGastosOp  = Conexion::conectar()->prepare("SELECT id_gasto, 
                                                            t.descripcion as tipo_gasto, 
                                                            g.descripcion as descripcion, 
                                                            CONCAT('Q. ',CONVERT(ROUND(monto,2), CHAR)) as monto,
                                                            fecha,
                                                            '' as opciones
                                                             FROM gastos_operativos g
                                                             inner join tipo_gasto t on g.fk_tipo_gasto = t.id_tipo_gasto");

        $stmtListarGastosOp->execute();

        return $stmtListarGastosOp->fetchAll();
    }

    /*=========================================================================================================================
    REGISTRO DE CATEGORIAS GASTOS
    ==========================================================================================================================*/
    static public function mdlGuardarCategoriaGasto($accion, $idCategoriaGasto, $iptCategoriaGasto)
    {
        try {
            if ($accion > 0) { //Registrar

                $stmt = Conexion::conectar()->prepare("INSERT INTO tipo_gasto(descripcion)
            VALUES(:descripcion)");

                $stmt->bindParam(":descripcion", $iptCategoriaGasto, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    $resultado = "ok";
                } else {
                    $resultado = "error";
                }
            } else { //Editar

                $stmt = Conexion::conectar()->prepare("UPDATE tipo_gasto
                                                SET descripcion = :descripcion
                                                WHERE id_tipo_gasto = :idCategoriaGasto");

                $stmt->bindParam(":descripcion", $iptCategoriaGasto, PDO::PARAM_STR);
                $stmt->bindParam(":idCategoriaGasto", $idCategoriaGasto, PDO::PARAM_STR);


                if ($stmt->execute()) {
                    $resultado = "ok";
                } else {
                    $resultado = "error";
                }
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
        return $resultado;
        //no dejar ninguna conexion abierta
        $stmt = null;
    }

    /*=========================================================================================================================
    REGISTRO DE GASTOS OPERACIONALES
    ==========================================================================================================================*/
    static public function mdlGuardarGastoOp($selCategoriaModal, $iptDescripcionModal, $iptMontoModal)
    {
        try {
            date_default_timezone_set('America/Guatemala');
            $fecha = date("Y-m-d H:i:s");

            $stmt = Conexion::conectar()->prepare("INSERT into  gastos_operativos(fk_tipo_gasto, descripcion, monto, fecha)
                                                VALUES(:fk_tipo_gasto, :descripcion, :monto, :fecha)");

            $stmt->bindParam(":fk_tipo_gasto", $selCategoriaModal, PDO::PARAM_INT);

            $stmt->bindParam(":descripcion", $iptDescripcionModal, PDO::PARAM_STR);

            $stmt->bindParam(":monto", $iptMontoModal, PDO::PARAM_STR);

            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
        return $resultado;
        //no dejar ninguna conexion abierta
        $stmt = null;
    }


    /*=========================================================================================================================
    ELIMINACION DE CATEGORIA
    ==========================================================================================================================*/
    static public function mdlEliminarCategoriaGasto($tableTipoGastos, $id_Categoria_Gasto, $nameId)
    {

        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tableTipoGastos WHERE $nameId = :$nameId");

            $stmt->bindParam(":" . $nameId, $id_Categoria_Gasto, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = Conexion::conectar()->errorInfo();
            }
        } catch (PDOException $e) {
            $resultado = "ERROR AL ELIMINAR CATEGORIA GASTO ";
        }

        return $resultado;
    }

    /*=========================================================================================================================
    ELIMINACION DE GASTOS OPERATIVOS
    ==========================================================================================================================*/
    static public function mdlEliminarGastoOp($tableGastosOp, $id_gasto_op, $nameId)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tableGastosOp WHERE $nameId = :$nameId");

            $stmt->bindParam(":" . $nameId, $id_gasto_op, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = Conexion::conectar()->errorInfo();
            }
        } catch (PDOException $e) {
        }
        return $resultado;
    }


    static public function mdlListarGastosPorFecha($gastosDesde, $gastosHasta)
    {

        try {

            $stmt = Conexion::conectar()->prepare("SELECT id_gasto, 
                                                    t.descripcion as tipo_gasto, 
                                                    g.descripcion as descripcion, 
                                                    CONCAT('Q. ',CONVERT(ROUND(monto,2), CHAR)) as monto,
                                                    fecha,
                                                    '' as opciones
                                                    FROM gastos_operativos g
                                                    inner join tipo_gasto t on g.fk_tipo_gasto = t.id_tipo_gasto
                                                    where DATE(fecha) >= DATE(:gastosDesde) and DATE(fecha) <= DATE(:gastosHasta)  
                                                    order BY fecha desc
                                                   ");

            $stmt->bindParam(":gastosDesde", $gastosDesde, PDO::PARAM_STR);
            $stmt->bindParam(":gastosHasta", $gastosHasta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            // return ("Todo bien hasta aqui");
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
    
    }
}
