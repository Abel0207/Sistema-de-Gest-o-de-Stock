<?php
require '../../config.php';
require 'verificar.php';


$categorias = [];
$cat = $pdo->query("SELECT *FROM categorias ORDER BY id_categoria");
if ($cat->rowCount() > 0) {
  $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
}
$ramos = [];
$ramo = $pdo->query("SELECT *FROM ramos ORDER BY id_ramo");
if ($ramo->rowCount() > 0) {
  $ramos = $ramo->fetchALL(PDO::FETCH_ASSOC);
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
        <img src="./assets/img/logo.png" class="navbar-brand-img h-120" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Environmental LC </span>
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
          <a class="nav-link text-white  active bg-gradient-primary" href="categorias.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar ramo</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Adicionar ramo</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user"></i>
                <span class="d-sm-inline d-none">
                  <?php echo $consulta['nome'] . '&nbsp;(' . $consulta['acesso'] . ')'; ?>
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
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3" style="padding-left: 2%;">
                <h4 style="color: white;">Cadastrar nova empresa</h4>
              </div>
            </div>
            <div class="card-body text-center">
              <div class="table-responsive p-0">
                <form method="POST" class="registrar" autocomplete="off" enctype="multipart/form-data">
                  <div class="modal-body">
                    <?php
                    if (isset($_POST["submit"])) {
                      $nome_empresa = filter_input(INPUT_POST, 'nome_empresa');
                      $numero_empresa = filter_input(INPUT_POST, 'numero_empresa');
                      $email_empresa = filter_input(INPUT_POST, 'email_empresa');
                      $endereco = filter_input(INPUT_POST, 'endereco');
                      $id_user_empresa = filter_input(INPUT_POST, 'id_user_empresa');
                      $categoria_empresa = filter_input(INPUT_POST, 'categoria_empresa');
                      $ramo_empresa = filter_input(INPUT_POST, 'ramo_empresa');
                      if (!isset($_FILES["logo_empresa"])) {
                        echo '<div class="text-danger" id="erroLogin">*Imagem não encontrada, coloque outra<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                      } else {
                        $fileName = $_FILES["logo_empresa"]["name"];
                        $fileSize = $_FILES["logo_empresa"]["size"];
                        $tmpName = $_FILES["logo_empresa"]["tmp_name"];
                        $validateImageExtension = ['jpg', 'jpeg', 'png'];
                        $imageExtension = explode('.', $fileName);
                        $imageExtension = strtolower(end($imageExtension));
                        if (!in_array($imageExtension, $validateImageExtension)) {
                          echo '<div class="text-danger" id="erroLogin">*Formato inválido, os formatos suportados são: png, jpg, e jpeg.<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                        } elseif ($fileSize > 2000000) {
                          echo '<div class="text-danger" id="erroLogin">*O tamanho da sua imagem excede os 2mb, escolha outra que seja menor que 2mb.<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                        } else {
                          $newImageName = uniqid();
                          $newImageName .= '.' . $imageExtension;
                          move_uploaded_file($tmpName, 'logo_upload/' . $newImageName);
                          if ($nome_empresa && $newImageName && $numero_empresa && $email_empresa && $endereco && $email_empresa && $endereco && $id_user_empresa && $categoria_empresa && $ramo_empresa) { /* */
                            $sql = $pdo->prepare("INSERT INTO empresas (nome_empresa, logo_empresa, numero_empresa, email_empresa, endereco, id_user_empresa, categoria_empresa, ramo_empresa)/* */ VALUES ('$nome_empresa', ' $newImageName', '$numero_empresa', '$email_empresa', '$endereco', '$id_user_empresa', ' $categoria_empresa','$ramo_empresa')"); /* */
                            $sql->execute();
                            echo '<div class="text-success" id="erroLogin">*Login feito com sucesso<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                            echo "<script>setTimeout(function(){ window.location.href = 'empresa.php';}, 3000);</script>";
                          } else {
                            echo "Erro desconhecido!";
                          }
                        }
                      }
                    }
                    ?>
                    <div class="cad d-flex">
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Nome da empresa*</label>
                        <input style="padding: 3%; border-radius: 4px; overflow:hidden; border: solid 2px;" type="text"
                          name="nome_empresa" placeholder="Nome" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="formFileSm" class="form-label">Logotipo*</label>
                        <input type="file" name="logo_empresa"
                          style="padding: 3%; border-radius: 4px; overflow:hidden; border: solid 2px;"
                          accept=".jpg, .jpeg, .png" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Nº principal da Empresa*</label>
                        <input style="padding: 3%; border-radius: 4px; overflow:hidden; border: solid 2px;" type="text"
                          minlength="9" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                          name="numero_empresa" placeholder="Quantidade do produto" class="form-control"
                          aria-describedby="emailHelp">
                      </div>
                    </div>
                    <div class="cad d-flex">
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Email principal da Empresa*</label>
                        <input style="padding: 3%; border-radius: 4px; overflow:hidden; border: solid 2px;" type="email"
                          name="email_empresa" placeholder="Email" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Endereço*</label>
                        <input style="padding: 3%; border-radius: 4px; overflow:hidden; border: solid 2px;"
                          name="endereco" placeholder="Endereço" id="verpass" type="text" class="form-control">
                      </div>
                      <input hidden name="id_user_empresa" value="<?php echo $consulta['id'] ?>">
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Categoria*</label><br>
                        <select name="categoria_empresa"
                          style="border-radius: 4px; border: solid 2px; width: 100%; height: 59%;" placeholder="Gênero"
                          style="margin: 1%;">
                          <option value="">Escolher categoria</option>
                          <?php foreach ($categorias as $lista): ?>
                            <option value="<?php echo $lista['id_categoria'] ?>"><?php echo $lista['nome_categoria'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="cad d-flex">
                      <div class="col-md-4 text-center" style="margin: 3px;">
                        <label for="exampleInputPassword1" class="form-label">Ramo*</label><br>
                        <select name="ramo_empresa"
                          style="border-radius: 4px; border: solid 2px; width: 100%; height: 80%;" placeholder="Gênero"
                          style="margin: 1%;">
                          <option value="">Escolher ramo</option>
                          <?php foreach ($ramos as $lista): ?>
                            <option value="<?php echo $lista['id_ramo'] ?>"><?php echo $lista['nome_ramo'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                      <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"
                          aria-hidden="true"></i>&nbsp;Nome</button>
                      <a href="romos.php"><button type="button" class="btn btn-outline-primary"
                          data-bs-dismiss="modal">Cancelar</button></a>
                    </div>
                  </div>
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

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
<script>
  function fecharErroLogin() {
    var divErroLogin = document.getElementById("erroLogin");
    divErroLogin.parentNode.removeChild(divErroLogin);
  }

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