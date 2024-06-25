<?php


require_once "./modelos/conexion.php";

require_once "./controladores/catalogo.controlador.php";
require_once "./modelos/catalogo.modelo.php";

$conn = Conexion::conectar();


$resultados_por_pagina = 20;
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual, por defecto es la primera
$inicio = ($pagina_actual - 1) * $resultados_por_pagina; // Índice de inicio para la consulta SQL

$sql = "SELECT codigo_producto, descripcion_producto, foto, stock_producto, precio_venta_producto FROM productos  ORDER BY RAND() LIMIT $inicio, $resultados_por_pagina";
$result = $conn->query($sql);

$sql_contar = "SELECT COUNT(*) AS total FROM productos";
$result_contar = $conn->query($sql_contar);
$total_productos = $result_contar->fetch(PDO::FETCH_ASSOC)['total'];


$total_paginas = ceil($total_productos / $resultados_por_pagina);

$productos = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $productos[] = $row;
}


$sqlSlider = "SELECT foto, descripcion FROM catalogo  ORDER BY RAND()";
$resultadoSqlSlider = $conn->query($sqlSlider);

$productosSlider = [];
while ($row = $resultadoSqlSlider->fetch(PDO::FETCH_ASSOC)) {
    $productosSlider[] = $row;
}


$obtenerDatoMostrarOcultarPrecio_Existencia = CatalogoControlador::ctrobtenerDatoMostrarOcultarPrecio_Existencia();

?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CATALOGO</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Domine:wght@400;700&display=swap">
</head>

<body>
    <?php
    require_once  "./navbar.php";
    ?>

    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php
            foreach ($productosSlider as $index => $productoSlider) {
                $activeClass = ($index == 0) ? 'active' : '';
                $textoPresente = !empty($productoSlider['descripcion']);
            ?>

                <div class="carousel-item <?= $activeClass ?>">
                    <div class="row">
                        <?php if ($textoPresente) { ?>
                            <div class="col-md-4 col-sm-12">
                            <?php } else { ?>
                                <div class="col-12">
                                <?php } ?>
                                <img src="../assets/imagenes/slider/<?= $productoSlider['foto'] ?>" class="d-block mx-auto img-thumbnail rounded shadow" alt="<?= $productoSlider['descripcion'] ?>" style="max-width: 400px; max-height: 400px;">
                                </div>
                                <?php if ($textoPresente) { ?>
                                    <div class="col-md-8 col-sm-12">
                                        <!-- En dispositivos medianos y grandes, el texto se muestra al lado de la imagen -->
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5 class="textoSlider text-center mt-3"><?= $productoSlider['descripcion'] ?></h5>
                                        </div>
                                        <!-- En dispositivos pequeños, el texto se muestra debajo de la imagen -->
                                        <div class="d-md-none">
                                            <h5 class="textoSlider text-center mt-3"><?= $productoSlider['descripcion'] ?></h5>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                    </div>

                <?php
            }
                ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>




        <br>
        <div class="container">
            <div class="card card-info text-center border-info border-3">
                <h1 class="text-center">PRODUCTOS</h1>
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



                                <?php if ($obtenerDatoMostrarOcultarPrecio_Existencia[0]['datoPrecio']  == 1) : ?>
                                    <!-- Mostrar el precio en negrita, color azul oscuro y tamaño de texto pequeño -->
                                    <h5 style="font-weight: bold; color: #003366; font-size: 14px;">Q.<?= number_format($producto['precio_venta_producto'], 2, '.', ',') ?></h5>
                                <?php else : ?>
                                    <!-- No hacer nada si $precio no es igual a 1 -->
                                <?php endif; ?>




                                <a href="detalle_producto.php?codigo=<?= $producto['codigo_producto'] ?>" class="btn btn-info">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Paginación -->



            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                    <!-- Botón para ir a la página anterior -->
                    <li class="page-item <?= ($pagina_actual <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina_actual - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <!-- Mostrar páginas anteriores a la actual -->
                    <?php for ($i = max(1, $pagina_actual - 2); $i < $pagina_actual; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Mostrar página actual -->
                    <li class="page-item active">
                        <a class="page-link" href="?pagina=<?= $pagina_actual ?>"><?= $pagina_actual ?></a>
                    </li>

                    <!-- Mostrar páginas siguientes a la actual -->
                    <?php for ($i = $pagina_actual + 1; $i <= min($total_paginas, $pagina_actual + 2); $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Si hay más de 5 páginas, mostrar el botón "Siguiente" -->
                    <?php if ($pagina_actual < $total_paginas) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?= $pagina_actual + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>




        </div>

        <!-- Enlace a Bootstrap JS y Popper.js -->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="./recursos/jquery-ui/css/jquery-ui.css">
<link rel="stylesheet" href="./recursos/jquery-ui/css/misestilos.css">
<script src="./recursos/jquery-ui/js/jquery-ui.js"></script>