<?php
// Inicia la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que la variable de sesión está definida antes de acceder a ella
$session_id_usuario = isset($_SESSION["usuario1"]) ? $_SESSION["usuario1"] : null;

// Resto de tu código...
?>
