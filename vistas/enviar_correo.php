<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = $_POST["respuesta"];

    if ($respuesta) {
        $para = "cariaslopez11@gmail.com";
        $asunto = "ERROR EN VENTA TECNET";
        $mensaje =  $respuesta;

        $cabeceras = "From: sistec@gmail.com\r\n";
        $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
        $cabeceras .= "X-Mailer: PHP/" . phpversion();

        if (mail($para, $asunto, $mensaje, $cabeceras)) {
            echo "Correo enviado correctamente.";
        } else {
            echo "Error al enviar el correo.";
        }
    }
}
?>
