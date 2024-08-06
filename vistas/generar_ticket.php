<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require('../vistas/recursos/fpdf/fpdf.php');

if (isset($_GET['fecha_venta'])) {
    $fecha_venta = $_GET['fecha_venta'];
    
    // Condición para enviar o no el correo
    $enviar_correo = !isset($_GET['NoEmail']);

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
        $correoCliente = $productos[0]["correo_electronico"];
        $numeroTel = $productos[0]["numero_tel"];
        $descuento = $productos[0]["descuento_venta"];

        $logoPath = '../vistas/assets/dist/img/logo.png';
        list($logoWidth, $logoHeight) = getimagesize($logoPath);
        $maxLogoWidth = 60;
        $maxLogoHeight = 0;

        if ($logoWidth > $maxLogoWidth) {
            $ratio = $maxLogoWidth / $logoWidth;
            $maxLogoHeight = $logoHeight * $ratio;
        }

        $pdf->Image($logoPath, 15, $pdf->GetY(), $maxLogoWidth, $maxLogoHeight);
        $pdf->Ln(30);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'TECNET', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(0, 6, 'CIUDAD DE GUATEMALA', 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'WHATSSAP: 0000-0000', 0, 0, 'C');
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
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Cliente: ' . $nombreCliente, 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, 'Email: ' . $correoCliente, 0, 0, 'C');
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
            $pdf->MultiCell(0, 4, utf8_decode(strtoupper($pro["descripcion_producto"])));
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
        $totalTexto = "TOTAL VENTA: Q. " . number_format($total, 2);
        $pdf->Cell(0, 4, $totalTexto, 0, 1, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $imageX = 10;
        $imageY = $pdf->GetY();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(0, 6, utf8_decode('¡Gracias por su compra!'), 0, 0, 'C');

        $archivo_pdf = '../vistas/recursos/ticket.pdf';
        $pdf->Output($archivo_pdf, 'F');

        if ($enviar_correo) {
            $para = $correoCliente;
            $asunto = 'TICKET DE VENTA';
            $mensaje = 'TICKET DE VENTA.<br><br>';
            $random_hash = md5(date('r', time()));
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-" . $random_hash . "\"\r\n";
            $headers .= "From: sistec@gmail.com\r\n";
            $headers .= "Reply-To: tecnet@tecnet.com\r\n";
            $contenido_pdf = chunk_split(base64_encode(file_get_contents($archivo_pdf)));
            $mensaje .= "--PHP-mixed-" . $random_hash . "\r\n";
            $mensaje .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-" . $random_hash . "\"\r\n\r\n";
            $mensaje .= "--PHP-alt-" . $random_hash . "\r\n";
            $mensaje .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
            $mensaje .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $mensaje .= "TICKET DE VENTA.\r\n\r\n";
            $mensaje .= "--PHP-alt-" . $random_hash . "\r\n";
            $mensaje .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
            $mensaje .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $mensaje .= "<p>TICKET DE VENTA.</p>\r\n\r\n";
            $mensaje .= "--PHP-mixed-" . $random_hash . "\r\n";
            $mensaje .= "Content-Type: application/pdf; name=\"archivo.pdf\"\r\n";
            $mensaje .= "Content-Transfer-Encoding: base64\r\n";
            $mensaje .= "Content-Disposition: attachment\r\n\r\n";
            $mensaje .= $contenido_pdf . "\r\n";

            try {
                if (mail($para, $asunto, $mensaje, $headers)) {
                       $pdf->Output();
              
                } else {
                    throw new Exception('Hubo un error al enviar el correo.');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                error_log($e->getMessage());
            }
        } else {
                    $pdf->Output();

        }

        unlink($archivo_pdf);
    } else {
        echo 'No se encontraron productos para la fecha proporcionada.';
    }
} else {
    echo 'No se proporcionó una fecha de venta.';
}
?>
