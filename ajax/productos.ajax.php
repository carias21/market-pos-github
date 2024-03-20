<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../vendor/autoload.php";

class ajaxProductos
{

    public $fileProductos;
    public $name;
    public $img;
    public $codigo_producto;

    public $foto;
    public $id_categoria_producto;
    public $descripcion_producto;
    public $precio_compra_producto;
    public $precio_venta_producto;
    public $utilidad;
    public $stock_producto;
    public $minimo_stock_producto;
    public $ventas_producto;
    public $id_proveedor;

    public $cantidad_a_comprar;


    public function ajaxCargaMasivaProductos()
    {

        $respuesta = ProductosControlador::ctrCargaMasivaProductos($this->fileProductos);

        echo json_encode($respuesta);
    }

    public function ajaxListarProductos()
    {


        $productos = ProductosControlador::ctrListarProductos();

        echo json_encode($productos);
    }

    public function ajaxRegistrarProducto()
    {

        $img = $_FILES['imagen'];

        $name = $img['name'];
        $tmpname = $img['tmp_name'];

        $destino = $_SERVER['DOCUMENT_ROOT'] . '/market-pos-github/vistas/assets/imagenes/' . $name;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        if (empty($name)) {
            $name = "default.png";
            // echo json_encode($destino);

        }


        $producto = ProductosControlador::ctrRegistrarProducto(
            $this->codigo_producto,
            $this->id_categoria_producto,
            $this->descripcion_producto,
            $this->id_proveedor,
            $this->precio_compra_producto,
            $this->precio_venta_producto,
            $this->utilidad,
            $this->stock_producto,
            $this->minimo_stock_producto,
            $this->ventas_producto,
            $name,
            $img,
            $tmpname,
            $destino


        );

        echo json_encode($producto);
    }

    public function ajaxActualizarStock($data)
    {

        $table = "productos";
        $id = $_POST["codigo_producto"];
        $nameId = "codigo_producto";

        $respuesta = ProductosControlador::ctrActualizarStock($table, $data, $id, $nameId);

        echo json_encode($respuesta);
    }

    public function ajaxActualizarProducto($data)
    {

        //datos para la tabla
        $table = "productos";
        $id = $_POST["codigo_producto"];
        $nameId = "codigo_producto";

        //datos para cambiar nueva imagen al momento de editarla
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $destino = $_SERVER['DOCUMENT_ROOT'] . '/market-pos-github/vistas/assets/imagenes/' . $name;

        //si el usuario quita la imagen, por defecto seria default.png
        if (empty($name)) {
            $data['foto'] = "default.png";
        }

        if (!empty($_POST['foto_delete'])) {
            $data['foto'] = ($_POST['foto_actual']);
            $respuesta = ProductosControlador::ctrActualizarProducto($table, $data, $id, $nameId);
            echo json_encode($respuesta);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        } else if ($_POST['foto_actual'] != $_POST['foto_delete']) {

            $respuesta = ProductosControlador::ctrActualizarProducto($table, $data, $id, $nameId);
            echo json_encode($respuesta);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
            // echo json_encode("entro foto actual");
        } else {
            echo json_encode("no pasaron los datos");
        }
    }




    public function ajaxActualizarInventarioActual($foto)
    {

        $codigo_producto = $_POST["codigo_producto"];

        //datos para cambiar nueva imagen al momento de editarla
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $destino = $_SERVER['DOCUMENT_ROOT'] . '/market-pos-github/vistas/assets/imagenes/' . $name;

        //si el usuario quita la imagen, por defecto seria default.png
        if (empty($name)) {
            $foto = "default.png";

        }

        if (!empty($_POST['foto_delete'])) {
            $foto = ($_POST['foto_actual']);
            $respuesta = ProductosControlador::ctrActualizarInventarioActual($codigo_producto, $foto);
            echo json_encode($respuesta);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        } else if ($_POST['foto_actual'] != $_POST['foto_delete']) {

            $respuesta = ProductosControlador::ctrActualizarInventarioActual($codigo_producto,$foto);
            echo json_encode($respuesta);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
            // echo json_encode("entro foto actual");
        } else {
            echo json_encode("no pasaron los datos");
        }
    }

    public function ajaxEliminarProducto()
    {

        $table = "productos";
        $id = $_POST["codigo_producto"];
        $nameId = "codigo_producto";

        $respuesta = ProductosControlador::ctrEliminarProducto($table, $id, $nameId);

        echo json_encode($respuesta);
    }

    /*LISTAR EL NOMBRE DE PRODUCTOS PARA EL INPUT DE AUTO COMPLETADO ----- */
    //VD 15 MIN 26:35
    public function ajaxListarNombreProductos()
    {
   $NombreProductos = ProductosControlador::ctrListarNombreProductos();
        echo json_encode($NombreProductos);
    }
    //BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    public function ajaxGetDatosProducto()
    {
        $producto = ProductosControlador::ctrGetDatosProducto($this->codigo_producto);
        echo json_encode($producto);
    }

