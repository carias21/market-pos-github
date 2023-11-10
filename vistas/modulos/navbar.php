<!-- Navbar -->
<nav class="main-header navbar navbar-expand ">
    <!-- Contenido de la barra de navegación -->

    <div class="col-md-10  text-right">

        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </div>
    <div class="col-md-2 text-right">

        <button id="notifications-button" class="btn btn-warning ml-auto" data-toggle="dropdown">
            <i class="fas fa-bell"></i>
            <span class="badge badge-danger">5</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifications-button">
            <!-- Lista de notificaciones -->
            <ul class="list-unstyled">
                <li><a href="#">Notificación 1</a></li>
                <li><a href="#">Notificación 2</a></li>
                <li><a href="#">Notificación 3</a></li>
                <!-- Agrega más elementos de notificación aquí -->
            </ul>
        </div>


        <!-- Botón de pantalla completa (a la derecha) -->
        <button class="btn btn-info ml-auto" id="fullscreen-btn">
            <i class="fas fa-expand"></i>
        </button>

    </div>
</nav>

<!-- /.navbar -->

<!-- Content -->
<div class="content">
    <!-- Aquí van tus módulos -->
</div>

<script>
    const fullscreenBtn = document.getElementById("fullscreen-btn");

    // Función para alternar el modo de pantalla completa
    function toggleFullScreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    // Agregar un evento click al botón para activar/desactivar la pantalla completa
    fullscreenBtn.addEventListener("click", toggleFullScreen);






  // Simulación de notificaciones
  var notificationCount = 5;

  // Función para actualizar el contador de notificaciones
  function updateNotificationCount() {
    $('#notifications-button .badge').text(notificationCount);
  }

  // Función para mostrar una notificación
  function showNotification(message) {
    $('#notifications-button + .dropdown-menu ul').prepend('<li><a href="#">' + message + '</a></li>');
    notificationCount++;
    updateNotificationCount();
  }

  // Simulación de nuevas notificaciones
  // Esto es solo un ejemplo; en una aplicación real, las notificaciones se mostrarían en respuesta a eventos reales.
  $(document).ready(function () {
    updateNotificationCount();

    // Simular una nueva notificación cada 5 segundos
    setInterval(function () {
      showNotification('Nueva notificación');
    }, 5000);
  });


</script>