<?php
require_once "config.php";
$menuUsuario = UsuarioControlador::ctrObtenerMenuUsuario($session_id_usuario->id_usuario);
//var_dump($menuUsuario);
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4 position-fixed sidebar-scroll">


    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="vistas/assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SISTEMA VENTAS</span>
    </a>
    <!-- COLOCAR EL NOMBRE Y APELLIDO DEL USUARIO LOGEDO, O QUE TIENE LA SESION INICIADA. -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="vistas/assets/dist/img/user1.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="User Image">
        </div>
        <div class="info">
            <h6 class="text-warning"><?php echo $session_id_usuario->nombre_usuario . ' ' . $session_id_usuario->apellido_usuario ?></h6>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- MUESTRA LAS OPCIONES DEL MENU DEL USUARIO LOGEADO -->
                    <?php foreach ($menuUsuario as $menu) : ?>
                        <li class="nav-item">

                            <a style="cursor: pointer;" class="nav-link <?php if ($menu->vista_inicio == 1) : ?>
                                <?php echo 'active' ?>
                                <?php endif; ?>" <?php if (!empty($menu->vista)) : ?> onclick="CargarContenido('vistas/<?php echo $menu->vista; ?>','content-wrapper')" <?php endif; ?>>
                                <!-- SE LE ASIGNA EL ICONO QUE ESTA INDICADO EN LA BASE DE DATOS (MODULOS) -->
                                <i class="nav-icon <?php echo $menu->icon_menu; ?>"></i>
                                <p>
                                    <?php echo $menu->modulo ?>
                                    <!--si la opcion del menu no esta vacia, se agregue una flechita -->
                                    <?php if (empty($menu->vista)) : ?>
                                        <i class="right fas fa-angle-left"></i>
                                    <?php endif; ?>
                                </p>
                            </a>

                            <?php if (empty($menu->vista)) : ?>
                                <?php $subMenuUsuario = UsuarioControlador::ctrObtenerSubMenuUsuario($menu->id, $session_id_usuario->id_usuario);
                                ?>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($subMenuUsuario as $subMenu) : ?>
                                        <li class="nav-item">
                                            <a style="cursor: pointer;" class="nav-link" onclick="CargarContenido('vistas/<?php echo $subMenu->vista ?>','content-wrapper')">
                                                <!-- SE LE ASIGNA EL ICONO QUE ESTA INDICADO EN LA BASE DE DATOS (MODULOS) -->
                                                <i class="<?php echo $subMenu->icon_menu; ?> nav-icon"></i>
                                                <p><?php echo $subMenu->modulo; ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                    <!-------------------------------------------------------------------------------------------------------------------
                    OPCION MENU PARA CERRAR SESION
                    ----------------------------------------------------------------------------------------------------------------------->

                    <li class="nav-item">
                        <a href="http://localhost/market-pos-github?cerrar_sesion=1" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Cerrar Sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>

<script>
    $(".nav-link").on('click', function() {
        $(".nav-link").removeClass('active');
        $(this).addClass('active');
    })
</script>