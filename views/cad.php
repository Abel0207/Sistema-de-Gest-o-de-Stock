<?php
    require 'config.php';

    $username = filter_input(INPUT_POST, 'username');
    $pnome = filter_input(INPUT_POST, 'pnome');
    $unome= filter_input(INPUT_POST, 'unome');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone');
    $nasc = filter_input(INPUT_POST, 'nasc');
    $genero = filter_input(INPUT_POST, 'genero');
    $senha = filter_input(INPUT_POST, 'senha');
    $confsenha = filter_input(INPUT_POST, 'confsenha');

    if($username && $pnome && $unome && $email && $telefone && $nasc && $genero && $senha && $confsenha){
        $sql = $pdo->prepare("SELECT *FROM usuarios WHERE email = :email OR username = :username");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':username', $username);
        $sql->execute();    


        if($sql->rowCount() === 0){
            if($senha == $confsenha){

                $sql = $pdo->prepare("INSERT INTO usuarios (username, pnome, unome, email, telefone, nasc, genero, senha, confsenha) VALUES(:username, :pnome, :unome, :email, :telefone, :nasc, :genero, :senha, :confsenha)");
                $sql->bindValue(':username', $username);
                $sql->bindValue(':pnome', $pnome);
                $sql->bindValue(':unome', $unome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':nasc', $nasc);
                $sql->bindValue(':genero', $genero);
                $sql->bindValue(':senha', md5($senha));
                $sql->bindValue(':confsenha', md5($confsenha));
                $sql->execute();

                echo "<script>alert('$pnome $unome, o seu Cadastro feito com sucesso!')</script>";
                echo "<script>window.open('login.php', '_self')</script>";
                exit();
            }
            else{
                echo "<script>alert('As senhas colocadas são diferentes, tente novamente!')</script>";
                echo "<script>window.open('cadastrar.php', '_self')</script>";
            }
        }
        else{
            echo "<script>alert('Este Email ou nome de usuário já existe, tente outro!')</script>";
            echo "<script>window.open('cadastrar.php', '_self')</script>";
            exit();
        }
    }
    else{
        echo "<script>alert('Prencha todos os campos!')</script>";
        echo "<script>window.open('cadastrar.php', '_self')</script>";
        exit();
    }
    
?>