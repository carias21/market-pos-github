
<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class CatalogoModelo
{



    static public function mdlListarCategoriaId($id_categoria)
    {

        $stmt = Conexion::conectar()->prepare("SELECT 
        p.codigo_producto,
        p.id_categoria_producto,
        c.nombre_categoria,
        p.descripcion_producto,
        p.precio_venta_producto,
        p.stock_producto,
        p.foto
    FROM productos p
    INNER JOIN categorias c ON c.id_categoria = p.id_categoria_producto
    WHERE p.id_categoria_producto = :id_categoria
    order BY nombre_categoria ASC
    ");

        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_STR);
        $stmt->execute();

        $producto = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $producto;
    }


    static public function mdlListarProductos($codigoProducto)
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
          codigo_producto,
          descripcion_producto,
          precio_venta_producto,

          stock_producto,
          foto
      FROM productos
      WHERE codigo_producto = :codigoProducto");

        $stmt->bindParam(':codigoProducto', $codigoProducto, PDO::PARAM_STR);
        $stmt->execute();

        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $producto;
    }



    static public function mdlListarNombreProductos()
    {


        $stmt = Conexion::conectar()->prepare("SELECT  codigo_producto, c.nombre_categoria,
                                            descripcion_producto,
                                            foto
                                        FROM productos
                                        inner join categorias c on c.id_categoria = id_categoria_producto");



        $stmt->execute();
        $productos = $stmt->fetchAll();


        $productData = array();
        foreach ($productos as $producto) {



            $descripcion_producto = $producto["descripcion_producto"];
            $data["id"] = $producto["codigo_producto"];
            $categoria = $producto["nombre_categoria"];
            $data["value"] = $categoria;
            $data["value"] = $descripcion_producto;
            $data["label"] = '<a href="javascript:void(0);" class="d-flex producto-link" style="width:100%; text-decoration: none; border: 5px solid #ddd; border-radius: 50px; padding: 10px; transition: box-shadow 0.3s;">
            <img src="../assets/imagenes/' . $producto['foto'] . '" width="100" height="100" style="border-radius: 10%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"/>
            <div class="d-flex flex-column ml-4">
            <span style="font-size: 20px; "><strong>Categoría:</strong> ' . $categoria . '</span>
            <span style="font-size: 20px;"><strong>Producto:</strong> ' . $descripcion_producto . '</span>
            </div>
            </a>';



            array_push($productData, $data);
        }
        return $productData;
    }




    static public function mdlListarCategorias()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  id_categoria, nombre_categoria, aplica_peso as medida,
                                                date(fecha_creacion_categoria) as fecha_creacion_categoria,
                                                fecha_actualizacion_categoria,
        '' as opciones
         FROM categorias c order BY nombre_categoria ASC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlListarNombreProductosSlick()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  codigo_producto, descripcion_producto, foto
                                        
         FROM productos ORDER BY  RAND()  LIMIT 15");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
