<?php
    require '../../config.php';
    require 'verificar.php';
    require '../../../vendor/autoload.php';

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

    if(!isset($_SESSION['itens'])){
        $_SESSION['itens'] = array();
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">

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

    
    <!-- ***** cabeçalho ***** -->
    <!-- ***** Header  ***** -->
    <<header class="header-area header-sticky">
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

    <!-- ***** top***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2 style="color: grey;">Volte sempre</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** top ***** -->

<!-- ***** recentes ***** -->
<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Venda Feita com sucesso!</i></h2>
                    <h3><a href="factura.php">Emitir Factura&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i></a></h3>
                    <p>*Se emitir a factura por duas ou mais vezes, não será possível visualizar a mesma a menos que seja o primeiro documento baixado.</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="../../Admin/views/vendas.php">Página Inicial</a>
            </div>
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
<?php
    foreach($_SESSION['dados'] as $produtos){
            $sql = $pdo->prepare("INSERT INTO vendas (id_produto, comprador, qtd, preco_stock, preco_pedido, total) VALUES (?,?,?,?,?,?)");
            $sql->bindParam(1,$produtos['idProduto']);
            $sql->bindParam(2,$produtos['comprador']);
            $sql->bindParam(3,$produtos['qtd']);
            $sql->bindParam(4,$produtos['preco_stock']);
            $sql->bindParam(5,$produtos['preco_pedido']);
            $sql->bindParam(6,$produtos['total']); 
            $sql->execute();

            $actualizar = $pdo->prepare("UPDATE produtos SET quantidade_prod=? WHERE id_prod=?");
            $actualizar->bindParam(1,$produtos['novaquantidade']);
            $actualizar->bindParam(2,$produtos['idProduto']);
            $actualizar->execute();
            
            unset( $_SESSION['itens']);
    }
        echo "<script>alert('Venda Feita!')</script>";
?>

