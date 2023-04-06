<?php
    require '../../config.php';
    require 'verificar.php';

    /*$produtos = [];
    $prod = $pdo->query("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria");
      if($prod->rowCount() > 0){
        $produtos = $prod->fetchALL(PDO::FETCH_ASSOC);
    } */
    $produto = [];
    $id_prod = filter_input(INPUT_GET, 'id_prod');    
    if($id_prod){

        $sql = $pdo->prepare("SELECT *FROM produtos, categorias WHERE produtos.categoria = categorias.id_categoria AND id_prod = :id_prod");
        $sql->bindValue(':id_prod', $id_prod);
        $sql->execute();

        if($sql->rowCount() > 0){
            $produto = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            echo"<script>alert('Erro')</script>";
        }
    }else{
        echo"<script>alert('Produto não encontrado')</script>";
    }
    $categorias = [];
    $cat = $pdo->query("SELECT *FROM categorias ORDER BY id_categoria");
      if($cat->rowCount() > 0){
        $categorias = $cat->fetchALL(PDO::FETCH_ASSOC);
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

    <form action="produtoeditar_action.php" method="POST" class="registrar" autocomplete="off" enctype="multipart/form-data">
        <input type="text" name="id_prod" hidden value="<?php echo $produto['id_prod'];?>">
        <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nome*</label> 
                <input type="text" name="nome_prod" value="<?php echo $produto['nome_prod'];?>" class="form-control" required aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Quantidade*</label> 
                <input type="number" name="quantidade_prod" value="<?php echo $produto['quantidade_prod'];?>" class="form-control" required aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Preço*</label> 
                <input name="preco_prod"  value="<?php echo $produto['preco_prod'];?>" id="verpass" type="number" required class="form-control">
            </div> 
            </div>
            <div class="cad">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado*</label><br>
                <select name="estado_prod" style="border-radius: 4px;" required style="margin: 1%;">
                    <option value="<?php echo $produto['estado_prod'];?>"><?php echo $produto['estado_prod'];?></option>
                    <option value="Em stock">Em stock</option>
                    <option value="Esgotado">Esgotado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria*</label><br>
                <select name="categoria" style="border-radius: 4px;" required style="margin: 1%;">
                    <option value="<?php echo$produto['categoria'];?>"><?php echo $produto['nome_categoria'];?></option>
                    <?php foreach($categorias as $lista):?>
                        <option value="<?php echo $lista['id_categoria'];?>"><?php echo $lista['nome_categoria'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>