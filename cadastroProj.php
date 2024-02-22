<?php 
session_start();
include("seguranca/seguranca.php"); 

if (!administrador_logado()) {
    header("Location: login.php");
    exit;
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css"> 
    <link rel="stylesheet" type="text/css" href="css/cadProj.css">
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

    <title>Cadastro de Projetos</title>
</head>
<body>


    <header>
                <nav class="navbar">
                    <!-- Seção Esquerda: Relógio -->
                    <div class="navbar-left">
                        <time>12:00:00</time>
                    </div>
                    
                    <!-- Seção Central: Logo -->
                    <div class="navbar-center">
                        <a href="">
                            <img src="assets/logo.png" alt="Logo" class="logo">
                        </a>
                    </div>
        
                    <!-- Seção Direita: Outros Itens (exemplo com o menu) -->
                    <div class="navbar-right">
                        <div class="menu">
                            <div class="container">
                                <div class="toggle"></div>
                                <!-- Links ou outros elementos -->
                            </div>
                        </div>
                    </div>
                </nav>
        
        
                <div class="menu">
                    <div class="container">
                        <div class="toggle"></div>
                        <span class="hidden"><a href="admin.php">Sistemas</a></span>
                        <span class="hidden"><a href="admin.php">Admin</a></span>
                    </div>
                </div>
              
            </header>

    <div class="containerDG">
        <div class="container-login">
            <div class="wrap-login">
                <!-- Certifique-se de incluir 'enctype="multipart/form-data"' para o envio de arquivos -->
                <form class="login-form" method="POST" action="DB/projetoDB.php" enctype="multipart/form-data"> 
                    <span class="login-form-title margin-bottom-35">Cadastro de Projetos</span>

                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="text" name="nomeProjeto" required autofocus>
                        <span class="focus-input-form" data-placeholder="Nome do Projeto"></span>
                    </div>

                    <div class="wrap-input margin-bottom-35">
                        <!-- Campo de envio de arquivo para a imagem do projeto -->
                        <input class="input-form" type="file" name="imgProjeto" accept="image/*" required>
                        <span class="focus-input-form" data-placeholder=""></span>
                    </div>

                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="text" name="linkProjeto">
                        <span class="focus-input-form" data-placeholder="Link do Projeto"></span>
                    </div>

                    <div class="container-login-form-btn">
                        <button class="login-form-btn" type="submit">Cadastrar Projeto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Scripts para interação dos inputs e funcionalidades adicionais -->
    <script>
            // menu interativo
            $(document).ready(function() {
                $('.toggle').on('click', function() {
                    $('.menu').toggleClass('expanded');
                    $('span').toggleClass('hidden');
                    $('.container, .toggle').toggleClass('close');
                });
            });


            const showTimeNow = () =>{
            //Selecinando a tag de destino
            const clockTag = document.querySelector('time');
            
            //Instanciando a classe Date
            let dateNow = new Date();
            //pegando os valores desejados
            let hh = dateNow.getHours();
            let mm = dateNow.getMinutes();
            let ss = dateNow.getSeconds();
            
            //validando a necessidade de adicionar zero na exibição
            hh = hh < 10 ? '0'+ hh : hh; 
            mm = mm < 10 ? '0'+ mm : mm; 
            ss = ss < 10 ? '0'+ ss : ss; 
            
            // atribuindo os valores e montando o formato da hora a ser exibido
            clockTag.innerText = hh +':'+ mm +':'+ ss;
            }
            //executando a funcao a cada 1 segundo
            showTimeNow()
            setInterval(showTimeNow, 1000);
    </script>

</body>
</html>
