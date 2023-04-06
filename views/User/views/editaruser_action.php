<?php
    require '../../config.php';

        $id = filter_input(INPUT_POST, 'id');
        $username = filter_input(INPUT_POST, 'username');
        $pnome = filter_input(INPUT_POST, 'pnome');
        $unome = filter_input(INPUT_POST, 'unome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone');
        $nasc = filter_input(INPUT_POST, 'nasc');
        $genero = filter_input(INPUT_POST, 'genero');
        $acesso = filter_input(INPUT_POST, 'acesso');

    if($username && $pnome && $unome && $email && $telefone && $nasc && $genero && $acesso){
        $sql = $pdo->prepare("SELECT *FROM usuarios WHERE email = :email OR username = :username");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':username', $username);
        $sql->execute();

        if($sql->rowCount() === 1){
        $sql = $pdo->prepare("UPDATE usuarios SET username = :username, pnome = :pnome, unome = :unome, email = :email, telefone = :telefone, nasc = :nasc, genero = :genero , acesso = :acesso WHERE id = :id");
        $sql->bindValue(':username', $username);
        $sql->bindValue(':pnome', $pnome);
        $sql->bindValue(':unome', $unome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':telefone', $telefone);
        $sql->bindValue(':nasc', $nasc);
        $sql->bindValue(':genero', $genero);
        $sql->bindValue(':acesso', $acesso);
        $sql->bindValue(':id', $id);
        $sql->execute();

        echo "<script>alert('Os seus dados foram actualizados!')</script>";
        echo "<script>window.open('utilizadores.php', '_self')</script>";
        exit();
    }else{
        echo "<script>alert('Desculpe, ocorreu um erro, tente novamente!')</script>";
        echo "<script>window.open('utilizadores.php', '_self')</script>";
        exit();
    }
}
?>