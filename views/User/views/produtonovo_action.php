<?php

require '../../config.php';
require 'verificar.php';

        if(isset($_POST["submit"])) {
            $nome_prod = filter_input(INPUT_POST, 'nome_prod');
            $descricao = filter_input(INPUT_POST, 'descricao');
            $quantidade_prod = filter_input(INPUT_POST, 'quantidade_prod');
            $preco_prod = filter_input(INPUT_POST, 'preco_prod');
            $estado_prod = filter_input(INPUT_POST, 'estado_prod');
            $validade = filter_input(INPUT_POST, 'validade');
            $categoria = filter_input(INPUT_POST, 'categoria');
            if(!isset($_FILES["imagem_prod"])){
                echo "<script>alert('Imagem não encontrada!')</script>";
            }else{
                $fileName = $_FILES["imagem_prod"]["name"];
                $fileSize = $_FILES["imagem_prod"]["size"];
                $tmpName = $_FILES["imagem_prod"]["tmp_name"];
                $validateImageExtension = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode('.', $fileName);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validateImageExtension)) {
                    echo "<script>alert('Formato inválido!')</script>";
                }
                elseif($fileSize > 1000000){
                    echo "<script>alert('Tamanho de imagem superior ao esperado!')</script>";
                }
                else{
                    $newImageName = uniqid();       
                    $newImageName .= '.' . $imageExtension;
                    move_uploaded_file($tmpName, 'img_upload/'.$newImageName);
                    $sql = $pdo->prepare("INSERT INTO produtos (nome_prod, imagem_prod, descricao, quantidade_prod, preco_prod, estado_prod, validade, categoria) VALUES ('$nome_prod', '$newImageName', '$descricao', '$quantidade_prod', '$preco_prod', '$estado_prod', '$validade', '$categoria')");
                    $sql->execute();
                    echo "<script>alert('$nome_prod, o cadastro feito com sucesso!')</script>";
                    echo "<script>window.open('produtos.php', '_self')</script>";
                    exit();
                }
            }
        }
    ?>