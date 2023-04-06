<?php
    require '../../config.php';
    require 'verificar.php';  

    $nome_categoria = filter_input(INPUT_POST, 'nome_categoria');

    if($nome_categoria){
        $sql = $pdo->prepare("SELECT *FROM categorias WHERE nome_categoria = :nome_categoria");
        $sql->bindValue(':nome_categoria', $nome_categoria);
        $sql->execute();    

        if($sql->rowCount() === 0){
            $sql = $pdo->prepare("INSERT INTO categorias (nome_categoria) VALUES(:nome_categoria)");
            $sql->bindValue(':nome_categoria', $nome_categoria);
            $sql->execute();

            echo "<script>alert('O cadastro da categoria $nome_categoria foi feito com sucesso!')</script>";
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