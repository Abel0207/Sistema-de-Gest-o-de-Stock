<?php
session_start();
require 'config.php';
?>
<!DOCTYPE html>
<html lang="pt br">

<head>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="icon" href="./img/wind.png" type="image/x-icon" />
    <title>Sistema de Gestão de Stock e Venda</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            display: flex;
            flex-direction
        }

        .wave {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 100%;
            z-index: -1;
        }

        .container {
            width: 100vw;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20rem;
            padding: 0 2rem;
        }

        .img {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .login-content {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
        }

        .img img {
            width: 500px;
        }

        form {
            width: 360px;
        }

        .login-content img {
            height: 100px;
        }

        .login-content h2 {
            margin: 15px 0;
            color: #333;
            text-transform: uppercase;
            font-size: 2.9rem;
        }

        .login-content .input-div {
            position: relative;
            display: grid;
            grid-template-columns: 7% 93%;
            margin: 25px 0;
            padding: 5px 0;
            border-bottom: 2px solid rgb(254, 220, 40);
        }

        .login-content .input-div.one {
            margin-top: 0;
        }

        .i {
            color: rgb(254, 220, 40);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .i i {
            transition: .3s;
        }

        .input-div>div {
            position: relative;
            height: 45px;
        }

        .input-div>div>h5 {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            transition: .3s;
        }

        .input-div:before,
        .input-div:after {
            content: '';
            position: absolute;
            bottom: -2px;
            width: 0%;
            height: 2px;
            background-color: rgb(254, 220, 40);
            transition: .4s;
        }

        .input-div:before {
            right: 50%;
        }

        .input-div:after {
            left: 50%;
        }

        .input-div.focus:before,
        .input-div.focus:after {
            width: 50%;
        }

        .input-div.focus>div>h5 {
            top: -5px;
            font-size: 15px;
        }

        .input-div.focus>.i>i {
            color: rgb(254, 220, 40);
        }

        .input-div>div>input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            background: none;
            padding: 0.5rem 0.7rem;
            font-size: 1.2rem;
            color: #555;
            font-family: 'poppins', sans-serif;
        }

        .input-div.pass {
            margin-bottom: 4px;
        }

        a {
            display: block;
            text-align: right;
            text-decoration: none;
            color: #999;
            font-size: 0.9rem;
            transition: .3s;
        }

        a:hover {
            color: rgb(254, 220, 40);
        }

        .btn {
            display: block;
            width: 100%;
            height: 50px;
            border-radius: 25px;
            outline: none;
            border: none;
            background-image: linear-gradient(to right, rgb(254, 220, 40), rgb(254, 220, 40), rgb(254, 220, 0));
            background-size: 200%;
            font-size: 1.2rem;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            margin: 1rem 0;
            cursor: pointer;
            transition: .5s;
        }

        .btn:hover {
            background-position: right;
        }

        .acessos {
            display: flex;
            justify-content: space-between;
        }

        @media screen and (max-width: 1050px) {
            .container {
                grid-gap: 5rem;
            }
        }

        @media screen and (max-width: 1000px) {
            form {
                width: 290px;
            }

            .login-content h2 {
                font-size: 2.4rem;
                margin: 8px 0;
            }

            .img img {
                width: 400px;
            }
        }

        @media screen and (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .img {
                display: none;
            }

            .wave {
                display: none;
            }

            .login-content {
                justify-content: center;
            }
        }

        /* Preloder */

        #preloder {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999999;
            background: #000;
        }

        .loader {
            width: 40px;
            height: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -13px;
            margin-left: -13px;
            border-radius: 60px;
            animation: loader 0.8s linear infinite;
            -webkit-animation: loader 0.8s linear infinite;
        }

        @keyframes loader {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
                border: 4px solid #f44336;
                border-left-color: transparent;
            }

            50% {
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
                border: 4px solid #673ab7;
                border-left-color: transparent;
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
                border: 4px solid #f44336;
                border-left-color: transparent;
            }
        }

        @-webkit-keyframes loader {
            0% {
                -webkit-transform: rotate(0deg);
                border: 4px solid #f44336;
                border-left-color: transparent;
            }

            50% {
                -webkit-transform: rotate(180deg);
                border: 4px solid #673ab7;
                border-left-color: transparent;
            }

            100% {
                -webkit-transform: rotate(360deg);
                border: 4px solid #f44336;
                border-left-color: transparent;
            }
        }
    </style>

