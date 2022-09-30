<?php

require_once "conexion.php";

class PerfilModelo{
    static public function mdlObtenerPerfiles(){
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

                                        

$stmt -> execute();
return $stmt->fetchAll();
                                                
    }
}