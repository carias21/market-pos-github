
<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class CatalogoModelo
{




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


        $stmt = Conexion::conectar()->prepare("SELECT  codigo_producto,
                                            descripcion_producto,
                        
                                            foto
                                        FROM productos");



        $stmt->execute();
        $productos = $stmt->fetchAll();


        $productData = array();
        foreach ($productos as $producto) {



            $descripcion_producto = $producto["descripcion_producto"];
            $data["id"] = $producto["codigo_producto"];
            $data["value"] = $descripcion_producto;
            $data["label"] = '<a href="javascript:void(0);" class="d-flex producto-link" style="width:100% !important; text-decoration: none; color: #333;">
                            <img src="../assets/imagenes/' . $producto['foto'] . '" width="100" height="100" style="border-radius: 2px; object-fit: cover;"/>
                            <div class="d-flex ml-4 flex-column">
                                <div style="font-size: 25px; text-align: center;"><strong>Producto:</strong> ' . $descripcion_producto . '</div>
                            </div>
                        </a>';
    

            

            array_push($productData, $data);
        }
        return $productData;
    }





   

}
