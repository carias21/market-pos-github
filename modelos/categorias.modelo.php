<?php

require_once "conexion.php";

class CategoriasModelo{


    /*=========================================================================================================================
    LISTAR LAS CATEGORIAS
    ==========================================================================================================================*/

    static public function mdlListarCategorias(){

        $stmt = Conexion::conectar()->prepare("SELECT  id_categoria, nombre_categoria, aplica_peso as medida,
                                                date(fecha_creacion_categoria) as fecha_creacion_categoria,
                                                fecha_actualizacion_categoria,
        '' as opciones
         FROM categorias c order BY id_categoria DESC");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    /*=========================================================================================================================
    REGISTRO DE CATEGORIAS 
    ==========================================================================================================================*/

    static public function mdlGuardarCategoria($accion, $idCategoria, $categoria, $medida){
try{
        $date = null;
        if($accion > 0){//Registrar
            
            $date = date("Y-m-d H:i:s");

            $stmt = Conexion::conectar()->prepare("INSERT INTO categorias(nombre_categoria, aplica_peso, fecha_actualizacion_categoria)
            VALUES(:categoria, :medida, :fecha_actualizacion_categoria)");

            $stmt -> bindParam(":categoria", $categoria, PDO::PARAM_STR);
            $stmt -> bindParam(":medida", $medida, PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_actualizacion_categoria", $date, PDO::PARAM_STR);
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  

    }else {//Editar
        $date = date("Y-m-d H:i:s");

        $stmt = Conexion::conectar()->prepare("UPDATE categorias
                                                SET nombre_categoria = :categoria,
                                                aplica_peso = :medida,
                                                /*fecha_creacion_categoria = fecha_creacion_categoria, */
                                                fecha_actualizacion_categoria = :fecha_actualizacion_categoria
                                                WHERE id_categoria = :idCategoria");
                                                
    $stmt -> bindParam(":idCategoria", $idCategoria, PDO::PARAM_STR);
    $stmt -> bindParam(":categoria", $categoria, PDO::PARAM_STR);
    $stmt -> bindParam(":medida", $medida, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha_actualizacion_categoria", $date, PDO::PARAM_STR);
    
    if($stmt -> execute()){
        $resultado = "ok";
    }else{
        $resultado ="error";           
    }
}

}catch (Exception $e) {
    $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
}
return $resultado;
//no dejar ninguna conexion abierta
$stmt = null;

}

/*=========================================================================================================================
    ELIMINACION DE CATEGORIA
    ==========================================================================================================================*/
static public function mdlEliminarCategoria($tableCategorias, $id_categoria, $nameId){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tableCategorias WHERE $nameId = :$nameId");
    
    $stmt -> bindParam(":".$nameId, $id_categoria, PDO::PARAM_INT);

    if ($stmt -> execute()){
        return "ok";;
    }else{
        return Conexion::conectar()->errorInfo();
        }
    }
}

                                                

