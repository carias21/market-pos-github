<?php
require_once "conexion.php";

class VentasModelo{

    public $resultado;

    static public function mdlRegistrarVenta($datos){

            $stmt = Conexion::conectar()->prepare("UPDATE empresa SET nro_correlativo_venta = LPAD(nro_correlativo_venta + 1,8,'0')");

            if($stmt -> execute()){

                $listaProductos = [];

                for ($i = 0; $i < count($datos); ++$i){
                    
                    $listaProductos = explode(",",$datos[$i]);

                  // validar si los datos estan llegando hasta aqui con el return lista.....
                  // return $listaProductos;
                    //return("PAUSE");
        
                    $stmt = Conexion::conectar()->prepare("INSERT INTO ventas(codigo_producto,
                                                        categoria,
                                                        descripcion,
                                                        cantidad,
                                                        precio_venta,
                                                        descuento_venta,
                                                        total_venta)         
                                                        VALUES(:codigo_producto,
                                                        :nombre_categoria, 
                                                        :descripcion_producto,
                                                        :cantidad, 
                                                        :precio_venta_producto, 
                                                        :descuento, 
                                                        :total_venta)");
        
                   // $stmt -> bindParam(":nro_boleta", $nro_boleta , PDO::PARAM_STR);
                   /* $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
                    $stmt -> bindParam(":cantidad", $listaProductos[1] , PDO::PARAM_STR);
                    $stmt -> bindParam(":total_venta", $listaProductos[2] , PDO::PARAM_STR); */

                  //  $stmt -> bindParam(":nro_boleta",$listaProductos[0] , PDO::PARAM_STR);
        $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
        $stmt -> bindParam(":nombre_categoria", $listaProductos[1] , PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion_producto",$listaProductos[2] , PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad",$listaProductos[3] , PDO::PARAM_STR);
        $stmt -> bindParam(":precio_venta_producto", $listaProductos[4] , PDO::PARAM_STR);
        $stmt -> bindParam(":descuento",$listaProductos[5] , PDO::PARAM_STR);
        $stmt -> bindParam(":total_venta", $listaProductos[6] , PDO::PARAM_STR);

      //  return $listaProductos;
        
       //return "Todo ok hasta aqui";
        
                    if($stmt -> execute()){
                     //   return "Todo ok hasta aqui";
                        $stmt = null;
        
                        //disminuimos el stock despues de la venta
                        $stmt = Conexion::conectar()->prepare("UPDATE PRODUCTOS SET stock_producto = stock_producto - :cantidad, ventas_producto = ventas_producto + :cantidad
                                                                WHERE codigo_producto = :codigo_producto");
        
                        $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
                        $stmt -> bindParam(":cantidad", $listaProductos[3] , PDO::PARAM_STR);
        
                        if($stmt -> execute()){
                            $resultado = "Se registró la venta correctamente.";
                            
                        }else{
                            $resultado = "Error al actualizar el stock";
                        }
                        
                    }else{
                        $resultado = "Error al registrar la venta";
                    }   
                }
        
        
                 return $resultado;
        
                 $stmt = null;
            }
            
        }

       
    }



   
