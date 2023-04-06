<?php
require '../../config.php';
require 'verificar.php';


$vendas = [];
$prod = $pdo->query("SELECT *FROM produtos,vendas,usuarios WHERE produtos.id_prod = vendas.id_produto AND usuarios.id = vendas.comprador ORDER BY id_pedido ASC");
if ($prod->rowCount() > 0) {
  $vendas = $prod->fetchALL(PDO::FETCH_ASSOC);
}

$grouped_sales = [];
foreach ($vendas as $venda) {
  $cod_fat = $venda['cod_fat'];
  if (!array_key_exists($cod_fat, $grouped_sales)) {
    $grouped_sales[$cod_fat] = [];
  }
  $grouped_sales[$cod_fat][] = $venda;
}

/* SELECT Campo1, Campo2, ..., Campon FROM Tabela1, Tabela2
WHERE Tabela1.chave_estrang
eira = Tabela2.chave_primária */
$categorias = [];
$cat = $pdo->query("SELECT *FROM categorias ORDER BY id_categoria");
if ($cat->rowCount() > 0) {
  $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
}
$clientes = [];
$cli = $pdo->query("SELECT *FROM clientes ORDER BY cod_cliente");
if ($cat->rowCount() > 0) {
  $clientes = $cli->fetchALL(PDO::FETCH_ASSOC);
}


$valor_total_stock = $pdo->prepare("SELECT SUM(qtd * preco_stock) AS valor_stock FROM vendas");
$valor_total_stock->execute();
$custo_stock = $valor_total_stock->fetch(PDO::FETCH_ASSOC);

$valor_total_venda = $pdo->prepare("SELECT SUM(qtd * preco_pedido) AS valor_venda FROM vendas");
$valor_total_venda->execute();
$custo_venda = $valor_total_venda->fetch(PDO::FETCH_ASSOC);

