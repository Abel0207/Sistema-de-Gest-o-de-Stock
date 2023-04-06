<?php
require '../../config.php';
require 'verificar.php';
require '../../../vendor/autoload.php';

use Dompdf\Dompdf;

$clientes = [];
$uti = $pdo->query("SELECT *FROM clientes ORDER BY cod_cliente");
if ($uti->rowCount() > 0) {
  $clientes = $uti->fetchALL(PDO::FETCH_ASSOC);
}

$sql = $pdo->query("SELECT COUNT(cod_cliente) AS nome FROM clientes");
$countclientes = $sql->fetch(PDO::FETCH_ASSOC);

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
  <div class="text-center"><h2 class="text-center">RELATÓRIO DOS Clientes CADASTRADOS NO SISTEMA</h2></div>
	<div>
		<h6>Dashboard >> Clientes >> Relatório</h6>
		<h6>Relatório: Clientes</h6>
		<h6>Data de Emissão: ' . $hoje . '</h6>
	</div>
						
	<div class="text-center">
		<div style="whidth:100%; background: #ff9300; color: white; padding: 2%; margin: 2%">
			<p>Total de Clientes Cadastrados no Sistema</p>
			' . $countclientes["nome"] . '
		</div>
	<div>';
$dados .= '
	<table id="add-row" class="display table table-striped table-hover border">
		<tr class="border">
		<th class="border">Código</th>
		<th class="border">Nome Completo</th>
		<th class="border">Email</th>
		<th class="border">Data de Registro</th>
		</tr>';
foreach ($clientes as $listagem) {
	$dados .= '
		<tbody>
			<tr class="border">
				<td class="border">' . $listagem['cod_cliente'] . '</td>
				<td class="border">' . $listagem['nome_cliente'] . '</td>
				<td class="border">' . $listagem['email_cliente'] . '</td>
				<td class="border">' . $listagem['telefone_cliente'] . '</td>
				<td class="border">' . $listagem['data_registro'] . '</td>
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
$dompdf->stream('Relatório-dos-Funcionarios.pdf');
?>