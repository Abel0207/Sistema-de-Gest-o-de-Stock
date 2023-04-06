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

    <form action="novouser_action.php" method="post" class="registrar">
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Usuário*</label> 
                <input type="text" name="username" placeholder="Nome de usuário" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nome*</label> 
                <input type="text" name="pnome" placeholder="Primeiro nome" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Apelido*</label> 
                <input name="unome"  placeholder="Último nome" id="verpass" type="text" class="form-control">
            </div>
        </div>
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email*</label> 
                <input type="email" name="email" placeholder="Seu email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Telefone*</label> 
                <input type="number" name="telefone" placeholder="+244" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for=""><?php $agora = date('d/m/Y H:i:s'); echo $agora;?></label>
                <label for="exampleInputPassword1" class="form-label">Data de nascimeto*</label> 
                <input min="1960-01-01" max="<?php $agora = date('d/m/Y H:i'); echo $agora;?>" name="nasc" placeholder="Data de nascimento" id="verpass" type="date" class="form-control">
            </div>
        </div>
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Gênero*</label><br>
                <select name="genero" style="border-radius: 4px;" placeholder="Gênero" style="margin: 1%;">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha*</label> 
                <input name="senha" placeholder="Sua senha" id="verpass" type="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirmar senha*</label> 
                <input name="confsenha" placeholder="Repetir senha" id="verpass" type="password" class="form-control">
            </div>
        </div>
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nível de acesso*</label><br>
                <select name="acesso" style="border-radius: 4px; margin:1%;">
                    <option value="Gerente">Gerente</option>
                    <option value="Cliente">Cliente</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">REGISTRAR-SE</button>
    </form>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>