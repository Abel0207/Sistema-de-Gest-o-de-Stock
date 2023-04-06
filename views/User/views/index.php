<?php
    require '../../config.php';
    require 'verificar.php';
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_navega.png" type="image/x-icon"/>
    
    <!-- Boostrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Estilo CSS -->
    <link rel="stylesheet" href="../assets/css/estilo.css">

    <title>Início - quitandeiros</title>
</head>
<body>
    <header class="cabecalho">
        <div class="logotipo">
            <img src="../assets/img/logo_pequeno.png" alt="logotipo">
        </div>
        <div class="nav-menu">
            <ul class="menu">
                <li><a href="index.php">LOJA ONLINE</a></li>
                <li><a href="#">SOBRE NÓS</a></li>
                <li><a href="dashboard.php" class="btn-menu log">PAINEL</a></li>
                <li><a href="logout.php" class="btn-menu reg">LOGOUT</a></li>
            </ul>
        </div>
    </header>    

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>