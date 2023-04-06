
<?php
    require '../../config.php';
    require 'verificar.php';  

    $id_categoria = filter_input(INPUT_POST, 'id_categoria');
    $nome_categoria = filter_input(INPUT_POST, 'nome_categoria');

    if($nome_categoria){
        $sql = $pdo->prepare("SELECT *FROM categorias WHERE nome_categoria = :nome_categoria");
        $sql->bindValue(':nome_categoria', $nome_categoria);
        $sql->execute();    

        if($sql->rowCount() === 0){
            $sql = $pdo->prepare("UPDATE categorias SET nome_categoria = :nome_categoria WHERE id_categoria = :id_categoria");
            $sql->bindValue(':nome_categoria', $nome_categoria);
            $sql->bindValue(':id_categoria', $id_categoria);
            $sql->execute();

            echo "<script>alert('Categoria actualizada!')</script>";
            echo "<script>window.open('categorias.php', '_self')</script>";
            exit();
        }
        else{
            echo "<script>alert('Esta categoria já existe, crie outra!')</script>";
            echo "<script>window.open('categorias.php', '_self')</script>";
            exit();
        }
    }
    else{
        echo "<script>alert('Coloque o nome da categoria!')</script>";
        echo "<script>window.open('categorias.php', '_self')</script>";
        exit();
    }
?>
