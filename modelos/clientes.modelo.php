<?php

require_once "conexion.php";


class ClientesModelo
{

    static public function mdlRegistrarCliente($nit_cliente, $nombre_cliente, $telefono, $correo_e, $direccion, $notas)
    {

        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("INSERT INTO clientes(nit_cliente, nombre_cliente, numero_tel, correo_electronico, direccion, notas)
            VALUES(:nit_cliente, :nombre_cliente, :numero_tel, :correo_electronico, :direccion, :notas)");

            $stmt->bindParam(":nit_cliente", $nit_cliente, PDO::PARAM_STR);
            $stmt->bindParam(":nombre_cliente", $nombre_cliente, PDO::PARAM_STR);
            $stmt->bindParam(":numero_tel", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":correo_electronico", $correo_e, PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindParam(":notas", $notas, PDO::PARAM_STR);

            if ($stmt->execute()) {

                // Obtener el ID del cliente autogenerado utilizando la misma conexión
                $id_cliente = $conexion->lastInsertId();

                return $id_cliente;
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
    }


    static public function mdlListarClientes()
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT id_cliente, nit_cliente, nombre_cliente, 
                                                            numero_tel, correo_electronico, direccion, 
                                                            notas, fecha_creacion, fecha_actualizacion,
                                                            '' as opciones
                                                            from clientes order BY fecha_creacion DESC ");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
        return $resultado;
        $stmt = null;
    }


    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlAutoCompleteClientes()
    {


        $stmt = Conexion::conectar()->prepare("SELECT  concat(id_cliente,  ' / ',  nit_cliente, ' / ',  nombre_cliente) as descripcion_cliente
        FROM clientes;");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    OBTENER LOS DATOS DEL CLIENTE DESPUES DE USAR EL AUTOCOMPLETE
    ====================================================================*/
    static public function mdlDatosCliente($nit_cliente)
    {

        list($id) = explode(' / ', $nit_cliente);




        try {

            $stmt = Conexion::conectar()->prepare("SELECT id_cliente, nit_cliente, nombre_cliente, 
                                                            numero_tel, correo_electronico, direccion, 
                                                            notas
                                                            from clientes WHERE id_cliente = :id ");

            $stmt->bindParam(":id", $id, PDO::PARAM_STR);


            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
        return $resultado;
        $stmt = null;
    }


    /*=========================================================================================================================
    ELIMINACION DE CLIENTES
    ==========================================================================================================================*/
    static public function mdlEliminarCliente($tableClientes, $id_cliente, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tableClientes WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_cliente, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";;
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }



    static public function mdlEditarCliente($tableClientes, $data, $id, $nameId)
    {
        $set = "";

        foreach ($data as $key => $value) {

            $set .= $key . " = :" . $key . ",";
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $tableClientes SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {

            $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }

        $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return Conexion::conectar()->errorInfo();
        }
    }
}
