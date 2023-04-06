<?php
require '../../config.php';
require 'verificar.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

// Cria uma nova instância do Dompdf
$dompdf = new Dompdf();

// Carrega o código HTML da fatura
$html = '<html><head><style></style></head><body>';
foreach ($grouped_sales as $cod_fat => $produtos) {
    $html .= '<div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-3">Abel Nkele Canas';
    // ...
    $html .= '</div>';
}
$html .= '</body></html>';

// Define o código HTML a ser renderizado pelo dompdf
$dompdf->loadHtml($html);

// Renderiza o PDF
$dompdf->render();

// Define o nome do arquivo PDF a ser gerado
$filename = 'fatura-' . $cod_fat . '.pdf';

// Envia o PDF para o navegador
$dompdf->stream($filename, array('Attachment' => 0));

$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream();
?>