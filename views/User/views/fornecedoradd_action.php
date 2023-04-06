<?php

require '../../config.php';
require 'verificar.php';

$nome_forn = filter_input(INPUT_POST, 'nome_forn');
$tipo_forn = filter_input(INPUT_POST, 'tipo_forn');
$provincia_forn = filter_input(INPUT_POST, 'provincia_forn');
$email_forn = filter_input(INPUT_POST, 'email_forn');
$telefone_forn = filter_input(INPUT_POST, 'telefone_forn');

if($nome_forn && $tipo_forn && $provincia_forn && $email_forn && $telefone_forn){
    $sql = $pdo->prepare("SELECT *FROM fornecedores WHERE email_forn = :email_forn");
    $sql->bindValue(':email_forn', $email_forn);
    $sql->execute();    


    if($sql->rowCount() === 0){
            $sql = $pdo->prepare("INSERT INTO fornecedores (nome_forn, tipo_forn, provincia_forn, email_forn, telefone_forn) VALUES(:nome_forn, :tipo_forn, :provincia_forn, :email_forn, :telefone_forn)");
            $sql->bindValue(':nome_forn', $nome_forn);
            $sql->bindValue(':tipo_forn', $tipo_forn);
            $sql->bindValue(':provincia_forn', $provincia_forn);
            $sql->bindValue(':email_forn', $email_forn);
            $sql->bindValue(':telefone_forn', $telefone_forn);
            $sql->execute();

            echo "<script>alert('Novo Fornecedor Adicionado!')</script>";
            echo "<script>window.open('fornecedores.php', '_self')</script>";
            exit();
        }
        else{
            echo "<script>alert('Este Email já existe, tente outro!')</script>";
            echo "<script>window.open('fornecedores.php', '_self')</script>";
            exit();
        }
    }
    else{
        echo "<script>alert('Prencha todos os campos!')</script>";
        echo "<script>window.open('fornecedores.php', '_self')</script>";
        exit();
}

?>