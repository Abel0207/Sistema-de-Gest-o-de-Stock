<?php
require '../../config.php';
require 'verificar.php';


$categorias = [];
$cat = $pdo->query("SELECT *FROM categorias");
if ($cat->rowCount() > 0) {
    $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
}

$produtos = [];
$id_categoria = filter_input(INPUT_GET, 'id_categoria');
if ($id_categoria) {
    $sql = $pdo->prepare("SELECT *FROM categorias WHERE id_categoria = :id_categoria");
    $sql->bindValue(':id_categoria', $id_categoria);
    $sql->execute();

    $prod = $pdo->prepare("SELECT *FROM categorias, produtos WHERE id_categoria = :id_categoria AND categorias.id_categoria = produtos.categoria ORDER BY id_categoria");
    $prod->bindValue(':id_categoria', $id_categoria);
    $prod->execute();

    if ($prod->rowCount() > 0) {
        $produtos = $prod->fetchALL(PDO::FETCH_ASSOC);
    } else {
        echo "<script>alert('Categoria sem produtos')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }
} else {
    echo "<script>alert('Categoria sem produtos')</script>";
    echo "<script>window.open('index.php', '_self')</script>";
}
$ncat = [];
$sql = $pdo->prepare("SELECT nome_categoria FROM categorias WHERE id_categoria = :id_categoria");
$sql->bindValue(':id_categoria', $id_categoria);
$sql->execute();
if ($sql->rowCount() > 0) {
    $ncat = $sql->fetch(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Hexashop - Product Listing Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <style>
        .produtos {
            width: 300px;
            height: 320px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        #top1 {
            color: white;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader  ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader  ***** -->

    <!-- ***** Header  ***** -->
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
                            <li class="scroll-to-section" title="Ver carrinho">
                                <a href="adicionarcarrinho.php">Produtos Registrados</a>
                            </li>
                            <li><a href="todosprodutos.php">Todos Produtos</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Categorias</a>
                                <ul>
                                    <?php foreach ($categorias as $lista): ?>
                                        <li><a href="produtos.php?id_categoria=<?= $lista['id_categoria']; ?>"><?php echo $lista['nome_categoria']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="scroll-to-section" title="Ver perfil">
                                <a href="../../Admin/views/dashboard.php">Painel</i></a>
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
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2 style="color: grey;">Nossos Produtos</h2>
                        <h2 style="color: grey;">
                            <?php echo $ncat['nome_categoria']; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** top ***** -->


    <!-- ***** produtos ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Nossos produtos</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($produtos as $lista): ?>
                    <div class="col-lg-4">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="comprar.php?id_prod=<?= $lista['id_prod']; ?>"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                        <li title="Adicionar ao carrinho"><a
                                                href="adicionarcarrinho.php?id_prod=<?= $lista['id_prod']; ?>"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <img class="produtos" src="../../Admin/views/img_upload/<?php echo $lista['imagem_prod']; ?>"
                                    alt="">
                            </div>
                            <div class="down-content">
                                <h4>
                                    <?php echo $lista['nome_prod']; ?>
                                </h4>
                                <span>
                                    <?php echo number_format($lista['preco_prod'], 2, ",", "."); ?>&nbsp;$KZ
                                </span>
                                <ul class="stars">
                                    <?php
                                    if ($lista['estado_prod'] == 'Em stock') {
                                        $iddoProduto = $lista['id_prod'];
                                        echo '<li style="color:green;">' . $lista['estado_prod'] . '</li>';
                                    } else {
                                        echo '<li style="color:red;">' . $lista['estado_prod'] . '</li>';
                                    }
                                    ?>:
                                    <li>
                                        <?php echo $lista['quantidade_prod']; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--
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
                </div> -->
        </div>
        </div>
    </section>
    <!-- ***** produtos ***** -->

    <!-- ***** Footer ***** -->
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
                        <li><a href="">Apoio: 939-248-383 </a></li>
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

        $(function () {
            var selectedClass = "";
            $("p").click(function () {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function () {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });

    </script>

</body>

</html>