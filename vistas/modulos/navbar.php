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

    

        <!-- Botón de pantalla completa (a la derecha) -->
        <button class="btn btn-info ml-auto" id="fullscreen-btn">
            <i class="fas fa-expand"></i>
        </button>

        <button id="toggleDarkModeButton" class="btn btn-primary">v</button>


    </div>
</nav>

<!-- /.navbar -->

<!-- Content -->
<div class="content">
    <!-- Aquí van tus módulos -->
</div>

<script>

document.addEventListener("DOMContentLoaded", function() {
    var darkModeButton = document.getElementById("toggleDarkModeButton");
    var isDarkMode = true; // Estado inicial: modo oscuro activado


    // Cambiar entre modo claro y oscuro
    function toggleDarkMode() {
        var htmlElement = document.querySelector("html");
        htmlElement.classList.toggle("dark-mode");
        isDarkMode = !isDarkMode;
        updateButtonText();
    }

    // Agregar evento de clic al botón
    darkModeButton.addEventListener("click", function() {
        toggleDarkMode();
    });

    // Actualizar el texto del botón al cargar la página
    updateButtonText();
});




const fullscreenBtn = document.getElementById("fullscreen-btn");

function toggleFullScreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

fullscreenBtn.addEventListener("click", toggleFullScreen);


</script>