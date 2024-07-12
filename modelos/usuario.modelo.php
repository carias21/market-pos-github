<?php

require_once "conexion.php";

class UsuarioModelo
{

    //------------------------------------------
    static public function mdlIniciarSesion($usuario, $contraseña)
    {
        try {
            // Paso 1: Verificar el estado del usuario
            $stmtEstado = Conexion::conectar()->prepare(
                "SELECT estado 
                 FROM usuarios 
                 WHERE usuario = :usuario"
            );
            $stmtEstado->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmtEstado->execute();
    
            $resultadoEstado = $stmtEstado->fetch(PDO::FETCH_ASSOC);
    
            // Verificar si se encontró un usuario y su estado
            if ($resultadoEstado === false) {
                // No se encontró el usuario
                return ["error" => "Usuario no encontrado"];
            } elseif ($resultadoEstado['estado'] == 0) {
                // Si el estado es 0, retornar un mensaje indicando que el usuario está inactivo
                return ["error" => "Usuario inactivo"];
            }
    
            // Paso 2: Si el estado es 1
            $stmt = Conexion::conectar()->prepare(
                "SELECT *
                 FROM usuarios u
                 INNER JOIN perfiles p ON u.id_perfil_usuario = p.id_perfil
                 INNER JOIN perfil_modulo pm ON pm.id_perfil = u.id_perfil_usuario
                 INNER JOIN modulos m ON m.id = pm.id_modulo
                 WHERE u.usuario = :usuario
                 AND u.clave = :password
                 AND vista_inicio = 1"
            );
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":password", $contraseña, PDO::PARAM_STR);
    
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_CLASS);
            return empty($result) ? ["error" => "Credenciales inválidas"] : $result;
        } catch (Exception $e) {
            // Manejo de excepciones en caso de error
            return ["error" => "Error: " . $e->getMessage()];
        }
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
                                                p.id_perfil as descripcion,
                                                p.descripcion as descripcion_perfil,
                                                
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


    static public function mdlMostrarOcultarUsuario($dato, $id)
    {

        try {

            if($id == 1){
          return;

            }else{
                $stmtMostrarOcultarUsuario = Conexion::conectar()->prepare("UPDATE  usuarios set estado = :dato WHERE id_usuario = :id");

            }

            $stmtMostrarOcultarUsuario->bindParam(":dato",  $dato, PDO::PARAM_INT);
            $stmtMostrarOcultarUsuario->bindParam(":id",  $id, PDO::PARAM_STR);



            if ($stmtMostrarOcultarUsuario->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmtMostrarOcultarUsuario = null;
    }




    static public function mdlVerificarEstadoUsuario()
    {
        try {
            $conn = Conexion::conectar();
            $stmt = $conn->prepare('SELECT id_usuario, estado from usuarios  ');

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
