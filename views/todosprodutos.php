<?php
    require 'config.php';

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
        $prod = $pdo->prepare("SELECT *FROM categorias, produtos WHERE categorias.id_categoria = produtos.categoria ORDER BY id_categoria");
        $prod->execute();
        $produtos = $prod->fetchALL(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop - Product Listing Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">
<!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->

<style>
    .produtos{
            width: 300px; 
            height: 320px;
            border: 4px solid rgba(0,0,0,0.1);
            border-radius: 4px;
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

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Nossos Produtos</h2>
                        <span>Veja todos os nossos produtos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Nossos Produtos</h2>
                        <span>Veja todos os nossos produtos</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach($produtos as $lista):?>
                <div class="col-lg-4">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="comprar.php?id_prod=<?=$lista['id_prod'];?>"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                    <li title="Adicionar ao carrinho"><a href="#" onclick="acesso()"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <img class="produtos" src="Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
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
                </div>
                <?php endforeach;?>
                <div class="col-lg-12">
                    <div class="pagination">
                        <ul>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li class="active">
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
    
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

    <!-- Acesso -->
<div class="modal fade" id="acesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <i style="font-size: 6rem; color: skyblue;" class="fa fa-info-circle" aria-hidden="true"></i>
        <p>Para poder navegar entre as páginas e comprar os produtos, é necessário estar logado</p>
        <h4 style="color: grey;">Fazer Login?</h4>
      </div>
      <div class="modal-footer">
        <a href="login.php"><button type="button" class="btn btn-success">Sim</button></a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
    

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
    <script src="../assets/js/adicionais.js"></script>

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