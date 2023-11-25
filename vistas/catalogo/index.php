<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market-pos-github";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Configuración de la paginación
$resultados_por_pagina = 20; // Número de productos por página
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual, por defecto es la primera
$inicio = ($pagina_actual - 1) * $resultados_por_pagina; // Índice de inicio para la consulta SQL

// Consulta para obtener los productos del inventario con paginación
$sql = "SELECT codigo_producto, descripcion_producto, foto, stock_producto FROM productos LIMIT $inicio, $resultados_por_pagina";
$result = $conn->query($sql);

// Consulta para contar el número total de productos
$sql_contar = "SELECT COUNT(*) AS total FROM productos";
$result_contar = $conn->query($sql_contar);
$total_productos = $result_contar->fetch_assoc()['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_productos / $resultados_por_pagina);

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catálogo</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php
    require_once  "./navbar.php";

    ?>

<div class="container">
        <h1 class="text-center">Catálogo de Productos</h1>

        <div class="row">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card card-info text-center">
                        <img src="../assets/imagenes/<?= $row['foto'] ?>" class="card-img-top mx-auto img-fluid rounded shadow img-thumbnail" alt="<?= $row['descripcion_producto'] ?>" style="max-height: 250px; max-width: 250px; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['descripcion_producto'] ?></h5>

                            <?php if ($row['stock_producto'] == 0) : ?>
                                <p><span class="text-danger">&#10008;<strong>Agotado</strong> <span style="font-weight:bold;color:red;"></span></span></p>
                             
                            <?php else : ?>
                                <p><span class="text-success">&#10004; <strong>Disponible</strong></span></p>
                          
                            <?php endif; ?>


                            <a href="detalle_producto.php?codigo=<?= $row['codigo_producto'] ?>" class="btn btn-info">Ver detalles</a>
                        </div>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>


        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
                    <li class="page-item <?= ($i == $pagina_actual) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="./recursos/jquery-ui/css/jquery-ui.css">
<script src="./recursos/jquery-ui/js/jquery-ui.js"></script>