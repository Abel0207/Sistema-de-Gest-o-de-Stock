<?php
require '../../config.php';
require 'verificar.php';

$lancamentos = [];
$prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod DESC limit 4");
if ($prod->rowCount() > 0) {
    $lancamentos = $prod->fetchALL(PDO::FETCH_ASSOC);
}

$antigos = [];
$prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod ASC limit 4");
if ($prod->rowCount() > 0) {
    $antigos = $prod->fetchALL(PDO::FETCH_ASSOC);
}
$destaque1 = [];
$desta = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod ASC limit 2");
if ($desta->rowCount() > 0) {
    $destaque1 = $desta->fetchALL(PDO::FETCH_ASSOC);
}

$galeria = [];
$gal = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria ORDER BY id_prod DESC limit 6");
if ($gal->rowCount() > 0) {
    $galeria = $gal->fetchALL(PDO::FETCH_ASSOC);
}

$categorias = [];
$cat = $pdo->query("SELECT *FROM categorias");
if ($cat->rowCount() > 0) {
    $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
}

if (!isset($_SESSION['itens'])) {
    $_SESSION['itens'] = array();
}

$id_prod = filter_input(INPUT_GET, 'id_prod');
/* Adicionar ao carrinho */
if ($id_prod) {
    $idProduto = $_GET['id_prod'];
    if (!isset($_SESSION['itens'][$idProduto])) {
        $_SESSION['itens'][$idProduto] = 1;
    } else {
        $_SESSION['itens'][$idProduto] += 1;
    }
}

$clientes = [];
$cli = $pdo->query("SELECT *FROM usuarios WHERE acesso LIKE 'Cliente' ORDER BY id");
if ($cli->rowCount() > 0) {
    $clientes = $cli->fetchALL(PDO::FETCH_ASSOC);
}  
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/logo_navega.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Sistema de Gestão de Stock</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <style>
        .thumb .imagem_principal {
            border: 10px solid rgb(163, 142, 235);
        }

        .produtos {
            width: 300px;
            height: 320px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .destaque {
            width: 300px;
            height: 255px;
            border: 4px solid rgba(0, 0, 0, 0.1);
        }

        #color {
            color: rgb(163, 142, 235);
        }
        #top1{
            color: white    ;
        }
        .gal {
            width: 100%;
            height: 185px;
            border: 1px solid rgba(0, 0, 0, 0.1);
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
                                    <?php foreach($categorias as $lista):?>
                                        <li><a href="produtos.php?id_categoria=<?=$lista['id_categoria'];?>"><?php echo $lista['nome_categoria'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <li class="scroll-to-section" title="Ver perfil">
                                <a href="../../Admin/views/dashboard.php">Painel</i></a>
                            </li>
                            <li class="scroll-to-section">
                                <a href="logout.php">Logout(<?=$consulta['pnome'];?>)</a>
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
    <div class="page-heading" id="top1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center color">
                        <h2>Registro de Produtos</h2>
                        <span>Registrar Venda</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
    <!-- ***** recentes ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Produtos registrados</h2>
                        <a href="todosprodutos.php"><i class="fa fa-plus"></i>&nbsp;Adicionar Produto</a>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    /* Exibir o carrinho */
                    if (count($_SESSION['itens']) == 0) {
                        echo 'Registro de Produto Vazio <br><a href="todosprodutos.php"><i class="fa fa-plus"></i>&nbsp;Registrar um Produto</a>';
                    } else {
                        $_SESSION['dados'] = array();

                        foreach ($_SESSION['itens'] as $idProduto => $quantidade) {
                            $sql = $pdo->prepare("SELECT * FROM produtos WHERE id_prod=?");
                            $sql->bindParam(1, $idProduto);
                            $sql->execute();
                            $produtos = $sql->fetchAll();
                            $total = ($quantidade * $produtos[0]["preco_prod"]);
                            $nova_quantidade_prod = ($produtos[0]["quantidade_prod"] - $quantidade);
                            if ($nova_quantidade_prod >= 0) {
                                echo
                                    'Nome: ' . $produtos[0]["nome_prod"] . '<br>
                                    Preço: ' . number_format($produtos[0]["preco_prod"], 2, ",", ".") . '&nbsp;KZ$<br>
                                    Nº de pedidos: ' . $quantidade . '<br>
                                    Total: ' . number_format($total, 2, ",", ".") . '&nbsp;KZ$<br><br>
                                    <a class="btn btn-outline-danger text-uppercase" href="removeritem.php?id_prod=' . $idProduto . '">Remover Registro</a>
                                    <hr>';

                                /* Passar os dados no vetor para depois pegar no banco de dados*/
                                array_push(
                                    $_SESSION['dados'],
                                    array(
                                        'idProduto' => $idProduto,
                                        'comprador' => $_SESSION['comprador'],
                                        'nome' => $produtos[0]['nome_prod'],
                                        'preco_stock' => $produtos[0]['preco_compra'],
                                        'qtd' => $quantidade,
                                        'preco_pedido' => $produtos[0]['preco_prod'],
                                        'total' => $total,
                                        'novaquantidade' => $nova_quantidade_prod
                                    )
                                );
                            } else {
                                unset($_SESSION['itens']);
                                echo "<script>alert('Pedido superior a quantidade disponível no nosso Stock!')</script>";
                                echo "<script>window.location = 'index.php'</script>";
                            }
                        }
                        echo '<div class="text-right">
                            <a class="btn btn-dark" href="todosprodutos.php">Adicionar&nbsp;<i class="fa fa-plus"></i></a>&nbsp;&nbsp;<a class="btn btn-success" href="finalizar.php">Registrar Venda</a>
                        </div>';
                    }
                    ?>
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