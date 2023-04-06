<?php
require '../../config.php';
require 'verificar.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$produtos = [];
$prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod");
if ($prod->rowCount() > 0) {
  $produtos = $prod->fetchALL(PDO::FETCH_ASSOC);
}
$sql = $pdo->query("SELECT COUNT(id_categoria) AS nome_categoria FROM categorias");
$categoriacount = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->query("SELECT COUNT(id_prod) AS nome_prod FROM produtos");
$prodcount = $sql->fetch(PDO::FETCH_ASSOC);

$hoje = date('d/m/Y');

$dados = '
<!DOCTYPE html>
<html lang="pt-pt">
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>
<body>';
$dados .= '				
  <div class="text-center">
	  <img src="../../assets/img/gestão.png" style="width-max:100%; text-align: center;" class="navbar-brand">
  <div>
  <div class="text-center"><h2 class="text-center">RELATÓRIO DOS PRODUTOS CADASTRADOS NO SISTEMA</h2></div>
	<div>
		<h6>Dashboard >> Produtos >> Relatório</h6>
		<h6>Relatório: Produtos</h6>
		<h6>Data de Emissão: ' . $hoje . '</h6>
	</div>
						
	<div class="text-center">
		<div style="whidth:100%; background: #ff9300; color: white; padding: 2%; margin: 2%">
			<p>Total de Categorias dos Produtos Cadastrados no Sistema</p>
			' . $categoriacount["nome_categoria"] . '
		</div>
		<div style="whidth:100%; background: #ff9300; color: white; padding: 2%; margin: 2%">
			<p>Total de Produtos Cadastrados no Sistema</p>
			' . $prodcount["nome_prod"] . '
		</div>
	<div>';
$dados .= '
	<table id="add-row" class="display table table-striped table-hover border">
		<tr class="border">
		<th class="border">Código</th>
		<th class="border">Nome do produto</th>
		<th class="border">Quantidade</th>
		<th class="border">Preço</th>
		<th class="border">Estado</th>
		<th class="border">Validade</th>
		<th class="border">Categoria</th>
		<th class="border">Data de Registro</th>
		</tr>';
foreach ($produtos as $listagem) {
  $dados .= '
		<tbody>
			<tr class="border">
				<td class="border">' . $listagem['id_prod'] . '</td>
				<td class="border">' . $listagem['nome_prod'] . '</td>
				<td class="border">' . $listagem['quantidade_prod'] . '</td>
				<td class="border">' . $listagem['preco_prod'] . '</td>
				<td class="border">' . $listagem['estado_prod'] . '</td>
				<td class="border">' . $listagem['validade'] . '</td>
				<td class="border">' . $listagem['nome_categoria'] . '</td>
				<td class="border">' . $listagem['criado_prod'] . '</td>
			</tr>
	';
}
$dados .= '
		</tbody>
	</table>
</body>
';

$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml($dados);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream('Relatório-dos-produtos.pdf');
?>