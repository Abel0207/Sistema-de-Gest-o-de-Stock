<?php
    require 'config.php';

    $lancamentos = [];
    $prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod DESC limit 4");
    if($prod->rowCount() > 0){
        $lancamentos = $prod->fetchALL(PDO::FETCH_ASSOC);
    }
    $antigos = [];
    $prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod ASC limit 4");
    if($prod->rowCount() > 0){
        $antigos = $prod->fetchALL(PDO::FETCH_ASSOC);
    }
    $destaque1 = [];
    $desta = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod ASC limit 2");
    if($desta->rowCount() > 0){
        $destaque1 = $desta->fetchALL(PDO::FETCH_ASSOC);
    }

    $galeria = [];
    $gal = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod ASC limit 6");
    if($gal->rowCount() > 0){
        $galeria = $gal->fetchALL(PDO::FETCH_ASSOC);
    }

    $categorias = [];
    $cat = $pdo->query("SELECT *FROM categorias");
      if($cat->rowCount() > 0){
        $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/wind.png" type="image/x-icon"/>
    
    <title>LOGIN - LOONGOKA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap');
    </style>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>
<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** cabeçalho ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo ***** -->
                        <a href="index.php" class="logo">
                            <img src="../assets/img/logo_pequeno.png" alt="logotipo">
                        </a>
                        <!-- ***** Logod ***** -->

                        <!-- ***** Menu  ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php">Início</a></li>
                            <li class="scroll-to-section"><a href="index.php">Destaques</a></li>
                            <li class="scroll-to-section"><a href="index.php">Mais Recentes</a></li>
                            <li class="scroll-to-section"><a href="index.php">Antigos</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Categorias</a>
                                <ul>
                                    <li><a href="todosprodutos.php">Todos Produtos</a></li>
                                    <?php foreach($categorias as $lista):?>
                                        <li><a href="produtos.php?id_categoria=<?=$lista['id_categoria'];?>"><?php echo $lista['nome_categoria'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <li class="scroll-to-section">
                                <a href="login.php">Login</a>
                            </li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header  ***** -->

    <section class="text-center">
    <div class="login">
        <div class="login_texto">
            <p>Bem-vindo de volta,</p>
            <h1>Acesse sua conta</h1>
        </div><br>
        <div class="login_form">
        <form action="entrar.php" method="post">
            <input type="text" placeholder="Nome de usuário" name="username"><br><br>
            <input type="password" placeholder="Senha" name="senha"><br><br>
            <button  class="btn bg-primary" type="submit">Fazer Login</button>
        </form><br>
        Esqueceu a senha? <a href="#">Recuperar senha!</a><br>
        Não possui uma conta? <a href="cadastrar.php">Cadastrar-se!</a>
        </div>
    </div>
    </section>
    
   <!-- ***** Footer  ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="../assets/img/logo_pequeno.png" alt="logotipo">
                        </div>
                        <ul>
                            <li><a href="#">Rua E, Travassa 22 - Camama/Talatona-Angola</a></li>
                            <li><a href="#">sgstock@gmail.com</a></li>
                            <li><a href="#">911-872-114</a></li>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Acesso Rápido</h4>
                    <ul>
                        <li><a href="#explore">Destaques</a></li>
                        <li><a href="#men ">Mais Recentes</a></li>
                        <li><a href="#women">Antigos</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Outros Links</h4>
                    <ul>
                        <li><a href="index.php">Página Inicial</a></li>
                        <li><a href="sobre.php">Sobre nós</a></li>
                        <li><a href="contactos.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <ul>
                        <li><a href="">Políticas de privacidade</a></li>
                        <li><a href="#">Ajuda</a></li>
                        <li><a href="">Apoio: 939-248-383   </a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2023 Abel Canas. Todos os direitos reservados. 
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

   
<!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>
  </body>
  </html>
  