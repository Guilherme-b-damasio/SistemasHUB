<?php
// Inicia a sessão
session_start();

// Verifica se existe uma sessão e a destrói
if (isset($_SESSION)) {
    session_unset(); // Remove todas as variáveis de sessão
    session_destroy(); // Destrói a sessão
} ?>  

<html lang="pt-br">
<head>
               
    <title>Login - HUB</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css"> 
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
            <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-chrome-192x192.png">
            <link rel="icon" type="image/png" sizes="512x512" href="favicon/android-chrome-512x512.png">
            <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
            <link rel="manifest" href="favicon/site.webmanifest">
            <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
            <meta name="msapplication-TileColor" content="#da532c">
            <meta name="theme-color" content="#ffffff">
            <meta name='robots' content='noindex, nofollow'/>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <div class="container">
        <div class="container-login">
            <div class="wrap-login">
                <!-- Início do Código PHP para sessão e conexão -->
                

                <!-- Formulário de login com ação apontando para 'DB/login/loginDB.php' -->
                <form class="login-form" id="systemLogin" method="POST" action="DB/loginDB.php">
                    <span class="login-form-title">
                        Faça login
                    </span>

                    <div class="wrap-input margin-top-35 margin-bottom-35">
                        <input class="input-form" type="login" name="txtEmailLogin" id="loginEmail" autocomplete="off" required autofocus>
                        <span class="focus-input-form" data-placeholder="Login"></span>
                    </div>

                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="password" name="txtSenhaLogin" id="loginSenha" required>
                        <span class="focus-input-form" data-placeholder="Senha"></span>
                    </div>

                    <div class="checkbox mb-3">
                        <label class="form-cadastro">
                            <a href="layout\cadastro.php">Cadastro</a>
                        </label>
                    </div>

                    <div class="container-login-form-btn">
                        <button class="login-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                </form>
            </div>
                <div class="imgLogg">
                    <img src="assets/login.webp" width="370" height="370" class="margin-left-50" />
                </div>
        </div>
    </div>

    <!-- Scripts para interação dos inputs e funcionalidades adicionais -->
    <script>
        let inputs = document.getElementsByClassName('input-form');
        for (let input of inputs) {
            input.addEventListener("blur", function() {
                if(input.value.trim() != ""){
                    input.classList.add("has-val");
                } else {
                    input.classList.remove("has-val");
                }
            });
        }
    </script>
</body>
</html>
