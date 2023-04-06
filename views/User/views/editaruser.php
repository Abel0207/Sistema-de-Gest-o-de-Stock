<?php
require '../../config.php';
require 'verificar.php';

$usuario = [];
$id = filter_input(INPUT_GET, 'id');
if($id){
    $sql = $pdo->prepare("SELECT *FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            header("location: utilizadores.php");
        }
    }else{
        header("location: utilizadores.php");
    }
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

    <form action="editaruser_action.php" method="post" class="registrar">
        <input type="text" name="id" hidden value="<?php echo $usuario['id']?>">
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Usuário</label> 
                <input type="text" name="username" value="<?php echo $usuario['username']?>" placeholder="Nome de usuário" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nome</label> 
                <input type="text" name="pnome" value="<?php echo $usuario['pnome']?>" placeholder="Primeiro nome" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Apelido</label> 
                <input name="unome" value="<?php echo $usuario['unome']?>" placeholder="Último nome" id="verpass" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label> 
                <input type="email" name="email" value="<?php echo $usuario['email']?>" placeholder="Seu email" class="form-control" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Telefone</label> 
                <input type="number" name="telefone" value="<?php echo $usuario['telefone']?>" placeholder="+244" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Data de nascimeto</label> 
                <input name="nasc" value="<?php echo $usuario['nasc']?>" placeholder="Data de nascimento" id="verpass" type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Gênero</label><br>
                <select name="genero" style="border-radius: 4px;" placeholder="Gênero" style="margin: 1%;">
                    <option value="<?php echo $usuario['genero']?>"><?php echo $usuario['genero']?></option>
                    <option value="">---- Escolha o gênero ----</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nível de acesso*</label><br>
                <select name="acesso" style="border-radius: 4px;" placeholder="Gênero*" style="margin:1%;">
                    <option value="Admin">Administrador</option>
                    <option value="Utilizador">Utilizador</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button> 
    </form>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>