<?php
session_start();
//session_destroy();

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

if (count(array_filter($routesArray)) > 1) {
    echo '
        <script>
        window.location =  "http://localhost/market-pos-github/"
        </script>';
}

//recibe la opcion cerrar cesion
if (isset($_GET["cerrar_sesion"]) && $_GET["cerrar_sesion"] == 1) {
    session_destroy(); // cerrar la sesion
    echo '
    <script>
    window.location = "http://localhost/market-pos-github/"
    </script>';
}

?>





<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#003547  ">
    <title>TECNET</title>

    <link rel="shortcut icon" href="vistas/assets/dist/img/logo.png" type="image/x-icon">

    <!-- ============================================================================================================= -->
    <!-- REQUIRED CSS -->
    <!-- ============================================================================================================= -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- SweetAlert2 TOASTR-->
    <link rel="stylesheet" href="vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="vistas/assets/dist/css/toastr.min.css">

    <!-- Jquery CSS -->
    <link rel="stylesheet" href="vistas/assets/plugins/jquery-ui/css/jquery-ui.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- GOOGLE CHART JS -->
    <script src="vistas/assets/dist/js/google.chart.js"></script>

    <!-- ChartJS -->
    <script src="vistas/assets/plugins/chart.js/Chart.min.js"></script>


    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <!-- jstree css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    <!-- Estilo Calendario
 <link rel="stylesheet" href="vistas/assets/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="vistas/assets/dist/css/font-awesome.min.css">-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

    <!-- ============================================================
    =ESTILOS PARA USO DE DATATABLES JS
    ===============================================================-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


    <!-- ============================================================
    MIS ESTILOS CSS
    ===============================================================-->
    <link rel="stylesheet" href="vistas/assets/dist/css/misestilos.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/assets/dist/css/adminlte.min.css">

    <!-- Estilos personzalidos -->
    <link rel="stylesheet" href="vistas/assets/dist/css/plantilla.css">

    <!-- ============================================================================================================= -->
    <!-- REQUIRED SCRIPTS -->
    <!-- ============================================================================================================= -->

    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- InputMask -->
    <script src="vistas/assets/plugins/moment/moment.min.js"></script>
    <script src="vistas/assets/plugins/inputmask/jquery.inputmask.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="vistas/assets/dist/js/toastr.min.js"></script>
    <!-- jquery UI -->
    <script src="vistas/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JSTREE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <!-- ============================================================
    =LIBRERIAS PARA USO DE DATATABLES JS
    ===============================================================-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>



    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    


    


    <!-- ============================================================
    =LIBRERIAS PARA EXPORTAR A ARCHIVOS
    ===============================================================-->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/assets/dist/js/adminlte.min.js"></script>

    <script src="vistas/assets/dist/js/plantilla.js"></script>



</head>

<?php if (isset($_SESSION["usuario1"])) : ?>

    <body class="hold-transition sidebar-mini ">
        <div class="wrapper">

            <?php
            include "modulos/navbar.php";
            include "modulos/aside.php";
            require_once "config.php";
            ?>

            <div class="content-wrapper">
                <?php include "vistas/" . $_SESSION['usuario1']->vista ?>

            </div>
        </div>

        <script>
            function CargarContenido(pagina_php, contenedor, id_perfil, id_modulo) {
                $("." + contenedor).load(pagina_php)
            }
        </script>

    </body>
    
    <?php else : ?>

        <body>
            <?php include "vistas/login.php" ?>
        </body>

        <?php endif; ?>


</html>

<script>
document.getElementById("toggleColorButton").addEventListener("click", function() {
        toggleColorMode();
    });

    function toggleColorMode() {
        var body = document.body;
        if (body.classList.contains("colorPlantilla")) {
            body.classList.remove("colorPlantilla");
        } else {
            body.classList.add("colorPlantilla");
        }
    }




</script>

