<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CATEGORIAS</title>
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

    if (isset($_GET['id'])) {
        $id_categoria = $_GET['id'];

        $productos = CatalogoControlador::ctrListarCategoriaId($id_categoria); // Corrección aquí
        if ($productos) {
    ?>
        <br>
            <div class="container">
                <div class="card card-info text-center border-info border-3">
                    <?php if (!empty($productos)) : ?>
                        <h2 class="text-center" id="txtCategoria"><?= $productos[0]['nombre_categoria'] ?></h2>
                    <?php endif; ?>
                </div>
                <br>

                <div class="row">
                    <?php foreach ($productos as $producto) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card card-info text-center">
                                <img class="mimg" src="../assets/imagenes/<?= $producto['foto'] ?>" class="card-img-top mx-auto img-fluid rounded shadow img-thumbnail" alt="<?= $producto['descripcion_producto'] ?>" style="max-height: 150px; max-width: 150px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body">
                                    <h5 class="descripcion-producto"><?= $producto['descripcion_producto'] ?></h5>


                                    <?php if ($producto['stock_producto'] == 0) : ?>
                                        <p><span class="text-danger">&#10008;<strong>Agotado</strong> <span style="font-weight:bold;color:red;"></span></span></p>
                                    <?php else : ?>
                                        <p><span class="text-success">&#10004; <strong>Disponible</strong></span></p>
                                    <?php endif; ?>

                                    <a href="detalle_producto.php?codigo=<?= $producto['codigo_producto'] ?>" class="btn btn-info">Ver detalles</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
 
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="./recursos/jquery-ui/css/jquery-ui.css">
<link rel="stylesheet" href="./recursos/jquery-ui/css/misestilos.css">
<script src="./recursos/jquery-ui/js/jquery-ui.js"></script>


