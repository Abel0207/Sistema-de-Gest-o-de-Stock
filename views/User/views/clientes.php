<?php
require '../../config.php';
require 'verificar.php';


$clientes = [];
$uti = $pdo->query("SELECT *FROM clientes ORDER BY cod_cliente");
if ($uti->rowCount() > 0) {
  $clientes = $uti->fetchALL(PDO::FETCH_ASSOC);
}

$sql = $pdo->query("SELECT COUNT(cod_cliente) AS nome FROM clientes");
$countclientes = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/logo_navega.png">
  <title>Utilizadores</title>
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
          <a class="nav-link text-white active bg-gradient-primary" href="clientes.php">
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
          <a class="nav-link text-white" href="vendas.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Funcionários</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Funcionários</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Funcionários...</label>
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
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                style="display: flex; justify-content:space-between;">
                <a href="clientesrl.php" style=" margin:1%; background-color:white; color:rgb(230,54,115);"><button style="background-color:white; color:rgb(230,54,115); border-color:white; border-radius:4px;"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Relatório</button></a>
                <a onclick="adicionarprodutos()" style="color:rgb(230,54,115); margin: 1%;"><button
                    style="background-color:white; color:rgb(230,54,115); border-color:white; border-radius:4px;"><i
                      class="fa fa-plus" aria-hidden="true"></i>&nbsp;Funcionários</button></a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-left mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome
                        Completo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Telefone</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data e
                        hora de cadastro</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações
                      </th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <?php foreach ($clientes as $lista): ?>
                    <tbody>
                      <tr>
                        <td class="text-center text-sm">
                          <?= $lista['nome_cliente'] ?>
                        </td>
                        <td class="text-center text-sm">
                          <?= $lista['email_cliente'] ?>
                        </td>
                        <td class="text-center text-sm">
                          <?= $lista['telefone_cliente'] ?>
                        </td>
                        <td class="text-center text-sm">
                          <?= $lista['data_registro'] ?>
                        </td>
                        <td class="align-middle" style="display: flex; justify-content: space-around;">
                          <a href="editaruser.php?id=<?= $lista['cod_cliente'] ?>"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            title="Editar categoria"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          <a href="excluir.php?id=<?= $lista['cod_cliente'] ?>"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Eliminar Categoria"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  <?php endforeach; ?>
                </table>
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
  <?php
  if (isset($_POST['submit'])) {
    $nome_cliente = filter_input(INPUT_POST, 'nome_cliente');
    $email_cliente = filter_input(INPUT_POST, 'email_cliente');
    $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente');

    if ($nome_cliente && $email_cliente && $telefone_cliente) {
      $sql = $pdo->prepare("SELECT * FROM clientes WHERE email_cliente = :email_cliente");
      $sql->bindValue(":email_cliente", $email_cliente);
      $sql->execute();

      if ($sql->rowCount() === 0) {
        $sql = $pdo->prepare("INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente) VALUES(:nome_cliente, :email_cliente, :telefone_cliente)");
        $sql->bindValue(':nome_cliente', $nome_cliente);
        $sql->bindValue(':email_cliente', $email_cliente);
        $sql->bindValue(':telefone_cliente', $telefone_cliente);
        $sql->execute();

        echo "<script>alert('Novo cliente adicionado!')</script>";
        echo "<script>window.open('clientes.php', '_self')</script>";
        exit();

      } else {
        echo "<script>alert('Este Email ou nome de usuário já existe, tente outro!')</script>";
        echo "<script>window.open('clientes.php', '_self')</script>";
        exit();
      }
    } else {
      echo "<script>alert('Prencha todos os campos!')</script>";
      echo "<script>window.open('clientes.php', '_self')</script>";
      exit();
    }
  }
  ?>
  <!-- Modals -->
  <div class="modal fade" id="addProd" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Novo Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" class="registrar">
          <div class="d-flex justify-content-around flex-wrap text-center">
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Nome*</label>
              <input type="text" name="nome_cliente" placeholder="Nome de Completo"
                class="form-control text-center border" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Email*</label>
              <input type="text" name="email_cliente" placeholder="Email" class="form-control text-center border"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Telefone*</label>
              <input type="number" name="telefone_cliente" placeholder="+244" class="form-control text-center border"
                aria-describedby="emailHelp">
            </div>
          </div>
          <div class="modal-footer" text-center>
            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus"
                aria-hidden="true"></i>&nbsp;Produto</button>
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
  <script>
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

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>