<?php
    require '../../config.php';
    require 'verificar.php';
    require '../../../vendor/autoload.php';
    
    use Dompdf\Dompdf;
    $dados = "<!DOCTYPE html>";
    $dados .= "<html lang='pt-pt'>";
    $dados .= "<head>";
    $dados .= "<link rel='stylesheet' type='text/css' href='assets/css/bootstrap.min.css'>";
    $dados .= "<link rel='stylesheet' type='text/css' href='assets/css/font-awesome.css'>";
    $dados .= "<link rel='stylesheet' href='assets/css/templatemo-hexashop.css'>";
    $dados .= "<link rel='stylesheet' href='assets/css/owl-carousel.css'>";
    $dados .= "<link rel='stylesheet' href='assets/css/lightbox.css'>";
    $dados .= "</head>";
    $dados .= "<body>";
    $dados .= "<div class='container text-left'>";
    $dados .= "<h2>Factura da compra</h2>";
    foreach($_SESSION['dados'] as $produtos){
        extract($produtos);
        $dados .= "Nome do Produto: ".$produtos['nome']."<br>";
        $dados .= "Nº de pedidos: ".$produtos['qtd']."<br>";
        $dados .= "Preço do Produto: ".number_format($produtos['preco_pedido'],2,",",".")."&nbsp;KZ$<br>";
        $dados .= "Valor Total: ".number_format($produtos['total'],2,",",".")."&nbsp;KZ$<br>";
        $dados .= "<hr>";
        unset( $_SESSION['dados']);
    }
    $dados .= "</div>";
    $dados .= "</body>";
    $dados .= "</html>";

    $dompdf = new Dompdf(['enable_remote' => true]);
    $dompdf->loadHtml($dados);
    $dompdf->setPaper('A5', 'landscape');

    $dompdf->render();
    $dompdf->stream();
?>