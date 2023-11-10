<?php

require_once "conexion.php";

class ProveedoresModelo
{


    /*=========================================================================================================================
    LISTAR LAS CATEGORIAS
    ==========================================================================================================================*/

    static public function mdlListarProveedores()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  id_proveedor, nombre, direccion, telefono, email, date(fecha_registro) as fecha_registro , tipo_producto, estado, '' as opciones                         
                                                FROM proveedores  order BY fecha_registro ASC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*=========================================================================================================================
    REGISTRO DE CATEGORIAS 
    ==========================================================================================================================*/

    static public function mdlGuardarProveedor($accion, $id_Proveedores, $nombre, 
                                                $direccion, $telefono, $correo,
                                                $tipo_producto, $estado){
        try {

            if ($accion > 0) { //Registrar


                $stmt = Conexion::conectar()->prepare("INSERT INTO proveedores(nombre, direccion,telefono, email, tipo_producto, estado)
                                                        VALUES(:nombre, :direccion,:telefono, :email, :tipo_producto, :estado)");

                $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
                $stmt->bindParam(":telefono", $telefono, PDO::PARAM_INT);
                $stmt->bindParam(":email", $correo, PDO::PARAM_STR);
                $stmt->bindParam(":tipo_producto", $tipo_producto, PDO::PARAM_STR);
                $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $resultado = "ok";
                } else {
                    $resultado = "error";
                }
            } else { //Editar

             
                $stmt = Conexion::conectar()->prepare("UPDATE proveedores
                                                SET nombre = :nombre,
                                                direccion = :direccion,
                                                telefono = :telefono,
                                                email = :email,
                                                tipo_producto = :tipo_producto,
                                                estado = :estado
                                        
                                                WHERE id_proveedor = :id_proveedor");

                $stmt->bindParam(":id_proveedor", $id_Proveedores, PDO::PARAM_INT);
                $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
                $stmt->bindParam(":telefono", $telefono, PDO::PARAM_INT);
                $stmt->bindParam(":email", $correo, PDO::PARAM_STR);
                $stmt->bindParam(":tipo_producto", $tipo_producto, PDO::PARAM_STR);
                $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);


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
    static public function mdlEliminarProveedor($tableProveedor, $id_Proveedores, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tableProveedor WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_Proveedores, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";;
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}
