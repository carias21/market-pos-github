<?php

require_once "conexion.php";

class UsuarioModelo
{

    //------------------------------------------
    static public function mdlIniciarSesion($usuario, $contraseña)
    {
        $stmt = Conexion::conectar()->prepare(
            "select *
                                            from usuarios u
                                            inner join perfiles p
                                            on u.id_perfil_usuario = p.id_perfil
                                            inner join perfil_modulo pm
                                            on pm.id_perfil = u.id_perfil_usuario
                                            inner join modulos m
                                            on m.id = pm.id_modulo
                                            where u.usuario = :usuario
                                            and u.clave = :password
                                            and vista_inicio = 1"
        );
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $contraseña, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    //------------------------------------------



    static public function mdlObtenerMenuUsuario($id_usuario)
    {
        //CAMBIOS VD 30 MIN 4:30
        $stmt = Conexion::conectar()->prepare("SELECT m.id,m.modulo,m.icon_menu,m.vista, pm.vista_inicio
                                            from usuarios u inner join perfiles p on u.id_perfil_usuario = p.id_perfil
                                            inner join perfil_modulo pm on pm.id_perfil = p.id_perfil
                                            inner join modulos m on m.id = pm.id_modulo
                                            where u.id_usuario = :id_usuario
                                            and (m.padre_id is null or m.padre_id = 0)
                                            order by m.orden");

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function mdlObtenerSubMenuUsuario($idMenu, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.id,m.modulo,m.icon_menu,m.vista,pm.vista_inicio
                                                from usuarios u inner join perfiles p on u.id_perfil_usuario = p.id_perfil
                                                inner join perfil_modulo pm on pm.id_perfil = p.id_perfil
                                                inner join modulos m on m.id = pm.id_modulo
                                                where u.id_usuario = :id_usuario
                                                and m.padre_id = :idMenu
                                                order by m.orden");

        $stmt->bindParam(":idMenu", $idMenu, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


    /*================================================================================================================
OBTENER LISTADO DE USUARIOS DE LA TABLA DE USUARIOS
==================================================================================================================*/
    static public function mdlObtenerUsuarios()
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario,
                                                u.nombre_usuario,
                                                u.apellido_usuario,
                                                u.usuario,
                                                u.clave,
                                                p.descripcion,
                                                u.estado,
                                                ' ' as opciones
                                                /*usamos inner join para mostrar con el id del perfil el nombre del perfil que seria descripcion. */
                                                from usuarios u inner join perfiles p on u.id_perfil_usuario =  p.id_perfil
                                                order by u.id_usuario");



        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*=========================================================================================================================
    REGISTRO DE USUARIOS
    ==========================================================================================================================*/

    static public function mdlGuardarUsuario($accion, $id_usuario, $nombre_Usuario, $apellido_Usuario, $usuario, $contraseña, $perfil,  $estado_Usuario)
    {


        try {

            if ($accion > 0) { //Registrar

                $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre_usuario, apellido_usuario, usuario, clave, id_perfil_usuario, estado)
                    VALUES(:nombre_usuario, :apellido_usuario, :usuario, :clave, :id_perfil_usuario, :estado )");

                $stmt->bindParam(":nombre_usuario", $nombre_Usuario, PDO::PARAM_STR);
                $stmt->bindParam(":apellido_usuario", $apellido_Usuario, PDO::PARAM_STR);
                $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                $stmt->bindParam(":clave", $contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":id_perfil_usuario", $perfil, PDO::PARAM_STR);
                $stmt->bindParam(":estado", $estado_Usuario, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $resultado = "ok";
                } else {
                    $resultado = "error";
                }
            } else { //Editar

                if ($contraseña == "") {
                    $stmt = Conexion::conectar()->prepare("UPDATE usuarios
                    SET nombre_usuario = :nombre_usuario,
                    apellido_usuario = :apellido_usuario,
                    usuario = :usuario,
                    id_perfil_usuario = :id_perfil_usuario,
                    estado = :estado
                    WHERE id_usuario = :id_usuario");

                    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":nombre_usuario", $nombre_Usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":apellido_usuario", $apellido_Usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":id_perfil_usuario", $perfil, PDO::PARAM_STR);
                    $stmt->bindParam(":estado", $estado_Usuario, PDO::PARAM_STR);
                }else{
                    $stmt = Conexion::conectar()->prepare("UPDATE usuarios
                    SET nombre_usuario = :nombre_usuario,
                    apellido_usuario = :apellido_usuario,
                    usuario = :usuario,
                    clave = :clave,
                    id_perfil_usuario = :id_perfil_usuario,
                    estado = :estado

                 
                    WHERE id_usuario = :id_usuario");

                    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":nombre_usuario", $nombre_Usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":apellido_usuario", $apellido_Usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                    $stmt->bindParam(":clave", $contraseña, PDO::PARAM_STR);
                    $stmt->bindParam(":id_perfil_usuario", $perfil, PDO::PARAM_STR);
                    $stmt->bindParam(":estado", $estado_Usuario, PDO::PARAM_STR);
                }



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
    static public function mdlEliminarUsuario($tbl_Usuarios, $id_Usuario, $nameId)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tbl_Usuarios WHERE $nameId = :$nameId");

        $stmt->bindParam(":" . $nameId, $id_Usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";;
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
}
