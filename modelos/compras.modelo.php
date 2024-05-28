<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class ComprasModelo
{

    public $resultado;

    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
       //VD 15 MIN 27:50
    ====================================================================*/
    static public function mdlListarNombreProductos($id_proveedor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT  codigo_producto,
                                                c.nombre_categoria,
                                                descripcion_producto,
                                                p.precio_compra_producto,
                                                p.stock_producto,
                                                foto
                                                FROM productos p 
                                                INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria
                                                WHERE fk_id_proveedor = :id_proveedor");


        $stmt->bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);
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

        $codigoProducto = explode(' / ', $codigoProducto)[0];

        $stmt = Conexion::conectar()->prepare("SELECT   '' as id_Item,
                                                        id,
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

        $stmt->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    static public function mdlRegistrarCompra($datos)
    {
        date_default_timezone_set('America/Guatemala');
        $fecha_compra = date("Y-m-d H:i:s");

        $listaProductos = [];

        for ($i = 0; $i < count($datos); ++$i) {
            $producto = explode(",", $datos[$i]);
            $listaProductos[] = $producto;
        }

        try {
            $conn = Conexion::conectar();
            // Configurar PDO para que lance excepciones en caso de errores.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();

            $stmtInsertCompras = $conn->prepare("INSERT INTO compras (codigo_producto,fk_id_categoria,fk_id_producto,cantidad,precio_compra,total_compra,fecha_compra,comentarios)
                                        VALUES (:codigo_producto,:id_categoria, :id,:cantidad, :precio_compra, :total_compra, :fecha_compra,:comentarios)");

            $stmtUpdateProductos = $conn->prepare("UPDATE productos SET stock_producto = stock_producto + :cantidad,precio_compra_producto = :precio_compra,precio_venta_producto = :precio_venta
                                        WHERE codigo_producto = :codigo_producto");

            foreach ($listaProductos as $producto) {

                $stmtInsertCompras->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":id_categoria", $producto[1], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":id", $producto[2], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":precio_compra", $producto[4], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":total_compra", $producto[6], PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":fecha_compra", $fecha_compra, PDO::PARAM_STR);
                $stmtInsertCompras->bindParam(":comentarios", $producto[7], PDO::PARAM_STR);

                $stmtUpdateProductos->bindParam(":codigo_producto", $producto[0], PDO::PARAM_STR);
                $stmtUpdateProductos->bindParam(":cantidad", $producto[3], PDO::PARAM_STR);
                $stmtUpdateProductos->bindParam(":precio_compra", $producto[4], PDO::PARAM_STR);
                $stmtUpdateProductos->bindParam(":precio_venta", $producto[5], PDO::PARAM_STR);

                $stmtInsertCompras->execute();
                $stmtUpdateProductos->execute();
            }

            $conn->commit();
            $resultado = "ok";
        } catch (PDOException $e) {
            $conn->rollBack();
            $resultado = "ERROR REGISTRAR COMPRA." . $e;
        }

        return $resultado;
    }
}
