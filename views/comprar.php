<?php
    require 'config.php';

    $categorias = [];
    $cat = $pdo->query("SELECT *FROM categorias");
      if($cat->rowCount() > 0){
        $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
    }

$produtos = [];
$id_prod = filter_input(INPUT_GET, 'id_prod');
if($id_prod){
    $sql = $pdo->prepare("SELECT *FROM produtos WHERE id_prod = :id_prod");
    $sql->bindValue(':id_prod', $id_prod);
    $sql->execute();

        $prod = $pdo->prepare("SELECT *FROM produtos, categorias WHERE id_prod = :id_prod AND produtos.categoria = categorias.id_categoria ORDER BY id_prod");
        $prod->bindValue(':id_prod', $id_prod);
        $prod->execute();

        if($prod->rowCount() > 0){
            $produtos = $prod->fetchALL(PDO::FETCH_ASSOC);
        }else{
            echo "<script>alert('Categoria sem produtos')</script>";
        header("location:index.php");
        }
    }else{
        echo "Abel";
    }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop - Product Detail Page</title>


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
        .comprar{
            width: 200px; 
            height: 500px;
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
                    <h2 style="color: grey;">Compre já</h2>
                        <span style="color: grey;">Este é o seu produto</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Product Area Starts ***** -->
    <?php foreach($produtos as $lista):?>
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <div class="left-images">
                <img class="comprar" src="Admin/views/img_upload/<?php echo$lista['imagem_prod'];?>" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <h4><?php echo$lista['nome_prod'];?></h4>
                    <span class="price"><?php echo number_format($lista['preco_prod'],2,",",".");?>&nbsp;$KZ</span>
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
                    <span><?php echo$lista['descricao'];?></span>
                    <div class="quote">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i><p>Categoria: <?php echo$lista['nome_categoria'];?><br>Estado: <?php echo$lista['estado_prod'];?></p>
                    </div>
                    <div class="quantity-content">
                        <div class="left-content">
                            <h6>Nº de Pedidos</h6>
                        </div>
                        <div class="right-content">
                            <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                            </div>
                        </div>
                    </div>
                    <div class="total">
                        <h4>Total: $210.00</h4>
                        <div class="main-border-button"><a href="#" onclick="acesso()">Adicionar&nbsp;<i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <?php endforeach;?>
    <!-- ***** Product Area Ends ***** -->
    
    
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
    <script src="assets/js/quantity.js"></script>
    
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
