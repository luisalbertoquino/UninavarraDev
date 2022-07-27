<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$name = $_GET['name'];

try {
    $css = '<style>'.file_get_contents(dirname(dirname(__FILE__)).'/public/css/template.css').'</style>';
    
    ob_start();
    include dirname(__FILE__).'/template.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('L', 'LETTER', 'es');
    $html2pdf -> addFont('srfont', '', 'srfont.php');
    $permissions=array('modify','copy');
    $html2pdf -> pdf -> SetProtection($permissions);
    $html2pdf -> writeHTML($css.$content);
    $html2pdf -> output('certificado.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}