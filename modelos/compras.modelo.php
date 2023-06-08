<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class ComprasModelo
{


    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
       //VD 15 MIN 27:50
    ====================================================================*/
    static public function mdlListarNombreProductos()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  codigo_producto,
                                                c.nombre_categoria,
                                                descripcion_producto,
                                                p.precio_compra_producto,
                                                p.stock_producto,
                                                foto
                                                FROM productos p 
                                                INNER JOIN categorias c on p.id_categoria_producto = c.id_categoria");
        $stmt->execute();
        $productos = $stmt->fetchAll();


        $productData = array();
        foreach ($productos as $producto) {
            $codigo_producto = $producto["codigo_producto"];
            $nombre_categoria = $producto["nombre_categoria"];
            $descripcion_producto = $producto["descripcion_producto"];
            $precio_venta_producto = $producto["precio_compra_producto"];
            $stock_producto = $producto["stock_producto"];

            $data["id"] = $producto["codigo_producto"];
            $data["value"] = $codigo_producto . ' / ' . $nombre_categoria . ' / ' . $descripcion_producto . ' / ' .
                $precio_venta_producto . ' / ' . $stock_producto;
            $data["label"] = '
            <a href="javascript:void(0);" class="d-flex" style="width:100% !important;">
            <img src="vistas/assets/imagenes/' . $producto['foto'] . '" width="70" height="70"/> 
            <div class="d-flex ml-4 flex-column">
            <span class="text-sm"><strong>Codigo:</strong> ' . $codigo_producto . '  /  <strong>Producto:</strong> ' . $descripcion_producto . '</span>
            <span class="text-sm"><strong>Precio C:</strong> Q.' . round($precio_venta_producto, 2) . ' / <strong>Categoría:</strong> ' . $nombre_categoria . '</span>

            <span class="text-sm"><strong>' . 'Stock: </strong>' . $stock_producto . '</span>
            </div>
            </a>';

            array_push($productData, $data);
        }
        return $productData;
    }

    /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS, AGREGA LISTADO AL DATA TABLE VENTAS
    VD 15 MIN 39
    ====================================================================*/
    static public function mdlGetDatosProducto($codigoProducto)
    {

        $stmt = Conexion::conectar()->prepare("SELECT   id,
                                                        p.codigo_producto,
                                                        c.id_categoria,                                                        
                                                        c.nombre_categoria,
                                                        descripcion_producto,
                                                        '1' as cantidad,
                                                        CONCAT(CONVERT(ROUND(p.precio_compra_producto,2), CHAR)) as precio_compra_producto,
                                                        CONCAT(CONVERT(ROUND(p.precio_venta_producto,2), CHAR)) as precio_venta_producto,
                                                        CONCAT('Q. ', CONVERT(ROUND(1*p.precio_compra_producto,2), CHAR)) as total,
                                                        '' as acciones,
                                                        '' as comentarios,
                                                        p.foto
        
            FROM productos p inner join categorias c on p.id_categoria_producto = c.id_categoria
            WHERE p.codigo_producto = :codigoProducto");

        $stmt->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public $resultado;


    static public function mdlRegistrarCompra($datos){
        date_default_timezone_set('America/Guatemala');
        $fecha_compra = date("Y-m-d H:i:s");

        $listaProductos = [];

        try {
            $conn = Conexion::conectar();
            $conn->beginTransaction();

            for ($i = 0; $i < count($datos); ++$i) {
                $listaProductos = explode(",", $datos[$i]);

                $stmt = $conn->prepare("INSERT INTO compras (
                                            codigo_producto,
                                            categoria,
                                            descripcion,
                                            cantidad,
                                            precio_compra,
                                            total_compra,
                                            fecha_compra,
                                            comentarios
                                        )
                                        VALUES (
                                            :codigo_producto,
                                            :categoria, 
                                            :descripcion,
                                            :cantidad, 
                                            :precio_compra, 
                                            :total_compra, 
                                            :fecha_compra,
                                            :comentarios
                                        )");

                $stmt->bindParam(":codigo_producto", $listaProductos[0], PDO::PARAM_STR);
                $stmt->bindParam(":categoria", $listaProductos[1], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion", $listaProductos[2], PDO::PARAM_STR);
                $stmt->bindParam(":cantidad", $listaProductos[3], PDO::PARAM_STR);
                $stmt->bindParam(":precio_compra", $listaProductos[4], PDO::PARAM_STR);
                $stmt->bindParam(":total_compra", $listaProductos[6], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_compra", $fecha_compra, PDO::PARAM_STR);
                $stmt->bindParam(":comentarios", $listaProductos[7], PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $stmt = null;

                    $stmt = $conn->prepare("UPDATE productos 
                                            SET stock_producto = stock_producto + :cantidad,
                                                precio_compra_producto = :precio_compra,
                                                precio_venta_producto = :precio_venta
                                            WHERE codigo_producto = :codigo_producto");

                    $stmt->bindParam(":codigo_producto", $listaProductos[0], PDO::PARAM_STR);
                    $stmt->bindParam(":cantidad", $listaProductos[3], PDO::PARAM_STR);
                    $stmt->bindParam(":precio_compra", $listaProductos[4], PDO::PARAM_STR);
                    $stmt->bindParam(":precio_venta", $listaProductos[5], PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        $resultado = "ok";
                    } else {
                        $resultado = "error_stock";
                        break; // Salir del bucle en caso de error
                    }
                } else {
                    $resultado = "error";
                    break; // Salir del bucle en caso de error
                }
            }

            if ($resultado === "ok") {
                $conn->commit();
            } else {
                $conn->rollBack();
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "error: Se produjo un error al registrar la compra.";
            // Aquí puedes agregar código para registrar el mensaje de error completo en un archivo de registro o mostrar un mensaje de error más específico según tus necesidades.
        }

        return $resultado;
    }
}
