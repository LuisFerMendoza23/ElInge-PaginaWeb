<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            background-color: #FAE392;
        }
        body, html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            height: auto;
            width: 100%;
            text-align: center;
            font-size: 24px;
            background-color: green;
            color: white;
            left: 0;
            top: 0;
            position: absolute;
        }
        footer {
            height: auto;
            width: 100%;
            /* position: fixed; */
            text-align: center;
            font-size: 12px;
            background-color: green;
            color: white;
            /* width: 100%; */
            left: 0;
            bottom: 0;
            position: absolute;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        
        .contenedor{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<header>Comidas El Inge</header>
<body>
    <div class="contenedor_general">
    <H1>GRACIAS POR COMPRAR "EN COMIDAS EL INGE"</H1>
        <div class="contenedor">
            <table border="1">
                <tr>
                    <th>Nombre Servicio</th>
                    <th>Descripcion </th>
                    <th>Precio </th>
                    <th>cantidad</th>
                </tr>
                <tr>
                    <td>TAquiza </td>
                    <td>Servicio taquiiza</td>
                    <td>70</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Barbacoa </td>
                    <td>Servicio barbacoa</td>
                    <td>77</td>
                    <td>2</td>
                </tr>
            </table>
        </div>
    </div>
    
</body>
<footer>Pie de página - Comidas El Inge</footer>
</html>

<?php

session_start();

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$Email = $_SESSION['u_correo'];

// Generar PDF
$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render(); //este comando renderiza el PDF
$content = $dompdf->output(); //extrae el contenido renderizado del PDF
$filename = "doc_prueba.pdf";
$bytes = file_put_contents($filename, $content); //guarda el PDF en un fichero llamado mipdf.pdf

// Enviar correo
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'comidas.el.inge@gmail.com';
    $mail->Password   = 'hccgulqrslcxuimf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('comidas.el.inge@gmail.com', 'Luis Fernando');
    $mail->addAddress($Email, 'Usuario'); 
// $mail->addAddress('lfmb123098@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Mensaje de prueba con pdf';
    $mail->Body    = 'Este es un mensaje e prueba para usar y mandar el correo y pdf';
    $mail->AltBody = 'Este es el cuerpo del mensaje en texto plano para clientes de correo que no admiten HTML. ¡Hola!';

    // Adjuntar el PDF
    $mail->addAttachment($filename, 'doc_prueba.pdf');

    $mail->send();
    echo 'El correo ha sido enviado correctamente';
} catch (Exception $e) {
    echo "Error al hacer el envio. Error del correo: {$mail->ErrorInfo}";
}

// Eliminar el archivo PDF después de enviar el correo (opcional)
unlink($filename);


?>


