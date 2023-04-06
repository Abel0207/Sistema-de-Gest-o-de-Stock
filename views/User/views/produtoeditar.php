<?php
require '../../config.php';
require 'verificar.php';

$produto = [];
$id_prod = filter_input(INPUT_GET, 'id_prod');
if ($id_prod) {

  $sql = $pdo->prepare("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria AND id_prod = :id_prod");
  $sql->bindValue(':id_prod', $id_prod);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    $produto = $sql->fetch(PDO::FETCH_ASSOC);
  } else {
    echo "<script>alert('Erro')</script>";
  }
} else {
  echo "<script>alert('Produto não encontrado')</script>";
}
$categorias = [];
$cat = $pdo->query("SELECT *FROM categorias ORDER BY id_categoria");
if ($cat->rowCount() > 0) {
  $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/logo_navega.png">
  <title>Categorias</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
        <img src="./assets/img/logo_navega.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Quitandeiros</span>
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
            <span class="nav-link-text ms-1">Categorias</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="produtos.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Produtos/Serviços</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="fornecedores.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Fornecedores</span>
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
          <a class="nav-link text-white " href="vendas.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-usd" aria-hidden="true"></i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            </div>
            <span class="nav-link-text ms-1">Vendas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="relatoria.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-area-chart" aria-hidden="true"></i>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Categorias</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Categorias</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
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
                <h6 class="text-white text-capitalize ps-3">Tabela de Categorias</h6>
                <a onclick="detalhes_modal()" style=" margin:1%; background-color:white; color:rgb(230,54,115);"><button
                    style="background-color:white; color:rgb(230,54,115); border-color:white; border-radius:4px;"><i
                      class="fa fa-plus" aria-hidden="true"></i>&nbsp;Categoria</button></a>
              </div>
            </div>
            <div class="card-body text-center px-0 pb-2">
              <form action="produtoeditar_action.php" method="POST" class="registrar" autocomplete="off"
                enctype="multipart/form-data">
                <input type="text" name="id_prod" hidden value="<?php echo $produto['id_prod']; ?>">
                <div class="d-flex text-center justify-content-around">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nome*</label>
                    <input type="text" name="nome_prod" value="<?php echo $produto['nome_prod']; ?>" class="form-control text-center border"
                      required aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Quantidade*</label>
                    <input type="number" name="quantidade_prod" value="<?php echo $produto['quantidade_prod']; ?>"
                      class="form-control text-center border" required aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Preço*</label>
                    <input name="preco_prod" value="<?php echo $produto['preco_prod']; ?>" id="verpass" type="number"
                      required class="form-control text-center border">
                  </div>
                </div>
                <div class="d-flex text-center justify-content-around">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Estado*</label><br>
                    <select name="estado_prod" style="border-radius: 4px;" required style="margin: 1%;">
                      <option value="<?php echo $produto['estado_prod']; ?>"><?php echo $produto['estado_prod']; ?>
                      </option>
                      <option value="Em stock">Em stock</option>
                      <option value="Esgotado">Esgotado</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Categoria*</label><br>
                    <select name="categoria" style="border-radius: 4px;" required style="margin: 1%;">
                      <option value="<?php echo $produto['categoria']; ?>"><?php echo $produto['nome_categoria']; ?>
                      </option>
                      <?php foreach ($categorias as $lista): ?>
                        <option value="<?php echo $lista['id_categoria']; ?>"><?php echo $lista['nome_categoria']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
              </form>
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

  <!-- Todos os modais-->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="categoriasnovo_action.php" method="post" class="registrar">
          <div class="modal-body">

            <div class="cad">
              <div class="mb-3">
                <label class="form-label">Categoria*</label>
                <input style="background-color: rgb(220,220,220); color: black; padding: 2%;" type="text"
                  name="nome_categoria" placeholder="Nome da categoria" class="form-control"
                  aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"
                aria-hidden="true"></i>&nbsp;Categoria</button>
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="removercategoria" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="categoriasnovo_action.php" method="post" class="registrar">
            <div class="cad">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria*</label>
                <input type="text" name="nome_categoria" placeholder="Nome da categoria" class="form-control"
                  aria-describedby="emailHelp">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">REGISTRAR</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }

  function detalhes_modal() {
    const myModal = document.getElementById('staticBackdrop');
    const myInput = new bootstrap.Modal(staticBackdrop);
    myInput.show();
  }
  function removercategoria() {
    const removerCategoria = document.getElementById('removercategoria');
    const remove = new bootstrap.Modal(removercategoria);
    remove.show();
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>