<?php
require '../../config.php';
require 'verificar.php';
/*
CREATE TABLE empresas ( id_empresa INT NOT NULL AUTO_INCREMENT ,
nome_empresa VARCHAR(500) NOT NULL , 
PRIMARY KEY (id_empresa),
numero_empresa VARCHAR(9) not null,
email_empresa VARCHAR(9) not null,
endereco VARCHAR(255) not null,
id_user_empresa int,
FOREIGN KEY (id_user_empresa) REFERENCES usuarios(id)
) ;
*/

$verificar_empresa = $consulta['id'];
$sql = $pdo->prepare("SELECT * FROM empresas, usuarios WHERE $consulta[id] = usuarios.id AND empresas.id_user_empresa = usuarios.id ");
$sql->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);
if ($sql->rowCount() <= 0) {
  echo "<script>setTimeout(function(){ window.location.href = 'cadastrarempresa.php';},);</script>";
}

$sql = $pdo->query("SELECT COUNT(id) AS pnome FROM usuarios");
$contar = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->query("SELECT COUNT(id_categoria) AS nome_categoria FROM categorias");
$categoriacount = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->query("SELECT COUNT(id_prod) AS nome_prod FROM produtos");
$prodcount = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->query("SELECT COUNT(id_forn) AS nome_forn FROM fornecedores");
$forncount = $sql->fetch(PDO::FETCH_ASSOC);

$count = [];
$ultcad = $pdo->query("SELECT *FROM usuarios ORDER BY id DESC LIMIT 4");
if ($ultcad->rowCount() > 0) {
  $count = $ultcad->fetchALL(PDO::FETCH_ASSOC);
}
$countprod = [];
$ultprod = $pdo->query("SELECT *FROM produtos ORDER BY id_prod DESC LIMIT 4");
if ($ultprod->rowCount() > 0) {
  $countprod = $ultprod->fetchALL(PDO::FETCH_ASSOC);
}

$adm = $pdo->query("SELECT COUNT(id) AS pnome FROM usuarios WHERE acesso LIKE 'Gerente'");
$contadm = $adm->fetch(PDO::FETCH_ASSOC);

$utl = $pdo->query("SELECT COUNT(id) AS pnome FROM usuarios WHERE acesso LIKE 'Empregado'");
$contutl = $utl->fetch(PDO::FETCH_ASSOC);

$prod = $pdo->query("SELECT COUNT(id_prod) AS produto FROM produtos");
$prod->execute();
$totalprodutos = $prod->fetch(PDO::FETCH_ASSOC);

$categorias_mais_produtos = $pdo->prepare("SELECT c.nome_categoria, COUNT(*) AS total_prod 
FROM produtos p 
JOIN categorias c ON p.categoria = c.id_categoria 
GROUP BY c.id_categoria 
ORDER BY total_prod;
");
$categorias_mais_produtos->execute();
$cat_mais_livro = $categorias_mais_produtos->fetchALL(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/logo_navega.png">
  <title>Painel</title>
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
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="./assets/img/logo.png" class="navbar-brand-img h-120" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Environmental LC </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="dashboard.php">
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
            <span class="nav-link-text ms-1">Objecto Social</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="produtos.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-print" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Legislação & Decretos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="stock.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-building" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Empresas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="utilizadores.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Utilizadores</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="clientes.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Avaliação</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="vendas.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Relatórios</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-th" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Categorias</p>
                <h4 class="mb-0">
                  <?php echo "$categoriacount[nome_categoria]"; ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Categorias cadastradas</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-print" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Legislações & Decretos</p>
                <h4 class="mb-0">
                  <?php echo "$prodcount[nome_prod]"; ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Produtos cadastrados</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-building" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Empresas</p>
                <h4 class="mb-0">
                  <?php echo "$forncount[nome_forn]"; ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Fornecedores cadastrados</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div
                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Utilizadores</p>
                <h4 class="mb-0">
                  <?php echo "$contar[pnome]"; ?>
                </h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Utilizadores cadastrados</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-info shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"
                    style="display: block; box-sizing: border-box; height: 170px; width: 1007px;" width="1007"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Gráfico</h6>
              <p class="text-sm ">Distribuição por níveis de acesso</p>
              <hr class="dark horizontal">
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-12 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-grey shadow-primary border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <canvas id="totalIncomeChart3" class="chart-canvas" height="170"></canvas>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 ">Gráfico</h6>
                <p class="text-sm ">Distribuição de produtos por categorias</p>
                <hr class="dark horizontal">
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 ">Gráfico</h6>
                <p class="text-sm ">Categorias, Produtos & Fornecedores</p>
                <hr class="dark horizontal">
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Últimos utilizadores cadastrados</h6>
                  </div>
                  <div class="col-lg-6 col-5 my-auto text-end">
                    <div class="dropdown float-lg-end pe-4">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome Completo
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Acesso</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data
                          de cadastro</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($count as $ultimos): ?>
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                #
                                <?= $ultimos['id'] ?>&nbsp;&nbsp;&nbsp;
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">
                                  <?= $ultimos['pnome'] ?>&nbsp;
                                  <?= $ultimos['unome'] ?>
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <?= $ultimos['username'] ?>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <?= $ultimos['acesso'] ?>
                          </td>
                          <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                <div class="progress-percentage">
                                  <?= $ultimos['data_cad'] ?>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h6>Últimos produtos cadastrados</h6>
                <p class="text-sm">
                  <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                  <span class="font-weight-bold">Últimos</span> 4
                </p>
              </div>
              <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                  <?php foreach ($countprod as $ultimos): ?>
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                      </span>
                      <div class="timeline-content">
                        <h6 class="text-dark text-sm font-weight-bold mb-0">
                          <?= $ultimos['nome_prod'] ?>
                        </h6>
                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                          <?= $ultimos['criado_prod'] ?>
                        </p>
                      </div>
                    </div>
                  <?php endforeach; ?>
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
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Gerentes", "Empregados",],
        datasets: [{
          label: "Total",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(64, 224, 208, .8)",
          data: [<?php echo "$contadm[pnome]"; ?>, <?php echo "$contutl[pnome]"; ?>],
          maxBarThickness: 6
        },],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");
    new Chart(ctx2, {
      type: "bar",
      data: {
        labels: ["Categorias", "Produtos", "Fornecedores"],
        datasets: [{
          label: "Total",
          tension: 0,
          borderWidth: 2,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "rgba(255, 255, 255, .8)",
          fill: true,
          data: [<?php echo "$categoriacount[nome_categoria]"; ?>, <?php echo "$prodcount[nome_prod]"; ?>, <?php echo "$forncount[nome_forn]"; ?>],
          maxBarThickness: 20

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var barColors3 = [
      "#F4A460",
      "#FFDEAD",
      "#FFE4C4",
      "#FF5300",
      "#D2691E",
      "#FF9300",
      "skyblue",
      "green",
      "yellow",
    ];

    var lab = [
      <?php foreach ($cat_mais_livro as $maior) {
        echo "'" . $maior['nome_categoria'] . "',";
      }
      ?>
    ];
    var dados = [
      <?php
      foreach ($cat_mais_livro as $maior) {
        echo "'" . $maior['total_prod'] . "',";
      }
      ?>
    ];

    var totalIncomeChart3 = document.getElementById('totalIncomeChart3').getContext('2d');
    var mytotalIncomeChart3 = new Chart(totalIncomeChart3, {
      type: 'bar',
      data: {
        labels: lab,
        datasets: [{
          label: 'Produtos destribuidos por categoria',
          data: dados,
          backgroundColor: barColors3,
          borderColor: '#ff9300',
        }],
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>