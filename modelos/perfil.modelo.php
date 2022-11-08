<?php

require_once "conexion.php";

class PerfilModelo
{
    static public function mdlObtenerPerfiles()
    {
        $stmt = Conexion::conectar()->prepare("select p.id_perfil,
                                                p.descripcion,
                                                p.estado,
                                                date(fecha_creacion_perfil) as fecha_creacion_perfil,
                                                fecha_actualizacion_perfil,
                                                ' ' as opciones
                                                from perfiles p
                                                order by p.id_perfil");
        /*este es el codigo que no me funciona ya que en la tabla 
                                                perfiles me da el error json se agrego dos culumnas mas a la tabla 
                                                para que reconozca las fechas de creacion y actualizacion */
        /* date(p.fecha_creacion) as fecha_creacion,
                                                p.fecha_actualizacion, */



        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*=========================================================================================================================
    REGISTRO DE  PERFILES
    ==========================================================================================================================*/

    static public function mdlGuardarPerfil($accion, $idPerfil, $perfil, $estado)
    {
        try {
            $date = null;
            if ($accion > 0) { //Registrar

                $date = date("Y-m-d H:i:s");

                $stmt = Conexion::conectar()->prepare("INSERT INTO perfiles(descripcion, estado, fecha_actualizacion_perfil)
                    VALUES(:perfil, :estado, :fecha_actualizacion_perfil)");

                $stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
                $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_actualizacion_perfil", $date, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    $resultado = "ok";
                } else {
                    $resultado = "error";
                }
            } else { //Editar
                $date = date("Y-m-d H:i:s");

                $stmt = Conexion::conectar()->prepare("UPDATE perfiles
                                                        SET descripcion = :perfil,
                                                        estado = :estado,
                                                        /*fecha_creacion_categoria = fecha_creacion_categoria, */
                                                        fecha_actualizacion_perfil = :fecha_actualizacion_perfil
                                                        WHERE id_perfil = :idPerfil");

                $stmt->bindParam(":idPerfil", $idPerfil, PDO::PARAM_STR);
                $stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);
                $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_actualizacion_perfil", $date, PDO::PARAM_STR);

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
    ELIMINACION DE CATEGORIA
    ==========================================================================================================================*/
    static public function mdlEliminarPerfil($tablePerfiles, $id_perfil, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tablePerfiles WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_perfil, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}
