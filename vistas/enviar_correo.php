<?php

$correoAlertas = "cariaslopez11@gmail.com";
$correoErrores = "cariaslopez11@gmail.com";
$correoNotificacion = "cariaslopez11@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $respuesta = isset($_POST["respuesta"]) ? $_POST["respuesta"] : null;
    $alertaStock = isset($_POST["alertaStock"]) ? $_POST["alertaStock"] : null;
    $stock0 = isset($_POST["stock0"]) ? $_POST["stock0"] : null;
    $cierreDeCaja = isset($_POST["respuestaCierreCaja"]) ? $_POST["respuestaCierreCaja"] : null;

    try {
        if ($respuesta) {
            enviarCorreo("ALERTA VENTA", $respuesta,$correoErrores, true);
        }

        if ($alertaStock) {
            enviarAlertaMinimoStock("ALERTA STOCK", $alertaStock, $correoAlertas, true);
        }

        if ($stock0) {
            enviarAlertaStock0("ALERTA STOCK 0", $stock0, $correoAlertas, true);
        }

        if ($cierreDeCaja) {
            enviarNotificacionCierreCaja("CIERRE DE CAJA", $cierreDeCaja, $correoNotificacion, true);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}





function enviarNotificacionCierreCaja($tipo, $mensaje, $correoNotificacion, $esHTML)
{
    $para = $correoNotificacion;
    $asunto = "NOTIFICACION - $tipo";

    if ($esHTML) {
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        $cuerpoMensaje = "
            <html>
            <head>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                    }
    
                    .container {
                        max-width: 600px;
                        padding: 20px;
                        background-color: #FFD800;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border: 2px solid #FFD800;
                        text-align: center;
                    }
    
                    h1 {
                        color: #000; /* Cambiado a negro */
                        font-size: 24px;
                    }
    
                    p {
                        margin-bottom: 20px;
                        font-size: 18px;
                        color: #001f3f; /* Cambiado a azul marino */
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>NOTIFICACIÓN: $tipo</h1>
                    <p>
                        <strong>" . htmlspecialchars($mensaje) . "</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    } else {
        $cabeceras = "From: sistec@gmail.com\r\n";
        $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
        $cuerpoMensaje = "$tipo\n\n" . htmlspecialchars($mensaje);
    }
    

    $cabeceras .= "From: sistec@gmail.com\r\n";
    $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $asunto, $cuerpoMensaje, $cabeceras)) {
        return 1;
    } else {
        echo "Error al enviar el correo.";
        return 0;
    }
}


function enviarAlertaStock0($tipo, $mensaje, $correoAlertas, $esHTML)
{
    $para = $correoAlertas;
    $asunto = "NOTIFICACION - $tipo";

    if ($esHTML) {
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        $cuerpoMensaje = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #ff0000; /* Cambiado a rojo */
                    color: #ffffff; /* Cambiado a blanco */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                }
    
                .container {
                    max-width: 600px;
                    padding: 20px;
                    background-color: #9B2208; 
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    border: 2px solid #B72000; 
                    text-align: center;
                }
    
                h1 {
                    color: #ffffff; /* Cambiado a blanco */
                    font-size: 24px;
                }
    
                p {
                    margin-bottom: 20px;
                    font-size: 18px;
                    color: #ffffff; /* Cambiado a blanco */
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>NOTIFICACIÓN: $tipo</h1>
                <p>
                    <strong>" . htmlspecialchars($mensaje) . "</strong>
                </p>
            </div>
        </body>
        </html>
    ";
    
    } else {
        $cabeceras = "From: sistec@gmail.com\r\n";
        $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
        $cuerpoMensaje = "$tipo\n\n" . htmlspecialchars($mensaje);
    }
    

    $cabeceras .= "From: sistec@gmail.com\r\n";
    $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $asunto, $cuerpoMensaje, $cabeceras)) {
        return 1;
    } else {
        echo "Error al enviar el correo.";
        return 0;
    }
}

function enviarAlertaMinimoStock($tipo, $mensaje, $correoAlertas, $esHTML)
{
    $para = $correoAlertas;
    $asunto = "NOTIFICACION - $tipo";

    if ($esHTML) {
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        $cuerpoMensaje = "
            <html>
            <head>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                    }
    
                    .container {
                        max-width: 600px;
                        padding: 20px;
                        background-color: #FFD800;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border: 2px solid #FFD800;
                        text-align: center;
                    }
    
                    h1 {
                        color: #000; /* Cambiado a negro */
                        font-size: 24px;
                    }
    
                    p {
                        margin-bottom: 20px;
                        font-size: 18px;
                        color: #001f3f; /* Cambiado a azul marino */
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>NOTIFICACIÓN: $tipo</h1>
                    <p>
                        <strong>" . htmlspecialchars($mensaje) . "</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    } else {
        $cabeceras = "From: sistec@gmail.com\r\n";
        $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
        $cuerpoMensaje = "$tipo\n\n" . htmlspecialchars($mensaje);
    }
    

    $cabeceras .= "From: sistec@gmail.com\r\n";
    $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $asunto, $cuerpoMensaje, $cabeceras)) {
        return 1;
    } else {
        echo "Error al enviar el correo.";
        return 0;
    }
}



function enviarCorreo($tipo, $mensaje, $correoErrores, $esHTML)
{
    $para = $correoErrores;
    $asunto = "NOTIFICACION - $tipo";

    if ($esHTML) {
        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        $cuerpoMensaje = "
            <html>
            <head>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                    }
    
                    .container {
                        max-width: 600px;
                        padding: 20px;
                        background-color: #FFFFFF;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border: 2px solid #3B00A2;
                        text-align: center;
                    }
    
                    h1 {
                        color: #000; /* Cambiado a negro */
                        font-size: 24px;
                    }
    
                    p {
                        margin-bottom: 20px;
                        font-size: 18px;
                        color: #001f3f; /* Cambiado a azul marino */
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>NOTIFICACIÓN: $tipo</h1>
                    <p>
                        <strong>" . htmlspecialchars($mensaje) . "</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    } else {
        $cabeceras = "From: sistec@gmail.com\r\n";
        $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
        $cuerpoMensaje = "$tipo\n\n" . htmlspecialchars($mensaje);
    }
    

    $cabeceras .= "From: sistec@gmail.com\r\n";
    $cabeceras .= "Reply-To: sistec@gmail.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $asunto, $cuerpoMensaje, $cabeceras)) {
        return 1;
    } else {
        echo "Error al enviar el correo.";
        return 0;
    }
}


