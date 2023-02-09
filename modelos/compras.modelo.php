<?php

require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;


class ComprasModelo{

  
    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
       //VD 15 MIN 27:50
    ====================================================================*/
    static public function mdlListarNombreProductos(){
        //https://www.youtube.com/watch?v=IEdZlIpH81M

        $stmt = Conexion::conectar()->prepare("SELECT Concat(codigo_producto , ' / ' ,c.nombre_categoria,' / ',descripcion_producto, ' / Q. ' , p.precio_compra_producto, ' / Existencia: '  ,p.stock_producto)  as descripcion_producto
                                                FROM productos p inner join categorias c on p.id_categoria_producto = c.id_categoria");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS, AGREGA LISTADO AL DATA TABLE VENTAS
    VD 15 MIN 39
    ====================================================================*/
    static public function mdlGetDatosProducto($codigoProducto){

        $stmt = Conexion::conectar()->prepare("SELECT   id,
                                                        p.codigo_producto,
                                                        c.id_categoria,                                                        
                                                        c.nombre_categoria,
                                                        descripcion_producto,
                                                        '1' as cantidad,
                                                        CONCAT(CONVERT(ROUND(p.precio_compra_producto,2), CHAR)) as precio_compra_producto,
                                                        CONCAT('Q. ', CONVERT(ROUND(1*p.precio_compra_producto,2), CHAR)) as total,
                                                        '' as acciones,
                                                        '' as comentarios,
                                                        p.foto
        
            FROM productos p inner join categorias c on p.id_categoria_producto = c.id_categoria
            WHERE p.codigo_producto = :codigoProducto");
        
        $stmt -> bindParam(":codigoProducto",$codigoProducto,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

 /*   static public function mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar){

        $stmt = Conexion::conectar()->prepare("SELECT   count(*) as existe
                                                    FROM productos p 
                                                   WHERE p.codigo_producto = :codigo_producto
                                                     AND p.stock_producto > :cantidad_a_comprar");
    
        $stmt -> bindParam(":codigo_producto",$codigo_producto,PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad_a_comprar",$cantidad_a_comprar,PDO::PARAM_STR);
    
        $stmt -> execute();
    
        return $stmt->fetch(PDO::FETCH_OBJ);
    } */




    public $resultado;
    

    static public function mdlRegistrarCompra($datos){

        date_default_timezone_set('America/Guatemala');
        $fecha_compra = date("Y-m-d H:i:s");
    

            $stmt = Conexion::conectar()->prepare("UPDATE empresa SET nro_correlativo_venta = LPAD(nro_correlativo_venta + 1,8,'0')");

            if($stmt -> execute()){

                $listaProductos = [];

                for ($i = 0; $i < count($datos); ++$i){
                    
                    $listaProductos = explode(",",$datos[$i]);

                  // validar si los datos estan llegando hasta aqui con el return lista.....
                  //return $listaProductos;
                   //return("PAUSE");
        
                    $stmt = Conexion::conectar()->prepare("INSERT INTO compras(
                                                        codigo_producto,
                                                        categoria,
                                                        descripcion,
                                                        cantidad,
                                                        precio_compra,
                                                        total_compra,
                                                        fecha_compra,
                                                        comentarios)         
                                                        VALUES(:codigo_producto,
                                                        :categoria, 
                                                        :descripcion,
                                                        :cantidad, 
                                                        :precio_compra, 
                                                        :total_compra, 
                                                        :fecha_compra,
                                                        :comentarios)");
        
               
        $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
        $stmt -> bindParam(":categoria", $listaProductos[1] , PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion",$listaProductos[2] , PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad",$listaProductos[3] , PDO::PARAM_STR);
        $stmt -> bindParam(":precio_compra", $listaProductos[4] , PDO::PARAM_STR);
        $stmt -> bindParam(":total_compra",$listaProductos[5] , PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_compra",$fecha_compra , PDO::PARAM_STR);
        $stmt -> bindParam(":comentarios", $listaProductos[6] , PDO::PARAM_STR);

      //  return $listaProductos;
        
        
                    if($stmt -> execute()){
                        
                     //   return "Todo ok hasta aqui";
                        $stmt = null;

                        //aumentar el stock despues de la compra y modificar el ultimo precio registrado en la compra
                        $stmt = Conexion::conectar()->prepare("UPDATE productos SET stock_producto = stock_producto + :cantidad,
                                                            precio_compra_producto = :precio_compra
                                                             WHERE codigo_producto = :codigo_producto");
        
                        $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
                        $stmt -> bindParam(":cantidad", $listaProductos[3] , PDO::PARAM_STR);
                        $stmt -> bindParam(":precio_compra", $listaProductos[4] , PDO::PARAM_STR);
        
                        if($stmt -> execute()){
                            $resultado = "Se registró la compra correctamente.";
                            
                        }else{
                            $resultado = "Error al actualizar el stock";
                        }
                        
                    }else{
                        $resultado = "Error al registrar la compra";
                    }   
                }
        
        
                 return $resultado;
        
                 $stmt = null;
            }
            
        }



    
}