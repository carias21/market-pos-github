<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>tecnet gt</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="vistas/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
    <img src="vistas/assets/dist/img/Log_Tecnet_Sin_fondo.png " height="30%" width="100%"  >

        <div class="card-body">

        <!--FORMULARIO PARA EL INICIO DE SESIO -->
            <form method="post" class="needs-validation-login" novalidate>
               
            <!-- USUARIO DEL SISTEMA -->
                <div class="input-group mb-3">
                    <input class="form-control" type=text placeholder="Usuario" name="loginUsuario" required>
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <div class="invalid-feedback">"Debe ingresar su usuario"</div>
                </div>
            <!-- USUARIO DEL SISTEMA -->
            <div class="input-group mb-3">
                <input class="form-control" type="password" placeholder="Constraseña" name="loginPassword" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div class="invalid-feedback">"Debe ingresar la contraseña"</div>
            </div>

            <!-- BUTTON DE INGRESO -->
            <div class="row">
            <?php 
            //VD 25 MIN 20:00
            $login = new UsuarioControlador();
            $login->login();
            ?>    
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-info">Iniciar Sesión</button>
            </div>
        </div>
            </form>
        </div><!-- card body -->


    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/assets/dist/js/adminlte.min.js"></script>
</body>

</html>