<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require('../vistas/recursos/fpdf/fpdf.php');





if (isset($_GET['fecha_venta'])) {

    $fecha_venta = $_GET['fecha_venta'];


    $pdf = new FPDF($orientation = 'P', $unit = 'mm', array(90, 210));
    $pdf->AddPage();
    $pdf->setMargins(10, 10, 10);


    $total = 0;

    $productos = VentasControlador::ctrObtenerDetalleVenta($fecha_venta);

    if (!$productos) {
        die("Error: No se encontraron detalles de la venta para la fecha proporcionada.");
    }

    if (!empty($productos) && isset($productos[0])) {

        $nombreUsuario = $productos[0]["nombre_usuario"];
        $apellidoUsuario = $productos[0]["apellido_usuario"];
        $nombreCliente = $productos[0]["nombre_cliente"];
        $nitCliente = $productos[0]["nit_cliente"];
        $correCliente = $productos[0]["correo_electronico"];
        $numeroTel = $productos[0]["numero_tel"];
        $descuento = $productos[0]["descuento_venta"];


        // Ruta a la imagen del logo
        $logoPath = '../vistas/assets/dist/img/Log_Tecnet_Sin_fondo.png'; // Asegúrate de que esta sea la ruta correcta

        // Obtén las dimensiones de la imagen
        list($logoWidth, $logoHeight) = getimagesize($logoPath);

        // Calcula las nuevas dimensiones para ajustar el logo en el PDF
        $maxLogoWidth = 60; // Ancho máximo para el logo
        $maxLogoHeight = 0; // Altura se calculará automáticamente para mantener la proporción

        if ($logoWidth > $maxLogoWidth) {
            $ratio = $maxLogoWidth / $logoWidth;
            $maxLogoHeight = $logoHeight * $ratio;
        }

        // Agrega el logo al PDF en la parte superior del espacio en blanco
        $pdf->Image($logoPath, 15, $pdf->GetY(), $maxLogoWidth, $maxLogoHeight);
        // Añade un espacio en blanco en la parte superior
        $pdf->Ln(30); // Puedes ajustar el valor 10 según cuánto espacio desees


        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Direccion Ciudad, Guatemala', 0, 0, 'C');

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Telefono: 0000000', 0, 0, 'C');

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Email: tecnetgt@tecnet.com', 0, 0, 'C');

        $pdf->Ln();
        $pdf->Cell(0, 6, utf8_decode('-------------------------------------------------'), 0, 0, 'C');


        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Fecha ' . $fecha_venta, 0, 0, 'C');



        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Cajero: ' . $nombreUsuario . ' ' . $apellidoUsuario, 0, 0, 'C');


        $pdf->Ln();
        $pdf->Cell(0, 6, utf8_decode('-------------------------------------------------'), 0, 0, 'C');

        /*$pdf->Ln();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 6, 'NIT: ' . $nitCliente, 0, 0, 'C');*/


        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Cliente: ' . $nombreCliente, 0, 0, 'C');


        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Email: ' . $correCliente, 0, 0, 'C');



        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Telefono: ' . $numeroTel, 0, 0, 'C');


        $pdf->Ln();
        $pdf->Cell(0, 6, utf8_decode('-------------------------------------------------'), 0, 0, 'C');


        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 6, utf8_decode('RECIBO DE VENTA'), 0, 0, 'C');
        $pdf->SetFont('Arial', '', 10);


        $pdf->Ln();
        $pdf->Cell(0, 6, utf8_decode('---------------------------------------------------------------------------'), 0, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 7);

        $pdf->Cell(16, 4, "CANTIDAD", 0, 0, 'C');
        $pdf->Cell(19, 4, "P.U.", 0, 0, 'C');
        $pdf->Cell(20, 4, "DESC", 0, 0, 'C');
        $pdf->Cell(21, 4, "SUBTOTAL", 0, 0, 'C');

        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln();

        $pdf->Cell(0, 6, utf8_decode('---------------------------------------------------------------------------'), 0, 0, 'C');

        $pdf->Ln();


        $pdf->SetFont('Arial', '', 8);

        foreach ($productos as $pro) {


            $pdf->Cell(25, 4, $pro["codigo_producto"]);
            $pdf->Cell(22, 4, utf8_decode(strtoupper(substr($pro["descripcion_producto"], 0, 20))));
            $pdf->Ln();
            $pdf->Cell(15, 4, $pro["cantidad"], 0, 0, 'C');
            $pdf->Cell(5, 4, "X", 0, 0, 'C');
            $pdf->Cell(15, 4, "Q. " . number_format($pro["precio_venta"], 2, ".", ","), 0, 0, 'C');
            $pdf->Cell(5, 4, "-", 0, 0, 'C');
            $pdf->Cell(13, 4, "Q. " . number_format($pro["descuento_venta"], 2, ".", ","), 0, 0, 'C');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(20, 5, "Q. " . number_format($pro["cantidad"] * $pro["precio_venta"] - $pro["descuento_venta"], 2, ".", ","), 0, 0, "R");
            $pdf->SetFont('Arial', '', 8);
            $pdf->Ln();

            $total += $pro["cantidad"] * $pro["precio_venta"] - $pro["descuento_venta"];
        }

        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(0, 6, utf8_decode('------------------------------------------------------------------------------------------------'), 0, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 10);

        // Concatena el valor del total al final del texto
        $totalTexto = "TOTAL VENTA: Q. " . number_format($total, 2);

        // Crea una celda con ancho automático que contiene el texto completo
        $pdf->Cell(0, 4, $totalTexto, 0, 1, 'C'); // Cambiamos a "1" para avanzar a la siguiente línea

        $pdf->Ln();


        $pdf->Ln();
        $imageX = 10;
        $imageY = $pdf->GetY(); // Obtiene la posición Y actual
        $pdf->Ln();


        $pdf->Ln();


        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(0, 6, utf8_decode('Gracias por su compra!'), 0, 0, 'C');


        // Ruta del archivo PDF que deseas adjuntar
        $archivo_pdf = '../vistas/recursos/ticket.pdf';
        $pdf->Output($archivo_pdf, 'F');



        // Datos del destinatario
        $para = $correCliente;
        $asunto = 'TICKET DE VENTA';


        // Contenido del mensaje
        $mensaje = 'TICKET DE VENTA.<br><br>';

        // Encabezados del correo electrónico
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-" . $random_hash . "\"\r\n";
        $headers .= "From: remitente@example.com\r\n";
        $headers .= "Reply-To: remitente@example.com\r\n";

        // Leer el contenido del archivo PDF en base64
        $contenido_pdf = chunk_split(base64_encode(file_get_contents($archivo_pdf)));

        // Mensaje con el archivo adjunto
        $mensaje .= "--PHP-mixed-" . $random_hash . "\r\n";
        $mensaje .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n\r\n";

        // Parte de texto del mensaje
        $mensaje .= "--PHP-alt-" . $random_hash . "\r\n";
        $mensaje .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
        $mensaje .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $mensaje .= "TICKET DE VENTA.\r\n\r\n";

        // Parte HTML del mensaje
        $mensaje .= "--PHP-alt-" . $random_hash . "\r\n";
        $mensaje .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
        $mensaje .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $mensaje .= "<p>TICKET DE VENTA.</p>\r\n\r\n";

        // Adjuntar el archivo PDF
        $mensaje .= "--PHP-mixed-" . $random_hash . "\r\n";
        $mensaje .= "Content-Type: application/pdf; name=\"archivo.pdf\"\r\n";
        $mensaje .= "Content-Transfer-Encoding: base64\r\n";
        $mensaje .= "Content-Disposition: attachment\r\n\r\n";
        $mensaje .= $contenido_pdf . "\r\n";

        // Enviar el correo
        if (mail($para, $asunto, $mensaje, $headers)) {
            $pdf->Output();
        } else {
            echo 'Hubo un error al enviar el correo.';
        }


        // Borrar el archivo temporal del PDF después de enviarlo por correo
        unlink($archivo_pdf);
    } else {
        return;
    }
} else {
    return;
}
