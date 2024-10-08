<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class ProductosModelo
{

    /*===================================================================
    REALIZAR LA CARGA MASIVA DE PRODUCTOS MEDIANTE ARCHIVO EXCEL
    ====================================================================*/
    static public function mdlCargaMasivaProductos($fileProductos)
    {
        $nombreArchivo = $fileProductos['tmp_name'];

        $documento = IOFactory::load($nombreArchivo);

        $hojaCategorias = $documento->getSheet(1);
        $numeroFilasCategorias = $hojaCategorias->getHighestDataRow();

        $hojaProductos = $documento->getSheetByName("Productos");
        $numeroFilasProductos = $hojaProductos->getHighestDataRow();

        $categoriasRegistradas = 0;
        $productosRegistrados = 0;

        //CICLO FOR PARA REGISTROS DE CATEGORIAS
        for ($i = 2; $i <= $numeroFilasCategorias; $i++) {

            $categoria = $hojaCategorias->getCellByColumnAndRow(1, $i);
            $aplica_peso = $hojaCategorias->getCellByColumnAndRow(2, $i);
            $fecha_actualizacion = date("Y-m-d");

            if (!empty($categoria)) {
                $stmt = Conexion::conectar()->prepare("INSERT INTO categorias(nombre_categoria,
                                                                                aplica_peso,
                                                                                fecha_actualizacion_categoria)
                                                                    values(:nombre_categoria,
                                                                            :aplica_peso,
                                                                            :fecha_actualizacion_categoria);");

                $stmt->bindParam(":nombre_categoria", $categoria, PDO::PARAM_STR);
                $stmt->bindParam(":aplica_peso", $aplica_peso, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_actualizacion_categoria", $fecha_actualizacion, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $categoriasRegistradas = $categoriasRegistradas + 1;
                } else {
                    $categoriasRegistradas = 0;
                }
            }
        }

        if ($categoriasRegistradas > 0) {

            //CICLO FOR PARA REGISTROS DE PRODUCTOS
            for ($i = 2; $i <= $numeroFilasProductos; $i++) {

                $codigo_producto = $hojaProductos->getCell("A" . $i);
                $id_categoria_producto = ProductosModelo::mdlBuscarIdCategoria($hojaProductos->getCell("B" . $i));
                $descripcion_producto = $hojaProductos->getCell("C" . $i);
                $precio_compra_producto = $hojaProductos->getCell("D" . $i);
                $precio_venta_producto = $hojaProductos->getCell("E" . $i);
                $utilidad = $hojaProductos->getCell("F" . $i);
                $stock_producto = $hojaProductos->getCell("G" . $i);
                $minimo_stock_producto = $hojaProductos->getCell("H" . $i);
                $ventas_producto = $hojaProductos->getCell("I" . $i);
                $fecha_actualizacion_producto = date('Y-m-d');
                $foto = $hojaProductos->getCell("J" . $i);
                $fk_id_proveedor = $hojaProductos->getCell("K" . $i);

                if (!empty($codigo_producto)) {
                    $stmt = Conexion::conectar()->prepare("INSERT INTO productos(codigo_producto,
                                                                                id_categoria_producto,
                                                                                descripcion_producto,
                                                                                precio_compra_producto,
                                                                                precio_venta_producto,
                                                                                utilidad,
                                                                                stock_producto,
                                                                                minimo_stock_producto,
                                                                                ventas_producto,
                                                                                fecha_actualizacion_producto, 
                                                                                foto,
                                                                                fk_id_proveedor)
                                                                        values(:codigo_producto,
                                                                                :id_categoria_producto,
                                                                                :descripcion_producto,
                                                                                :precio_compra_producto,
                                                                                :precio_venta_producto,
                                                                                :utilidad,
                                                                                :stock_producto,
                                                                                :minimo_stock_producto,
                                                                                :ventas_producto,
                                                                                :fecha_actualizacion_producto,
                                                                                :foto,
                                                                                :fk_id_proveedor);");

                    $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":id_categoria_producto", $id_categoria_producto[0], PDO::PARAM_STR);
                    $stmt->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":precio_compra_producto", $precio_compra_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":precio_venta_producto", $precio_venta_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
                    $stmt->bindParam(":stock_producto", $stock_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":minimo_stock_producto", $minimo_stock_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":ventas_producto", $ventas_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":fecha_actualizacion_producto", $fecha_actualizacion_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);
                    $stmt->bindParam(":fk_id_proveedor", $fk_id_proveedor, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        $productosRegistrados = $productosRegistrados + 1;
                    } else {
                        $productosRegistrados = 0;
                    }
                }
            }
        }

        $respuesta["totalCategorias"] = $categoriasRegistradas;
        $respuesta["totalProductos"] = $productosRegistrados;

        return $respuesta;
    }




    /*===================================================================
    BUSCAR EL ID DE UNA CATEGORIA POR EL NOMBRE DE LA CATEGORIA PARA LA CARGA MASIVA
    ====================================================================*/
    static public function mdlBuscarIdCategoria($nombreCategoria)
    {

        $stmt = Conexion::conectar()->prepare("select id_categoria from categorias where nombre_categoria = :nombreCategoria");
        $stmt->bindParam(":nombreCategoria", $nombreCategoria, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    /*===================================================================
    OBTENER LISTADO TOTAL DE PRODUCTOS PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarProductos()
    {

        $stmt = Conexion::conectar()->prepare('call prc_ListarProductos');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL INVENTARIO
    ====================================================================*/
    static public function mdlRegistrarProducto(
        $codigo_producto,
        $id_categoria_producto,
        $descripcion_producto,
        $id_proveedor,
        $precio_compra_producto,
        $precio_venta_producto,
        $utilidad,
        $stock_producto,
        $minimo_stock_producto,
        $ventas_producto,
        $name
    ) {


        date_default_timezone_set('America/Guatemala');
        $fecha_registro = date("Y-m-d");

        try {

            $stmt = Conexion::conectar()->prepare("INSERT INTO productos(codigo_producto, 
                                                                        id_categoria_producto, 
                                                                        descripcion_producto, 
                                                                        precio_compra_producto, 
                                                                        precio_venta_producto, 
                                                                        utilidad, 
                                                                        stock_producto, 
                                                                        minimo_stock_producto, 
                                                                        ventas_producto,
                                                                        fecha_creacion_producto,
                                                                        fecha_actualizacion_producto,
                                                                        foto, fk_id_proveedor) 
                                                VALUES (:codigo_producto, 
                                                        :id_categoria_producto, 
                                                        :descripcion_producto, 
                                                        :precio_compra_producto, 
                                                        :precio_venta_producto, 
                                                        :utilidad, 
                                                        :stock_producto, 
                                                        :minimo_stock_producto, 
                                                        :ventas_producto,
                                                        :fecha_creacion_producto,
                                                        :fecha_actualizacion_producto,
                                                        :foto, 
                                                        :fk_id_proveedor)");

            $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria_producto", $id_categoria_producto, PDO::PARAM_INT);
            $stmt->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra_producto", $precio_compra_producto, PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta_producto", $precio_venta_producto, PDO::PARAM_STR);
            $stmt->bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
            $stmt->bindParam(":stock_producto", $stock_producto, PDO::PARAM_STR);
            $stmt->bindParam(":minimo_stock_producto", $minimo_stock_producto, PDO::PARAM_STR);
            $stmt->bindParam(":ventas_producto", $ventas_producto, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_creacion_producto", $fecha_registro, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_actualizacion_producto", $fecha_registro, PDO::PARAM_STR);
            $stmt->bindParam(":foto",  $name, PDO::PARAM_STR);
            $stmt->bindParam(":fk_id_proveedor", $id_proveedor, PDO::PARAM_INT);


            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;

        $stmt = null;
    }

    static public function mdlActualizarInformacion($table, $data, $id, $nameId)
    {



        $set = "";

        foreach ($data as $key => $value) {

            $set .= $key . " = :" . $key . ",";
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {

            $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
        }

        $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return Conexion::conectar()->errorInfo();
        }
    }



    /*===================================================================
    ACTUALIZAR INVENTARIO ACTUAL FOTO
    ====================================================================*/
    static public function mdlActualizarInventarioActual($codigo_producto, $foto)
    {



        try {
            $stmt = Conexion::conectar()->prepare("UPDATE productos SET foto = :foto WHERE codigo_producto = :codigo_producto");

            $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/


    static public function mdlEliminarInformacion($table, $id, $nameId)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

            $stmt->bindParam(":" . $nameId, $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->closeCursor(); // Cierra el cursor para liberar recursos
                return "ok";
            } else {
                $stmt->closeCursor(); // Cierra el cursor para liberar recursos
                return "error";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }



    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
       //VD 15 MIN 27:50
    ====================================================================*/
    static public function mdlListarNombreProductos($valor)
    {
        $palabras = explode(" ", $valor);
        $where = "";

        foreach ($palabras as $palabra) {
            // Aquí se incluye tanto la búsqueda por código como por descripción
            $where .= "(codigo_producto LIKE '%" . $palabra . "%' OR descripcion_producto LIKE '%" . $palabra . "%') AND ";
        }

        // Eliminar el último "AND"
        $where = rtrim($where, "AND ");

        try {
            $stmt = Conexion::conectar()->prepare("SELECT 
                                                        codigo_producto,
                                                        c.nombre_categoria,
                                                        p.descripcion_producto,
                                                        p.precio_venta_producto,
                                                        p.stock_producto,
                                                        foto
                                                    FROM productos p
                                                    INNER JOIN categorias c on p.id_categoria_producto = c.id_categoria
                                                    WHERE $where AND p.stock_producto > 0");

            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $productData = array();
            foreach ($productos as $producto) {
                $codigo_producto = htmlspecialchars($producto["codigo_producto"]);
                $nombre_categoria = htmlspecialchars($producto["nombre_categoria"]);
                $descripcion_producto = htmlspecialchars($producto["descripcion_producto"]);
                $precio_venta_producto = htmlspecialchars($producto["precio_venta_producto"]);
                $stock_producto = htmlspecialchars($producto["stock_producto"]);
                $foto = htmlspecialchars($producto['foto']);

                $data = array(
                    "id" => $codigo_producto,
                    "value" => $codigo_producto . ' / ' . $nombre_categoria . ' / ' . $descripcion_producto . ' / ' .
                        $precio_venta_producto . ' / ' . $stock_producto,
                    "label" => '
                    <a href="javascript:void(0);" class="d-flex" style="width:100% !important;">
                        <img src="vistas/assets/imagenes/' . $foto . '" width="70" height="70"/> 
                        <div class="d-flex ml-4 flex-column">
                            <span class="text-sm"><strong>Codigo:</strong> ' . $codigo_producto . '  -  <strong>Producto:</strong> ' . $descripcion_producto . '</span>
                            <span class="text-sm"><strong>Precio:</strong> Q.' . round($precio_venta_producto, 2) . '  -  <strong>Categoría:</strong> ' . $nombre_categoria . '</span>
                            <span class="text-sm"><strong>Stock:</strong> ' . $stock_producto . '</span>
                        </div>
                    </a>'
                );

                array_push($productData, $data);
            }

            return $productData;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return array();
        }
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
                                                        codigo_producto,
                                                        c.id_categoria,                                                        
                                                        c.nombre_categoria,
                                                        descripcion_producto,
                                                        '1' as cantidad,
                                                        CONCAT('Q. ',CONVERT(ROUND(precio_venta_producto,2), CHAR)) as precio_venta_producto,
                                                        '0.00' as descuento,
                                                        CONCAT('Q. ',CONVERT(ROUND(1*precio_venta_producto,2), CHAR)) as total,
                                                        '' as acciones,
                                                        c.aplica_peso,
                                                        p.foto,
                                                        precio_compra_producto
                                                FROM productos p inner join categorias c on p.id_categoria_producto = c.id_categoria
                                            WHERE codigo_producto = :codigoProducto
                                                AND p.stock_producto > 0");

        $stmt->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }




    static public function mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar, $valor)
    {


        if (!empty($valor)) {
 


            if ($valor == 2) {
               
                $stmt = Conexion::conectar()->prepare("SELECT count(*) as existe
                                                        FROM productos p 
                                                       WHERE p.codigo_producto = :codigo_producto
                                                         AND p.stock_producto >= :cantidad_a_comprar");

                $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
                $stmt->bindParam(":cantidad_a_comprar", $cantidad_a_comprar, PDO::PARAM_INT);

                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            } elseif ($valor == 3) {


                $stmt = Conexion::conectar()->prepare("SELECT count(*) as existe
                                                        FROM productos p 
                                                       WHERE p.codigo_producto = :codigo_producto
                                                         AND p.stock_producto > :cantidad_a_comprar");

                $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
                $stmt->bindParam(":cantidad_a_comprar", $cantidad_a_comprar, PDO::PARAM_INT);

                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        }

        return null; // Retorna null si $valor no es 0 ni 1
    }


    /*===================================================================
    LISTAR INVENTARIO ACTUAL DEL MODULO DE INVENTARIO ACTUAL CAJA
    ====================================================================*/
    static public function mdlInventarioActual()
    {
        $stmt = Conexion::conectar()->prepare("SELECT
            codigo_producto,
            foto,
            c.nombre_categoria,
            descripcion_producto,
            stock_producto,
            CONCAT('Q.', ROUND(precio_venta_producto, 2)) as precio_venta_producto 
            FROM productos
            INNER JOIN categorias c ON c.id_categoria = id_categoria_producto;");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
