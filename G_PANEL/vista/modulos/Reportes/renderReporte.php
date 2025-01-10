<?php 

    require_once '../../vendor/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    // Cargar el contenido HTML desde el archivo temporal
    $html = file_get_contents('temp_file.html');
    $dompdf->loadHtml($html);

    $dompdf->setPaper('legal', 'landscape');

    $dompdf->render();

    $dompdf->stream("archivo.pdf", array("Attachment" => false));

?>