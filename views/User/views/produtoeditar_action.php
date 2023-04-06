<?php
    require '../../config.php';
    require 'verificar.php';

    $id_prod = filter_input(INPUT_POST, 'id_prod');
    $nome_prod = filter_input(INPUT_POST, 'nome_prod');
    $quantidade_prod = filter_input(INPUT_POST, 'quantidade_prod');
    $preco_prod = filter_input(INPUT_POST, 'preco_prod');
    $estado_prod = filter_input(INPUT_POST, 'estado_prod');
    $categoria= filter_input(INPUT_POST, 'categoria');

    $sql = $pdo->prepare("UPDATE produtos SET id_prod = :id_prod, nome_prod = :nome_prod, quantidade_prod = :quantidade_prod, preco_prod = :preco_prod, estado_prod = :estado_prod, categoria = :categoria WHERE id_prod = :id_prod");
    $sql->bindValue(':nome_prod', $nome_prod);
    $sql->bindValue(':quantidade_prod', $quantidade_prod);
    $sql->bindValue(':preco_prod', $preco_prod);
    $sql->bindValue(':estado_prod', $estado_prod);
    $sql->bindValue(':categoria', $categoria);
    $sql->bindValue(':id_prod', $id_prod);
    $sql->execute();

    echo "<script>alert('Foi actualizado!')</script>";
    echo "<script>window.open('produtos.php', '_self')</script>";
    exit();
?>