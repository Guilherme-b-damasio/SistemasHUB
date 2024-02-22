<?php 
session_start();
include("seguranca/seguranca.php"); 

if (!administrador_logado()) {
    header("Location: login.php");
    exit;
}
?>
<html>

<head>
    <title>Catalogo de Sistemas</title>
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/favicon/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name='robots' content='noindex, nofollow'/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                                <span class="hidden"><a href="admin.php">Sistemas</a></span>
                                <span class="hidden"><a href="login.php">Sair</a></span>
                            </div>
                        </div>
                    </div>
                </nav>
        
        
    </header>
    
    <div class="loading-overlay"></div>

    <?php include("DB/catalogoDB.php"); ?>
    <ul id="sortable">
        <?php foreach ($projetos as $projeto): ?>
            <li class="ui-state-default itens" data-id="<?php echo $projeto['id']; ?>">
                <a href="editar.php?id=<?php echo htmlspecialchars($projeto['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img class="poster" src="data:image/jpeg;base64,<?php echo htmlspecialchars($projeto['imagem_base64'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($projeto['nome'], ENT_QUOTES, 'UTF-8'); ?>">
                </a>
                <h2><?php echo htmlspecialchars($projeto['nome'], ENT_QUOTES, 'UTF-8'); ?></h2>
            </li>
        <?php endforeach; ?>
    </ul>   


  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>

    <style>
        .loading {
            background-image: url('assets/loading.gif');
            background-repeat: no-repeat;
            background-position: center;
            opacity: 1; 
        }

        .loading-overlay {
                position: fixed; /* Fixo na viewport */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.7); /* Fundo levemente transparente */
                background-image: url('assets/loading.gif');
                background-repeat: no-repeat;
                background-position: center center;
                background-size: 100px; /* Tamanho do GIF de carregamento */
                z-index: 9999; /* Garante que o overlay esteja acima de outros elementos */
                display: none; /* Oculto por padrão */
        }

            #sortable {
            ' list-style-type: none;
                margin: 0;
                padding: 0;
                width: 80%; /* Aumento da largura para facilitar o arrasto */
                margin: auto; /* Centraliza a lista na página */
            }

            #sortable li {
                margin: 10px 2%; /* Aumento da margem para melhor separação */
                padding: 5px; /* Aumento do padding para melhor estética */
                font-size: 1em; /* Ajuste do tamanho da fonte para melhor legibilidade */
                border: none;
                background-color: none; /* Cor de fundo mais suave */
                cursor: pointer; /* Cursor indica um elemento interativo */
                border-radius: 4px; /* Bordas arredondadas para estética moderna */
            }

            #sortable li.itens:hover {
                background-color: #eaeaea; /* Efeito hover para feedback visual */
            }'

            #sortable li img.poster {
                width: 100%; /* Aumenta a largura da imagem */
                height: 100%; /* Aumenta a altura da imagem */
                object-fit: cover; /* Garante que a imagem cubra o espaço sem distorcer */
                border-radius: 8px; /* Adiciona bordas arredondadas à imagem */
         
            }

    </style>

    

    <script>
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var novaOrdem = $(this).sortable('toArray', {attribute: 'data-id'});
                    $.ajax({
                        url: 'atualizarOrdem.php',
                        method: 'POST',
                        data: {
                            ordem: novaOrdem
                        },
                        beforeSend: function() {
                        // Adiciona a classe 'loading' ao elemento antes de enviar a requisição
                            $('.loading-overlay').show(); // Mostra o overlay de carregamento
                        },
                        complete: function() {
                            setTimeout(function() {
                                $('.loading-overlay').hide();
                            }, 400); // Ajuste o tempo (2000 ms = 2 segundos) conforme necessário
                        },
                        success: function(response) {
                            console.log("Ordem atualizada: ", response);
                 
                        },
                        error: function(xhr, status, error) {
                            console.error("Erro ao atualizar ordem: ", error);
                        }
                        });
                }
            });
            $("#sortable").disableSelection();
        });

    </script>
    
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(function(OneSignal) {
        OneSignal.init({
            appId: "64d0ab10-a576-486f-ba38-7ceb56cf160e",
         });
     });
    </script> 

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