$lucro = $custo_venda['valor_venda'] - $custo_stock['valor_stock'];

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/logo_navega.png">
  <title>Vendas</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

  <style>
    .cad {
      margin: 2%;
    }

    .cad input,
    textarea,
    select {
      background-color: rgb(220, 220, 220);
      color: black;
      padding: 2%;
    }

    .cards-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .cards {
      width: calc(33.33% - 20px);
      background-color: #f0f0f0;
      padding: 20px;
      margin-bottom: 20px;
    }

    .cards h2 {
      margin-top: 0;
    }

    .cards p {
      margin-bottom: 10px;
    }

    .price {
      display: block;
      text-align: right;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <span class="ms-1 font-weight-bold text-white">GESTÃO DE STOCK E VENDAS </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="categorias.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-th" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Categorias</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="produtos.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Produtos/Serviços</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="stock.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Stock</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="fornecedores.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-building" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Fornecedores</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="utilizadores.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Funcionários</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="clientes.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-user" aria-hidden="true"></i>
              <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Clientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="vendas.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Vendas</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Páginas da conta</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="./pages/profile.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sign-out"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Vendas</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Vendas</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Digite aqui...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user"></i>
                <span class="d-sm-inline d-none">
                  <?php echo $consulta['pnome'] . '&nbsp;' . $consulta['unome'] . '&nbsp;(' . $consulta['acesso'] . ')'; ?>
                </span>
              </a>
            </li>&nbsp;&nbsp;
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-sign-out"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Stock</p>
                <h4 class="mb-0">
                  <?php echo number_format($custo_stock['valor_stock'], 2, ",", "."); ?>&nbsp;AOA
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Custo total de aquisição dos
                  vendidos</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-usd" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Vendas</p>
                <h4 class="mb-0">
                  <?php echo number_format($custo_venda['valor_venda'], 2, ",", "."); ?>&nbsp;AOA
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Valor total das vendas efectuadas
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-money" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Lucro</p>
                <h4 class="mb-0">
                  <?php echo number_format($lucro, 2, ",", "."); ?>&nbsp;AOA
                </h4>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Lucro obtido</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                style="display: flex; justify-content:space-between;">
                <a href="" style=" margin:1%; background-color:white; color:rgb(230,54,115);"><button style="background-color:white; color:rgb(230,54,115); border-color:white; border-radius:4px;"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Relatório</button></a>
                <a onclick="adicionarprodutos()" style="color:rgb(230,54,115); margin: 1%;"><button
                    style="background-color:white; color:rgb(230,54,115); border-color:white; border-radius:4px;"><i
                      class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registrar</button></a>
              </div>
            </div>

            <div class="bg container-fluid py-4">
              <div class="row">
                <?php foreach ($grouped_sales as $cod_fat => $produtos): ?>
                  <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-3">
                    <div class="card border-2" id="card-to-download">
                      <div class="card-header p-3 pt-2">
                        <div class="d-flex justify-content-around flex-wrap pt-1">
                          <h1 class="text-sm mb-0 text-capitalize active">Produto(s)</h1>
                          <h1 class="text-sm mb-0 text-capitalize active">Quantidade(s)</h1>
                          <h1 class="text-sm mb-0 text-capitalize active">Preço(s)</h1>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap pt-1">
                          <div class="d-flex flex-column justify-content-between flex-wrap pt-1">

                            <?php foreach ($produtos as $produto): ?>
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= $produto['nome_prod'] ?>
                              </h6>
                            <?php endforeach; ?>
                          </div>
                          <div class="d-flex flex-column justify-content-between flex-wrap pt-1">

                            <?php foreach ($produtos as $produto): ?>
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= $produto['qtd'] ?>
                              </h6>
                            <?php endforeach; ?>
                          </div>
                          <div class="d-flex flex-column justify-content-between flex-wrap pt-1">

                            <?php foreach ($produtos as $produto): ?>
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= number_format($produto['preco_pedido'], 2, ",", "."); ?> AOA
                              </h6>
                            <?php endforeach; ?>
                          </div>
                        </div>
                        <div class="card-header p-3 pt-2">
                          <hr>
                          <div class="d-flex justify-content-between flex-wrap pt-1">
                            <div class="d-flex flex-column justify-content-between flex-wrap pt-1">
                              <h1 class="text-sm mb-0 text-capitalize active">Cliente</h1>
                              <h1 class="text-sm mb-0 text-capitalize active">Data de Venda</h1>
                              <h1 class="text-sm mb-0 text-capitalize active">Vendedor</h1>
                            </div>
                            <div class="d-flex flex-column justify-content-between flex-wrap pt-1">
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= ($produto['cod_fat']) ? $produto['nome_comprador'] : '' ?>
                              </h6>
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= ($produto['cod_fat']) ? $data_formatada = date('j \d\e m \d\e Y', strtotime($produto['data_registro'])) : '' ?>
                              </h6>
                              <h6 class="text-sm mb-0 text-capitalize active">
                                <?= ($produto['cod_fat']) ? $produto['vendedor'] : '' ?>
                              </h6>
                            </div>
                          </div>
                          <div class="card-header p-3 pt-2">
                            <hr>
                            <div class="d-flex justify-content-between flex-wrap pt-1">
                              <h1 class="text-sm mb-0 text-capitalize active">Total</h1>
                              <h1 class="text-sm mb-0 text-capitalize active">
                                <?php
                                $total = 0; foreach ($produtos as $produto) {
                                  $total += $produto['preco_pedido'] * $produto['qtd'];
                                }
                                echo number_format($total, 2, ",", ".") . " AOA";
                                ?>
                              </h1>
                            </div>
                          </div>
                          <hr class="dark horizontal my-0">
                          <div class="card-footer d-flex justify-content-between p-3">
                            <a href="eliminar.php?cod_fat=<?= $produto['cod_fat'] ?>" target="_blank">
                              <button style="width: 100%; border" class="rounded bg-danger text-white border-danger"><i
                                  class="fa fa-trash" aria-hidden="true"></i> Apagar</button>
                            </a>
                            <a href="factura.php?cod_fat=<?= $produto['cod_fat'] ?>"><button
                                class="rounded bg-primary text-white border-primary">
                                <i class="fa fa-print" aria-hidden="true"></i> Imprimir
                              </button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer py-4  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>,
              criado com<i class="fa fa-heart"></i> por
              <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Abel Canas</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
  </main>
  <!-- Modals -->
  <?php
  if (isset($_POST['submit'])) {
    $cod_cliente = filter_input(INPUT_POST, 'cod_cliente');
    if ($cod_cliente) {
      $sql = $pdo->prepare("SELECT * FROM clientes WHERE cod_cliente = :cod_cliente");
      $sql->bindValue(":cod_cliente", $cod_cliente);
      $sql->execute();

      $cpdr = $sql->fetch(PDO::FETCH_ASSOC);
      if ($sql->rowCount() > 0) {
        $_SESSION['comprador'] = $cpdr['cod_cliente'];
        echo "<script>window.location = '../../User/views/adicionarcarrinho.php'</script>";
      } else {
        echo "<script>alert('Seleciona um cliente')</script>";
        echo "<script>window.location = '../../Admin/views/vendas.php'</script>";
      }
    } else {
      echo "<script>alert('Seleciona um cliente')</script>";
      echo "<script>window.location = '../../Admin/views/vendas.php'</script>";
    }
  }
  ?>
  <div class="modal fade text-center" id="addProd" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Escolher Comprador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" class="registrar" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="cad">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cliente*</label><br>
                <select name="cod_cliente">
                  <option value="">Escolher</option>
                  <?php foreach ($clientes as $lista): ?>
                    <option value="<?php echo $lista['cod_cliente'] ?>"><?php echo $lista['nome_cliente']?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-success">Escolher Cliente</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>


  <script>
    function imprimirCard(botaoImprimir) {
      var card = botaoImprimir.closest(".card");
      var novaJanela = window.open('', '', 'width=800,height=600');
      novaJanela.document.write(card.outerHTML);
      novaJanela.document.close();
      novaJanela.focus();
      novaJanela.print();
      novaJanela.stop();
    }


    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    function adicionarprodutos() {
      const addProd = document.getElementById('addProd');
      const novoProd = new bootstrap.Modal(addProd);
      novoProd.show();
    }

    function editarcat() {
      const editar = document.getElementById('editar');
      const novoEdit = new bootstrap.Modal(editar);
      novoEdit.show();
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>