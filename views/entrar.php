<?php

    session_start();
    require 'config.php';

$username = filter_input(INPUT_POST, 'username');
$senha = filter_input(INPUT_POST, 'senha');
if($username && $senha){
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND senha = :senha");    
    $sql->bindValue(":username", $username);
    $sql->bindValue(":senha", md5($senha));
    $sql->execute();

    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if($sql->rowCount() > 0){
        if($row['acesso'] == 'Gerente'){
            $_SESSION['id'] = $row['id'];
            echo "<script>alert('Logado com sucesso!')</script>";
            echo "<script>window.location = 'Admin/views/dashboard.php'</script>";
        }elseif($row['acesso'] == 'Cliente'){
            $_SESSION['id'] = $row['id'];
            echo "<script>alert('Logado com sucesso!')</script>";
            echo "<script>window.location = 'User/views/index.php'</script>";
        }else{
            echo "Erro";
        }
    }
    else{
        echo "<script>alert('Email ou senha icorreta!')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }
}else{
echo "<script>alert('Prencha todos os campos para fazer login!')</script>";
echo "<script>window.location = 'login.php'</script>";
}


