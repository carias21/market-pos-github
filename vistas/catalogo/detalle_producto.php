<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catálogo</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlace a Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="./recursos/jquery-ui/css/jquery-ui.css">
    <link rel="stylesheet" href="./recursos/jquery-ui/css/misestilos.css">
</head>

<body>

    <?php require_once "navbar.php"; ?>

    <?php
    require_once "./controladores/catalogo.controlador.php";
    require_once "./modelos/catalogo.modelo.php";

    if (isset($_GET['codigo'])) {
        $obtenerDatoMostrarOcultarPrecio_Existencia = CatalogoControlador::ctrobtenerDatoMostrarOcultarPrecio_Existencia();
        $codigoProducto = $_GET['codigo'];
        $producto = CatalogoControlador::ctrListarProductos($codigoProducto);

        if ($producto) {
    ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center">
                        <img src="../assets/imagenes/<?php echo $producto['foto']; ?>" class="img-fluid rounded shadow img-thumbnail" alt="<?php echo $producto['descripcion_producto']; ?>" style="max-height: 350px; max-width: 350px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h1><?php echo $producto['descripcion_producto']; ?></h1>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 50%;">Precio</th>
                                        <th style="width: 50%;">Existencias</th>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: #003366;">
                                            <?php if ($obtenerDatoMostrarOcultarPrecio_Existencia[0]['datoPrecio'] == 1) : ?>
                                                <?php if ($producto['stock_producto'] == 0) : ?>
                                                    Q.<?= number_format($producto['precio_venta_producto'], 2, '.', ',') ?>
                                                <?php else : ?>
                                                    Q.<?= number_format($producto['precio_venta_producto'], 2, '.', ',') ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="text-warning"><strong>- Dato no disponible :(</strong></span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="font-weight: bold; color: #f59c11;">
                                            <?php if ($obtenerDatoMostrarOcultarPrecio_Existencia[0]['datoExistencia'] == 1) : ?>
                                                <?php if ($producto['stock_producto'] == 0) : ?>
                                                    <span class="text-danger">&#10008;<strong>Agotado</strong></span>
                                                <?php else : ?>
                                                    <?= $producto['stock_producto'] ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="text-warning"><strong>- Dato no disponible :( </strong></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>

                                <?php if ($producto['stock_producto'] == 0) : ?>
                                    <p><span class="text-danger">&#10008;<strong>Agotado</strong></span></p>
                                <?php else : ?>
                                    <p><span class="text-success">&#10004; <strong>Disponible</strong></span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider para otros productos -->
            <div class="container mt-5">
                <div class="row">
                    <div class="card-info">
                        <h3 class="text-center">OTROS PRODUCTOS</h3>
                        <hr class="mt-4 mb-4 bg-info"> <!-- Línea de color info -->
                        <div class="slick" text="center">
                            <!-- Aquí puedes agregar tus elementos slick -->
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="./recursos/jquery-ui/js/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar Slick con opciones predeterminadas
            var slickOptions = {
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
                adaptiveHeight: true,
            };

            $('.slick').slick(slickOptions);

            // Función para actualizar las opciones de Slick según el tamaño de la pantalla
            function updateSlickOptions() {
                var windowWidth = $(window).width();

                // Determinar el número de diapositivas a mostrar según el ancho de la ventana
                if (windowWidth <= 768) {
                    slickOptions.slidesToShow = 2;
                } else if (windowWidth <= 990) {
                    slickOptions.slidesToShow = 3;
                } else if (windowWidth <= 1400) {
                    slickOptions.slidesToShow = 4;
                } else {
                    slickOptions.slidesToShow = 5;
                }

                $('.slick').slick('slickSetOption', slickOptions);
            }

            updateSlickOptions();

            $(window).resize(function() {
                updateSlickOptions();
            });

            $.ajax({
                async: true,
                url: "ajax/catalogo.ajax.php",
                method: "POST",
                data: {
                    'accion': 50
                },
                dataType: 'json',
                success: function(respuesta) {
                    $('.slick').slick('removeSlide', null, null, true);

                    $.each(respuesta, function(index, producto) {
                        // Truncar la descripción del producto si es demasiado larga
                        var descripcionProducto = producto.descripcion_producto;
                        var maxLength = 20; 
                        if (descripcionProducto.length > maxLength) {
                            descripcionProducto = descripcionProducto.substring(0, maxLength) + '...';
                        }

                        var slickItem = '<div class="slick-item">' +
                            '<div class="card-info card-outline shadow">' +
                            '<img class="slick-image" src="../assets/imagenes/' + producto.foto + '" alt="' + producto.descripcion_producto + '">' +
                            '<div class="text-center">' +
                            '<small class="text-muted small-text">' + descripcionProducto + '</small>' +
                            '</div>' +
                            '<a href="detalle_producto.php?codigo=' + producto.codigo_producto + '" class="btn form-control btn-info">Ver detalles</a>' +
                            '</div>' +
                            '</div>';

                        // Agrega el slick al carrusel
                        $('.slick').slick('slickAdd', slickItem);
                    });


                    // Actualizar las opciones de Slick después de agregar nuevos elementos al carrusel
                    updateSlickOptions();
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        });
    </script>
</body>

</html>