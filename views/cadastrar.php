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
        }

        .container {
            text-align: center;
        }

        .divisor {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1%;
        }

        .divisor .input-div {
            display: flex;
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

        .ligacoes {
            justify-content: center;
            width: 60%;
            margin-top: 2%;
        }

        .acessos {
            display: flex;
            justify-content: space-around;
            width: 56%;
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
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>

<body>
    <header class="cabecalho">
        <div class="logotipo">
            <img src="assets/img/logo1.jpeg" alt="logotipo">
        </div>
        <div class="nav-menu">
            <ul class="menu">


                <li><a href="login.php" class="btn-menu log">LOGIN</a></li>
                <li><a href="cadastrar.php" class="btn-menu reg">REGISTRAR-SE</a></li>

            </ul>
        </div>
    </header>

    <div class="container">
        <div class="img"></div>
        <div class="login-content">
            <form method="post">
                <img src="assets/img/logo.png">
                <?php
                if (isset($_POST['submit'])) {
                    $username = filter_input(INPUT_POST, 'username');
                    $nome = filter_input(INPUT_POST, 'nome');
                    $bi = filter_input(INPUT_POST, 'bi');
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $telefone = filter_input(INPUT_POST, 'telefone');
                    $nasc = filter_input(INPUT_POST, 'nasc');
                    $genero = filter_input(INPUT_POST, 'genero');
                    $senha = filter_input(INPUT_POST, 'senha');
                    $confirmarsenha = filter_input(INPUT_POST, 'confirmarsenha');

                    if ($username && $nome && $bi && $email && $telefone && $nasc && $genero && $senha && $confirmarsenha) {
                        $sql = $pdo->prepare("SELECT *FROM usuarios WHERE email = :email OR username = :username");
                        $sql->bindValue(':email', $email);
                        $sql->bindValue(':username', $username);
                        $sql->execute();

                        if ($sql->rowCount() === 0) {
                            if ($senha == $confirmarsenha) {
                                $sql = $pdo->prepare("INSERT INTO usuarios (username, nome, bi, email, telefone, nasc, genero, senha) VALUES(:username, :nome, :bi, :email, :telefone, :nasc, :genero, :senha)");
                                $sql->bindValue(':username', $username);
                                $sql->bindValue(':nome', $nome);
                                $sql->bindValue(':bi', $bi);
                                $sql->bindValue(':email', $email);
                                $sql->bindValue(':telefone', $telefone);
                                $sql->bindValue(':nasc', $nasc);
                                $sql->bindValue(':genero', $genero);
                                $sql->bindValue(':senha', md5($senha));
                                $sql->execute();
                                echo '<div class="text-success" id="erroLogin">*Cadastro feito com sucesso<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                                echo "<script>setTimeout(function(){ window.location.href = 'login.php';}, 1500);</script>";

                            } else {
                                echo '<div class="text-success" id="erroLogin">*As senhas colocadas são diferentes, tente novamente!<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                            }
                        } else {
                            echo '<div class="text-success" id="erroLogin">*Este Email ou nome de usuário já existe, tente outro!<button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                        }
                    } else {
                        echo '<div class="text-danger" id="erroLogin">*Prencha todos os campos e tente novamente <button type="button" class="close" onclick="fecharErroLogin()"><span>&times;</span></button></div>';
                    }
                }
                ?>
                <h2 class="title">Bem vindo</h2>
                <h6>Environmental Legal Compliance</h6>
                <div class="divisor">
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Nome de Usuário*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-at"></i></div>
                            <input type="text" class="form-control" minlength="8" maxlength="16" name="username" id="inlineFormInputGroupUsername"
                                placeholder="Usuário">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Nome Completo*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <input type="text" class="form-control" name="nome" id="inlineFormInputGroupUsername"
                                placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">BI/NIF*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-id-card" aria-hidden="true"></i></div>
                            <input type="text" class="form-control" name="bi" id="inlineFormInputGroupUsername"
                                placeholder="BI/NIF">
                        </div>
                    </div>

                </div>
                <div class="divisor">
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Email*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <input type="email" class="form-control" name="email" id="inlineFormInputGroupUsername"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Número de Telefone</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <input type="text" minlength="9" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="telefone" id="inlineFormInputGroupUsername"
                                placeholder="Tel.">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Data de Nascimento*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <input type="date" min="<?php echo date('Y-m-d', strtotime('-100 year'));?>" max="<?php echo date('Y-m-d', strtotime('-6 year'));?>" class="form-control" name="nasc" id="inlineFormInputGroupUsername"
                                placeholder="Nascimento">
                        </div>
                    </div>
                </div>
                <div class="divisor">
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Gênero*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-mars-stroke" aria-hidden="true"></i></div>
                            <select name="genero" class="form-control" aria-label=".form-select-lg example">
                                <option selected>Selecione</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Senha*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            <input type="password" class="form-control" minlength="8" maxlength="16" name="senha" id="senha" placeholder="Senha">
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Confirmar Senha*</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            <input type="password" class="form-control" minlength="8" maxlength="16" name="confirmarsenha" id="senha"
                                placeholder="Senha">
                        </div>
                    </div>
                </div>
                <div class="ligacoes">
                    <div class="acessos">
                        <a style="text-decoration: none;" href="recuperarsenha.php">Esqueceu sua senha?</a>
                        <div id="btnMostrarSenha" style="display: flex; justify-content: space-between;">
                            <i style="color: rgb(254,220,40);" class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <center style="margin-top: 4%"><input style="width: 20%;" type="submit" name="submit" class="btn"
                        value="Login"></center>
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
        var senhaInput = document.querySelectorAll('input[type="password"]');

        btnMostrarSenha.addEventListener("click", function () {
            senhaInput.forEach(function (inputSenha) {
                if (inputSenha.type === "password") {
                    inputSenha.type = "text";
                    btnMostrarSenha.innerHTML = '<i style="color: #d9d9d9;" class="fa fa-eye-slash" aria-hidden="true"></i>';
                } else {
                    inputSenha.type = "password";
                    btnMostrarSenha.innerHTML = '<i style="color: #d9d9d9;" class="fa fa-eye" aria-hidden="true"></i>';
                }
            });
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