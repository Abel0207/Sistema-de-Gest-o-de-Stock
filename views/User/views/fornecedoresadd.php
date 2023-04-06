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

    <title>Registrar - quitandeiros</title>
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
                <li><a href="login.php" class="btn-menu log">LOGIN</a></li>
                <li><a href="cadastrar.php" class="btn-menu reg">REGISTRAR-SE</a></li>
            </ul>
        </div>
    </header><br><br><br> 
    <h1 class="text-center">Novo Fornecedor</h1><br><br>
    <form action="fornecedoradd_action.php" method="post" class="registrar">
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Fornecedor*</label> 
                <input type="text" name="nome_forn" placeholder="Nome do fornecedor" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">				
                <label for="exampleInputPassword1" class="form-label">Tipo</label> <br>
                <select name="tipo_forn" style="border-radius: 4px; margin:1%;">
                    <option>Escolher tipo de fornecedor</option>
                    <option value="Empresa">Empresa</option>
                    <option value="Pessoa Singular">Pessoa Singular</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Província*</label>
                <select name="provincia_forn" style="border-radius: 4px; margin:1%;">
                    <option>Escolher tipo de fornecedor</option>
                    <option value="Bengo">Bengo</option>
                    <option value="Benguela">Benguela</option>
                    <option value="Bie">Bie</option>
                    <option value="Cabinda">Cabinda</option>
                    <option value="Cuando Cubango">Cuando Cubango</option>
                    <option value="Cuanza Norte">Cuanza Norte</option>
                    <option value="Cuanza Sul">Cuanza Sul</option>
                    <option value="Cunene">Cunene</option>
                    <option value="Huambo">Huambo</option>
                    <option value="Huila">Huila</option>
                    <option value="Luanda">Luanda</option>
                    <option value="Lunda Norte">Lunda Norte</option>
                    <option value="Lunda Sul">Lunda Sul</option>
                    <option value="Malanje">Malanje</option>
                    <option value="Moxico">Moxico</option>
                    <option value="Namibe">Namibe</option>
                    <option value="Uige">Uige</option>
                    <option value="Zaire">Zaire</option>
                    
                </select> 
            </div>
        </div>
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email Do Fornecedor*</label> 
                <input type="email" name="email_forn" placeholder="Seu email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nº de Telefone*</label> 
                <input type="number" name="telefone_forn" placeholder="+244" class="form-control" aria-describedby="emailHelp">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Fornecedor</button>
    </form>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>