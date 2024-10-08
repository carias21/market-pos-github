<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require('../vistas/recursos/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../vistas/assets/dist/img/logo.png', 10, 10, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
              
        $this->Cell(80);
        $this->Cell(0, 10, 'TECNET GUATEMALA', 0, 1, 'C');
      
        $this->Cell(80);
        $this->SetFont('Arial', '', 8);
        // Título
        $this->Cell(0, 10, 'Ciudad de Guatemala zona 14', 0, 1, 'C');
        
        $this->SetFont('Arial', '', 12);
        // Título
        $this->Cell(0, 10, 'RECIBO DE VENTA', 0, 1, 'C');
    }
    
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

if (isset($_GET['fecha_venta'])) {
    $fecha_venta = $_GET['fecha_venta'];
    $noEmail = isset($_GET['NoEmail']) ? $_GET['NoEmail'] : 'false'; // Obtener el parámetro NoEmail

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(20, 20, 20);

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

        // Información del cliente
        $pdf->SetFillColor(70, 130, 180);
        $pdf->Cell(0, 3, '', 0, 1); // Espacio adicional

        // Establece la fuente sin negrita
        $pdf->SetFont('Arial', '', 9); // Puedes ajustar la fuente y el tamaño según tus necesidades

        // Configura el ancho de las celdas
        $anchoColumna = 15.50; // Ajusta el ancho según tus necesidades
        $anchoColumnaCliente = 30; // Ajusta el ancho según tus necesidades
        $anchoColumnaCorreo = 24;
        $anchoColumnaTelefono = 13; 

        // Información en una fila
        $pdf->Cell($anchoColumna, 10, 'Cliente:', 1, 0, 'C', true);
        $pdf->Cell($anchoColumnaCliente * 2, 10, $nombreCliente, 1, 0);

        $pdf->Cell($anchoColumna, 10, 'Email:', 1, 0, 'C', true);
        $pdf->Cell($anchoColumnaCorreo * 2, 10, $correoCliente, 1, 0);

        $pdf->Cell($anchoColumna, 10, 'Telefono:', 1, 0, 'C', true);
        $pdf->Cell($anchoColumnaTelefono * 2, 10, $numeroTel, 1, 1);

        $pdf->Ln(3);

        $pdf->Cell(30, 10, 'Fecha:', 1, 0, 'C', true);
        $pdf->Cell(60, 10, $fecha_venta, 1, 0);

        $pdf->Cell(30, 10, 'Cajero:', 1, 0, 'C', true);
        $pdf->Cell(60, 10, $nombreUsuario . ' ' . $apellidoUsuario, 1, 1);

        $pdf->Ln(10);

        // Encabezado de la tabla
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(70, 130, 180);

        // Ancho total de la tabla (sumando los anchos de las celdas)
        $tableWidth = 170; // Ajusta este valor según sea necesario

        // Ancho específico para la columna de DESCRIPCION
        $columnWidth = ($tableWidth - 50) / 4; // Ajusta el ancho de las otras columnas (reduciendo el espacio total en 30)
        $descripcionWidth = 2 * $columnWidth; // Hacer la columna DESCRIPCION más ancha

        // Establece la posición X para centrar la tabla en la página
        $leftMargin = ($pdf->GetPageWidth() - $tableWidth) / 2;
        $pdf->SetX($leftMargin);

        // Encabezado de la tabla
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(70, 130, 180);
        $pdf->Cell($columnWidth, 10, 'CANTIDAD', 1, 0, 'C', true);
        $pdf->Cell($descripcionWidth, 10, 'DESCRIPCION', 1, 0, 'C', true);
        $pdf->Cell($columnWidth, 10, 'P.U.', 1, 0, 'C', true);
        $pdf->Cell($columnWidth, 10, 'DESC', 1, 0, 'C', true);
        $pdf->Cell($columnWidth, 10, 'SUBTOTAL', 1, 1, 'C', true);

        // Función para truncar texto
        function truncate($text, $length = 50) {
            if (strlen($text) > $length) {
                return substr($text, 0, $length) . '...';
            }
            return $text;
        }

        // Configuración de la fuente
        $pdf->SetFont('Arial', '', 8);

        // Inicialización del total
        $total = 0;

        // Definir altura mínima de la celda
        $cellHeight = 6;

        // Recorrer los productos y añadirlos a la tabla
        foreach ($productos as $pro) {
            $subtotal = $pro["cantidad"] * $pro["precio_venta"] - $pro["descuento_venta"];
            
            // Calcular la altura de la celda necesaria para la descripción
            $nb = $pdf->GetStringWidth('- ' . strtoupper($pro["descripcion_producto"])) / ($descripcionWidth - 2); // ajustar con margen
            $nb = ceil($nb);
            $currentCellHeight = max($cellHeight, $nb * 4); // Ajustar el factor multiplicativo según la altura de la línea

            // Añadir celdas a la fila
            $pdf->Cell($columnWidth, $currentCellHeight, $pro["cantidad"], 'LR', 0, 'C');
            
            // Ajustar la descripción en múltiples líneas con el guion al inicio
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell($descripcionWidth, 4, utf8_decode('- ' . strtoupper($pro["descripcion_producto"])), 'LR', 'L');
            $pdf->SetXY($x + $descripcionWidth, $y); // Mover la posición actual a la siguiente celda

            $pdf->Cell($columnWidth, $currentCellHeight, "Q. " . number_format($pro["precio_venta"], 2, ".", ","), 'LR', 0, 'R');
            $pdf->Cell($columnWidth, $currentCellHeight, "Q. " . number_format($pro["descuento_venta"], 2, ".", ","), 'LR', 0, 'R');
            $pdf->Cell($columnWidth, $currentCellHeight, "Q. " . number_format($subtotal, 2, ".", ","), 'LR', 1, 'R');
            
            // Sumar al total
            $total += $subtotal;
        }

        // Añadir filas vacías para completar la tabla
        $num_filas = count($productos);
        $max_filas = 25; // Cambiar según sea necesario
        while ($num_filas < $max_filas) {
            $pdf->Cell($columnWidth, $cellHeight, '', 'LR', 0, 'C');
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell($descripcionWidth, 4, '', 'LR', 'L'); // Reducir la altura de las líneas
            $pdf->SetXY($x + $descripcionWidth, $y); // Mover la posición actual a la siguiente celda
            $pdf->Cell($columnWidth, $cellHeight, '', 'LR', 0, 'R');
            $pdf->Cell($columnWidth, $cellHeight, '', 'LR', 0, 'R');
            $pdf->Cell($columnWidth, $cellHeight, '', 'LR', 1, 'R');
            $num_filas++;
        }

        // Total
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(3 * $columnWidth + $descripcionWidth, 10, 'TOTAL VENTA', 1);
        $pdf->Cell($columnWidth, 10, "Q. " . number_format($total, 2, ".", ","), 1, 1, 'R');


        // Mensaje de agradecimiento
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('¡Gracias por su compra!'), 0, 1, 'C');

        $archivo_pdf = '../vistas/recursos/ticket.pdf';
        $pdf->Output($archivo_pdf, 'F');

        // Verificar si se debe enviar el correo
        if ($noEmail !== 'true') {
            // Datos del destinatario
            $para = $correoCliente;
            $asunto = 'TICKET DE VENTA';

            // Contenido del mensaje
            $mensaje = 'TICKET DE VENTA.<br><br>';

            // Inicialización del hash aleatorio
            $random_hash = md5(date('r', time()));

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

            // Enviar el correo y capturar errores
            try {
                if (mail($para, $asunto, $mensaje, $headers)) {
                    $pdf->Output();
                    echo 'Correo enviado correctamente.';
                } else {
                    $pdf->Output();
                    throw new Exception('Hubo un error al enviar el correo.');
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                error_log($e->getMessage());
            }
        } else {
            // Si NoEmail es 'true', simplemente muestra el PDF sin enviar el correo
            $pdf->Output();
            echo 'PDF generado correctamente sin enviar correo.';
        }

        // Borrar el archivo temporal del PDF después de enviarlo por correo
        unlink($archivo_pdf);
    } else {
        echo 'No se encontraron detalles de la venta para la fecha proporcionada.';
    }
} else {
    echo 'La fecha de la venta no ha sido proporcionada.';
}
?>
