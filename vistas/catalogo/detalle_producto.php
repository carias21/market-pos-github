<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catálogo</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

    <?php
    require_once  "navbar.php";

    ?>


    <?php
    require_once "./controladores/catalogo.controlador.php";
    require_once "./modelos/catalogo.modelo.php";

    if (isset($_GET['codigo'])) {
        $codigoProducto = $_GET['codigo'];
        $producto = CatalogoControlador::ctrListarProductos($codigoProducto);

        if ($producto) {
    ?>




            <div class="container">
                <div class="row">
                    <div></div>
                    <br>
                    <br>
                    <!-- Columna de la imagen del producto -->
                    <div class="col-md-6 mx-auto text-center">
                        <img src="../assets/imagenes/<?php echo $producto['foto']; ?>" class="img-fluid rounded shadow img-thumbnail" alt="<?php echo $producto['descripcion_producto']; ?>" style="max-height: 350px; max-width: 350px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    
                    <br>

                    <!-- Columna de detalles del producto -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h1><?php echo $producto['descripcion_producto']; ?></h1>
                            </div>


                            <div class="card-body">
                        <!--
<p>Precio Q. <span id="precioProducto" data-precio="<?php //echo $producto['precio_venta_producto']; ?>"><?php //echo $producto['precio_venta_producto']; ?>.00</span></p>
-->

                                <?php if ($producto['stock_producto'] == 0) : ?>
                                <p><span class="text-danger">&#10008;<strong>Agotado</strong> <span style="font-weight:bold;color:red;"></span></span></p>
                             
                            <?php else : ?>
                                <p><span class="text-success">&#10004; <strong>Disponible</strong></span></p>
                          
                            <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


    <?php
        } else {
            echo "<p class='text-center'>Producto no encontrado</p>";
        }
    } else {
        echo "<p class='text-center'>ID de producto no proporcionado</p>";
    }
    ?>
    <!-- Agrega los scripts al final del body -->
    <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Agrega tu script de acciones en JavaScript si es necesario -->
    <script src="path/to/tu-script.js"></script>



    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="./recursos/jquery-ui/css/jquery-ui.css">
<script src="./recursos/jquery-ui/js/jquery-ui.js"></script>