</head>

<body>

    <img class="wave" style="width:50%;"
        src="https://www.unicesumar.edu.br/blog/wp-content/uploads/2020/01/seguran%C3%A7a-no-trabalho.jpg">
    <div class="container">
        <div class="img"></div>
        <div class="login-content">
            <form method="post">
                <img src="assets/img/logo.png">
                <?php
                if (isset($_POST['submit'])) {
                    $username = filter_input(INPUT_POST, 'username');
                    $senha = filter_input(INPUT_POST, 'senha');
                    if ($username && $senha) {
                        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND senha = :senha");
                        $sql->bindValue(":username", $username);
                        $sql->bindValue(":senha", md5($senha));
                        $sql->execute();

                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        if ($sql->rowCount() > 0) {
                            if ($row['acesso'] == 'Admin') {
                                $_SESSION['id'] = $row['id'];
                                echo '<div class="text-success" id="erroLogin">*Login feito com sucesso<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                                echo "<script>setTimeout(function(){ window.location.href = 'Admin/views/dashboard.php';}, 1000);</script>";
                            } elseif ($row['acesso'] == 'Cliente') {
                                $_SESSION['id'] = $row['id'];
                                echo '<div class="text-success" id="erroLogin">*Login feito com sucesso<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                                echo "<script>setTimeout(function(){ window.location.href = 'indexuser.php';}, 1000);</script>";
                            } else {
                                echo '<div class="text-danger" id="erroLogin">*O login falhou, tente mais tarde.<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                            }
                        } else {
                            echo '<div class="text-danger" id="erroLogin">*Nome de usuário ou senha incorrecta, tente novamente <button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                        }
                    } else {
                        echo '<div class="text-danger" id="erroLogin">*Prencha todos os campos e tente novamente <button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                    }
                }
                ?>
                <h2 class="title">Bem vindo</h2>
                <h6>Environmental Legal Compliance</h6>
                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername"></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa fa-at"></i></div>
                        <input type="text" class="form-control" name="username" id="inlineFormInputGroupUsername"
                            placeholder="Usuário" required>
                    </div>
                </div>
                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername"></label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                        <input type="password" class="form-control" name="senha"
                            id="senha" placeholder="Senha" required>
                    </div>
                </div>
                <div class="acessos" style="margin-top: 5%;">
                    <a style="text-decoration: none;" href="recuperarsenha.php">Esqueceu sua senha?</a>
                    <div id="btnMostrarSenha" style="display: flex; justify-content: space-between;">
                        <i style="color: rgb(254,220,40);" class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn" value="Login">
                <div class="d-flex flex-start" style="justify-content: space-between">
                    <a href="cadastrar.php">Não possui uma conta?</a></p>
                    <a href="index.php">Início</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function fecharErroLogin() {
            var divErroLogin = document.getElementById("erroLogin");
            divErroLogin.parentNode.removeChild(divErroLogin);
        }

        var btnMostrarSenha = document.getElementById("btnMostrarSenha");
        var senhaInput = document.getElementById("senha");

        btnMostrarSenha.addEventListener("click", function () {
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
                btnMostrarSenha.innerHTML = '<i style="color: rgb(254,220,40);" class="fa fa-eye-slash" aria-hidden="true"></i>';
            } else {
                senhaInput.type = "password";
                btnMostrarSenha.innerHTML = '<i style="color: rgb(254,220,40);" class="fa fa-eye" aria-hidden="true"></i>';
            }
        });
        const inputs = document.querySelectorAll(".input");
        function addcl() {
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }

        function remcl() {
            let parent = this.parentNode.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }


        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });

    </script>
</body>

</html>