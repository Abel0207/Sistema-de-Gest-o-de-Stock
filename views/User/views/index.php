<?php
    require '../../config.php';
    require 'verificar.php';

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
    $gal = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod DESC limit 6");
    if($gal->rowCount() > 0){
        $galeria = $gal->fetchALL(PDO::FETCH_ASSOC);
    }

    $categorias = [];
    $cat = $pdo->query("SELECT *FROM categorias");
      if($cat->rowCount() > 0){
        $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
    }

    $quantidade = [];
    $ver = $pdo->query("SELECT *FROM produtos WHERE quantidade_prod = 0 AND estado_prod = 'Em stock'");
      if($ver->rowCount() > 0){
        $quantidade = $ver->fetch(PDO::FETCH_ASSOC);
        $identificador = $quantidade['id_prod'];
        $novoestado = 'Esgotado';
        $trocar = $pdo->prepare("UPDATE produtos SET estado_prod = 'Esgotado' WHERE id_prod = $identificador");
        $trocar->execute(); 
    }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/logo_navega.png" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sistema de Gestão de Stock</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <style>
        .thumb .imagem_principal{
            border: 10px solid rgb(163,142,235);
        }
        .produtos{
            width: 300px; 
            height: 320px;
            border: 4px solid rgba(0,0,0,0.1);
            border-radius: 4px;
        }
        .destaque{
            width: 300px; 
            height: 255px;
            border: 4px solid rgba(0,0,0,0.1);
        }
        #color{
            color: rgb(163,142,235);
        }
        .gal{
            width: 100%;
            height: 185px; 
            border: 1px solid rgba(0,0,0,0.1);
        }
    </style>
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
                            <li class="scroll-to-section"><a href="#top">Início</a></li>
                            <li class="scroll-to-section"><a href="#explore">Destaques</a></li>
                            <li class="scroll-to-section"><a href="#men">Mais Recentes</a></li>
                            <li class="scroll-to-section"><a href="#women">Antigos</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Categorias</a>
                                <ul>
                                    <li><a href="todosprodutos.php">Todos Produtos</a></li>
                                    <?php foreach($categorias as $lista):?>
                                        <li><a href="produtos.php?id_categoria=<?=$lista['id_categoria'];?>"><?php echo $lista['nome_categoria'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <li class="scroll-to-section" title="Ver carrinho">
                                <a href="adicionarcarrinho.php"><i style="font-size: 2rem;" class="fa fa-shopping-cart"></i></a>
                            </li>
                            <li class="scroll-to-section" title="Ver perfil">
                                <a href="#"><i style="font-size: 2rem;" class="fa fa-user"></i></a>
                            </li>
                            <li class="scroll-to-section">
                                <a href="logout.php">Logout</a>
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

    <!-- ***** top ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>ENCONTRE AQUI O QUE PROCURA</h4>
                                <span>Desde Materiais Electrônicos à Bens Alimentícios</span>
                                <div class="main-border-button">
                                    <a href="#">Compre Aqui!</a>
                                </div>
                            </div>
                            <img src="../assets/img/imagemprincipal.jpg" class="imagem_principal" alt="...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 id="color">SMARTPHONES</h4>
                                            <h6 id="color">Os melhores da atualidade</h6>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>SMARTPHONES</h4>
                                                <p>Pesquise aqui os melhores dispositivos para si</p>
                                                <div class="main-border-button">
                                                    <a href="#">Ver Mais</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="../assets/img/telefones.png" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 id="color">ELECTODOMÉSTICOS</h4>
                                            <h6 id="color">Qualidade & Modernismo</h6>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>ELECTODOMÉSTICOS</h4>
                                                <p>Pesquise aqui os melhores Electrodomésticos  </p>
                                                <div class="main-border-button">
                                                    <a href="#">Ver Mais</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="../assets/img/electro.png" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Bens Alimentícios</h4>
                                            <span>Alimentos de qualidade</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Bens Alimentícios</h4>
                                                <p>Encontre aqui bens alimentícios de alta qualidade</p>
                                                <div class="main-border-button">
                                                    <a href="#">Ver Mais</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="../assets/img/alimentos.jpg" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Acessórios</h4>
                                            <span>Nossos acessórios</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Acessórios</h4>
                                                <p>Acessórios de electrodomésticos, smartphones e muito mais</p>
                                                <div class="main-border-button">
                                                    <a href="#">Ver Mais</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/baner-right-image-04.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** top***** -->

     <!-- ***** destaques ***** -->
     <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Explore os nossos produtos</h2>
                        <span>Compre aqui os melhores produtos do mercado ao melhor preço, com confiança, responsabilidade e rapidez. Não espere mais, compre já!</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i><p>Satisfazer as necessidades dos nossos clientes é o nosso objectivo.</p>
                        </div>
                        <p>A nossa missão é sobretudo oferecer uma plataforma de compras online fácil de utilizar e segura. Esta é uma plataforma com que os angolanos se vão identificar, com uma identidade forte e valores firmes.</p>
                        <p>É inegável que as compras online são o futuro e não temos dúvidas de que o presente e o futuro dos classificados online em Angola passa aqui pela nossa Plataforma!</p>
                        <div class="main-border-button">
                            <a href="products.html">Ver mais</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                        <?php foreach($destaque1 as $lista):?>
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4><?php echo$lista['nome_prod'];?></h4>
                                    <a class="btn btn-outline-dark" href="comprar.php?id_prod=<?=$lista['id_prod'];?>">Ver mais</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img class="destaque" src="../../Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** destaques***** -->

    <!-- ***** recentes ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Produtos Recentes</h2>
                        <h6>Veja os detalhes dos nossos produtos mais recentes.</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php foreach($lancamentos as $lista):?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="comprar.php?id_prod=<?=$lista['id_prod'];?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li title="Adicionar ao carrinho"><a href="adicionarcarrinho.php?id_prod=<?=$lista['id_prod'];?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img class="produtos" src="../../Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
                                </div>
                                <div class="down-content">
                                        <h4><?php echo$lista['nome_prod'];?></h4>
                                    <span><?php echo number_format($lista['preco_prod'],2,",",".");?>&nbsp;$KZ</span>
                                    <ul class="stars">
                                        <?php 
                                            if ($lista['estado_prod'] == 'Em stock') {
                                                $iddoProduto = $lista['id_prod'];
                                                echo'<li style="color:green;">'.$lista['estado_prod'].'</li>'; 
                                            }else{
                                                echo'<li style="color:red;">'.$lista['estado_prod'].'</li>'; 
                                            }
                                        ?>:
                                        <li><?php echo$lista['quantidade_prod'];?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** recentes ***** -->

    <!-- ***** antigos ***** -->
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Produtos Antigos</h2>
                        <h6>Veja os detalhes dos nossos produtos mais antigos.</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                        <?php foreach($antigos as $lista):?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="comprar.php?id_prod=<?=$lista['id_prod'];?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li title="Adicionar ao carrinho"><a href="adicionarcarrinho.php?id_prod=<?=$lista['id_prod'];?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img class="produtos" src="../../Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
                                </div>
                                <div class="down-content">
                                    <h4><?php echo$lista['nome_prod'];?></h4>
                                    <span><?php echo number_format($lista['preco_prod'],2,",",".");?>&nbsp;$KZ</span>
                                    <ul class="stars">
                                        <?php 
                                            if ($lista['estado_prod'] == 'Em stock') {
                                                $iddoProduto = $lista['id_prod'];
                                                echo'<li style="color:green;">'.$lista['estado_prod'].'</li>'; 
                                            }else{
                                                echo'<li style="color:red;">'.$lista['estado_prod'].'</li>'; 
                                            }
                                        ?>:
                                        <li><?php echo$lista['quantidade_prod'];?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** antigos ***** -->

    <!-- ***** galeria ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Galeria</h2>
                        <span>Nossa galeria de produtos recentes.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
            <?php foreach($galeria as $lista):?>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6><?php echo$lista['nome_categoria'];?></h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img class="gal" src="../../Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </section>
    <!-- *****  galeria ***** -->

    <!-- ***** assinar ***** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>Subscreva e fique por dentro das nossas actualizações</h2>
                        <span>Detalhes a detalhes é o que torna a nossa plataforma diferente das outras</span>
                    </div>
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                          <div class="col-lg-5">
                            <fieldset>
                              <input name="" type="text" id="name" placeholder="Seu nome" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-5">
                            <fieldset>
                              <input name="email" type="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Seu endereço de email" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-2">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-dark-button"><i class="fa fa-paper-plane"></i></button>
                            </fieldset>
                          </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li>Telefone:<br><span>911-872-114</span></li>
                                <li>Email:<br><span>sgstock@gmail.com</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>Atendimento:<br><span>24/7 dias</span></li>
                                <li>Mídia Social:<br><span><a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Behance</a>, <a href="#">Linkedin</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** assinar ***** -->
    
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