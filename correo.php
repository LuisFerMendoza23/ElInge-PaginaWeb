<?php
session_start();
require 'vendor/autoload.php'; // Asegúrate de tener autoload.php generado por Composer para PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('fpdf/fpdf.php');
include "cone.php"; 

if (!isset($_SESSION['IdUsuario'])) {
    echo "No hay variables de sesión definidas.";
    exit;
}

$idusuario = $_SESSION['IdUsuario'];
$username = $_SESSION['Nombre'];
$correo = $_SESSION['Correo'];

// Obtener información del usuario
$sql_user = "SELECT Nombre, Correo, Telefono FROM usuarios WHERE IdUsuario = ?";
$stmt_user = $con->prepare($sql_user);
$stmt_user->bind_param("i", $idusuario);
$stmt_user->execute();
$user_result = $stmt_user->get_result();
$user_info = $user_result->fetch_assoc();
$telefono = $user_info['Telefono'];

// Obtener fecha_orden de la orden
$sql_order = "SELECT Fecha_orden FROM orden WHERE IdUsuario = ? ORDER BY Fecha_orden DESC LIMIT 1";
$stmt_order = $con->prepare($sql_order);
$stmt_order->bind_param("i", $idusuario);
$stmt_order->execute();
$order_result = $stmt_order->get_result();
$order_info = $order_result->fetch_assoc();
$fecha_orden = $order_info['Fecha_orden'];

// Obtener detalles del carrito de compras del usuario
$sql = "SELECT od.IdOrdenDetalles, od.nombreS, od.descriS, od.precioS, od.Lugar, od.Hora, s.imagenS 
        FROM orden_detalles od 
        JOIN orden o ON od.IdOrden = o.IdOrden
        JOIN servicios s ON od.IdServicio = s.IdServicio
        WHERE o.IdUsuario = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$result = $stmt->get_result();
// Generar PDF con FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Fondo verde
        $this->SetFillColor(34, 139, 34); // Verde
        $this->Rect(0, 0, $this->w, 50, 'F');
        // Logo
        $this->Image('img/logo.png', 10, 10, 30);
        // Nombre de la compañía
        $this->SetFont('Arial', 'B', 24);
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->Cell(0, 20, 'El Inge', 0, 1, 'C');
        $this->Ln(20); // Salto de línea
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Fuente Arial itálica 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    // Datos del cliente
    function CustomerDetails($nombre, $correo, $telefono)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $nombre, 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $correo, 0, 1, 'C');
        $this->Cell(0, 10, $telefono, 0, 1, 'C');
    }

    // Tabla coloreada
    function FancyTable($header, $data)
    {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255, 255, 255); // Blanco
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0); // Negro
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 12);
        // Cabecera
        $w = array(30, 40, 60, 25, 25, 25);
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 12);
        // Datos
        $fill = false;
        $total = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 20, $this->Image($row[0], $this->GetX(), $this->GetY(), 20), 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->MultiCell($w[2], 6, $row[2], 'LR', 'L', $fill);
            $this->SetXY($x + $w[2], $y);
            $this->Cell($w[3], 6 * max(ceil(strlen($row[2]) / $w[2]), 1), $row[3], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6 * max(ceil(strlen($row[2]) / $w[2]), 1), $row[4], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6 * max(ceil(strlen($row[2]) / $w[2]), 1), $row[5], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
            $total += floatval($row[5]); // Convertir el precio a flotante y sumarlo al total
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
        return $total;
    }

    // Subtotales y total
    function Totals($subtotal)
    {
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Subtotal: $' . number_format($subtotal, 2), 0, 1, 'R');
        $tax = $subtotal * 0.10; // Impuesto del 10%
        $this->Cell(0, 10, 'Tax (10%): $' . number_format($tax, 2), 0, 1, 'R');
        $total = $subtotal + $tax;
        $this->Cell(0, 10, 'Total: $' . number_format($total, 2), 0, 1, 'R');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);

// Fecha de la orden
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, date('d F, Y', strtotime($fecha_orden)), 0, 1, 'R');
$pdf->Ln(10);

// Datos del cliente
$pdf->CustomerDetails($user_info['Nombre'], $user_info['Correo'], $user_info['Telefono']);

// Column headings
$header = array('Imagen', 'Nombre', 'Descripcion', 'Lugar', 'Hora', 'Precio');
// Data loading
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        htmlspecialchars($row["imagenS"]),
        htmlspecialchars($row["nombreS"]),
        htmlspecialchars($row["descriS"]),
        htmlspecialchars($row["Lugar"]),
        htmlspecialchars($row["Hora"]),
        htmlspecialchars($row["precioS"])
    ];
}
$subtotal = $pdf->FancyTable($header, $data);
$pdf->Totals($subtotal);

// Guardar el archivo PDF
$filename = "ReciboCompra.pdf";
$pdf->Output($filename, 'F');

// Enviar correo con PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'comidas.el.inge@gmail.com';
    $mail->Password   = 'hccg ulqr slcx uimf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Remitente y destinatarios
    $mail->setFrom('comidas.el.inge@gmail.com', 'Comidas El Inge');
    $mail->addAddress($correo, $username);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Recibo de tu compra - Comidas El Inge';
    $mail->Body    = 'Gracias por tu compra. En el archivo adjunto encontrarás el recibo detallado.';
    $mail->AltBody = 'Gracias por tu compra. En el archivo adjunto encontrarás el recibo detallado.';

    // Adjuntar PDF
    $mail->addAttachment($filename);

    $mail->send();
    echo 'Correo enviado exitosamente.';
} catch (Exception $e) {
    echo "No se pudo enviar el correo. Error de Mailer: {$mail->ErrorInfo}";
}

unlink($filename);
$con->close();
?>