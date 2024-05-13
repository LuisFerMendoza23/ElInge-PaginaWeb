
<?php ob_start(); ?>
<h1>Hola mundo</h1>
<p>Este es el primer pdf de ejemplo que imprimo para ustedes</p>

<?php
    include_once "../vendor/autoload.php";
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->render(); //este comando renderiza el PDF
    $content = $dompdf->output(); //extrae el contenido renderizado del PDF
    $filename = "1_hola.pdf";
    file_put_contents($filename, $content); //guarda el PDF en un fichero llamado mipdf.pdf
    $dompdf->stream($filename);

?> 