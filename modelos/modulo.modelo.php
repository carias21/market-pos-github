<?php

require_once "conexion.php";

class ModuloModelo
{
    static public function mdlObtenerModulos()
    {
        $stmt = Conexion::conectar()->prepare("select id as id,
                                                    (case when (padre_id is null or padre_id = 0)then '#' else padre_id end) as parent,
                                                    modulo as text,
                                                    vista
                                                    from modulos m
                                                    order by m.orden");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //VD 28 MIN 11.22
    static public function mdlObtenerModulosPorPerfil($id_perfil)
    {
        $stmt = Conexion::conectar()->prepare("select id,
                                            modulo,
                                             IFNULL(case when (m.vista is null or m.vista = '') then '0' else(
                                                (select '1' from perfil_modulo pm where pm.id_modulo = m.id and pm.id_perfil = :id_perfil)) end, 0) as sel
                                                from modulos m
                                                order by m.orden");
        $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //VD 30 MIN 20.20  
    //se usa para el modulo de matenimiento de modulos
    static public function mdlObtenerModulosSistema(){
        $stmt = Conexion::conectar()->prepare("SELECT '' as opciones,
                                                        id,
                                                        orden,
                                                        modulo,
                                                        (select modulo FROM modulos mp where mp.id = m.padre_id)as modulo_padre,
                                                        vista,
                                                        icon_menu
                                                       
                                                        FROM modulos m
                                                        ORDER BY m.orden");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //FNC PARA REORGANIZAR LOS MODULOS DEL SISTEMA
    //VD 31 MIN 13:20
    static public function mdlReorganizarModulos($modulos_ordenados)
    {
        $total_registros = 0;
        foreach ($modulos_ordenados as $modulo) {
            $array_item_modulo = explode(";", $modulo);
            $stmt = Conexion::conectar()->prepare("UPDATE modulos
                                                    SET padre_id = replace(:p_padre_id, '#',0),
                                                    orden = :p_orden
                                                    WHERE id = :p_id");
            $stmt->bindParam(":p_id", $array_item_modulo[0], PDO::PARAM_INT);
            $stmt->bindParam(":p_padre_id", $array_item_modulo[1], PDO::PARAM_INT);
            $stmt->bindParam(":p_orden", $array_item_modulo[2], PDO::PARAM_INT);

            if ($stmt->execute()) {
                $total_registros = $total_registros + 1;
            } else {
                $total_registros = 0;
            }
        }
        return $total_registros;
    }
}