    public function ajaxVerificaStockProducto()
    {

        $respuesta = ProductosControlador::ctrVerificaStockProducto($this->codigo_producto, $this->cantidad_a_comprar);

        echo json_encode($respuesta);
    }

    public function ajaxInventarioActual()
    {


        $inventario_actual = ProductosControlador::ctrInventarioActual();

        echo json_encode($inventario_actual);
    }
}




if (isset($_POST['accion']) && $_POST['accion'] == 1) { //parametro para listar los productos

    $productos = new ajaxProductos();
    $productos->ajaxListarProductos();
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) { //parametro para registrar un nuevo producto

    $registrarProducto = new AjaxProductos();
    $registrarProducto->codigo_producto = $_POST["codigo_producto"];
    $registrarProducto->id_categoria_producto = $_POST["id_categoria_producto"];
    $registrarProducto->descripcion_producto = $_POST["descripcion_producto"];
    $registrarProducto->id_proveedor = $_POST["id_proveedor"];
    $registrarProducto->precio_compra_producto = $_POST["precio_compra_producto"];
    $registrarProducto->precio_venta_producto = $_POST["precio_venta_producto"];
    $registrarProducto->utilidad = $_POST["utilidad"];
    $registrarProducto->stock_producto = $_POST["stock_producto"];
    $registrarProducto->minimo_stock_producto = $_POST["minimo_stock_producto"];
    $registrarProducto->ventas_producto = $_POST["ventas_producto"];
    $registrarProducto->img = $_FILES['imagen'];


    $registrarProducto->ajaxRegistrarProducto();
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { // parametro para actualizar el stock del producto

    $actualizarStock = new ajaxProductos();

    $data = array(
        "stock_producto" => $_POST["nuevoStock"]
    );
    $actualizarStock->ajaxActualizarStock($data);

    //VD 14 MIN 5:10
} else if (isset($_POST['accion']) && $_POST['accion'] == 4) { //ACCION ACTUALIZAR PRODUCTO GENERAL

    $actualizarProducto = new ajaxProductos();

    //obtenemos los valores para 
    $img = $_FILES['imagen'];

    $data = array(
        "id_categoria_producto" => $_POST["id_categoria_producto"],
        "descripcion_producto" => $_POST["descripcion_producto"],
        "precio_compra_producto" => $_POST["precio_compra_producto"],
        "precio_venta_producto" => $_POST["precio_venta_producto"],
        "utilidad" => $_POST["utilidad"],
        "stock_producto" => $_POST["stock_producto"],
        "minimo_stock_producto" => $_POST["minimo_stock_producto"],
        "foto" =>  $img['name'],
        "fk_id_proveedor" => $_POST["id_proveedor"],
    );

    $actualizarProducto->ajaxActualizarProducto($data);
} else if (isset($_POST['accion']) && $_POST['accion'] == 5) { //ACCION ELIMINAR PRODUCTO

    $eliminarProducto = new ajaxProductos();
    $eliminarProducto->ajaxEliminarProducto();
    //VD 15 MIN 25:45
} else if (isset($_POST["accion"]) && $_POST["accion"] == 6) { //traer listado de productos para el autocompletable del input
    $nombreProductos = new AjaxProductos();
    $nombreProductos->ajaxListarNombreProductos();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 7) {
    $listaProducto = new AjaxProductos();
    $listaProducto->codigo_producto = $_POST["codigo_producto"];
    $listaProducto->ajaxGetDatosProducto();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 8) { // VERIFICAR STOCK DEL PRODUCTO

    $verificaStock = new AjaxProductos();

    $verificaStock->codigo_producto = $_POST["codigo_producto"];
    $verificaStock->cantidad_a_comprar = $_POST["cantidad_a_comprar"];

    $verificaStock->ajaxVerificaStockProducto();
} else if (isset($_POST['accion']) && $_POST['accion'] == 10) { //LISTAR PRODUCTOS DE INVENTARIO ACTUAL DE CAJA

    $inventario_actual = new ajaxProductos();
    $inventario_actual->ajaxInventarioActual();
}else if (isset($_POST['accion']) && $_POST['accion'] == 11) { //ACCION ACTUALIZAR PRODUCTO INVENTARIO ACTUAL

    $actualizarInventarioActual = new ajaxProductos();

    $img = $_FILES['imagen'];

    $actualizarInventarioActual->codigo_producto = $_POST["codigo_producto"];
    $actualizarInventarioActual->foto =   $img['name'];

    $foto = $img['name'];

$actualizarInventarioActual->ajaxActualizarInventarioActual($foto);

} else if (isset($_FILES)) {
    $archivo_productos = new ajaxProductos();
    $archivo_productos->fileProductos = $_FILES['fileProductos'];
    $archivo_productos->ajaxCargaMasivaProductos();
}
