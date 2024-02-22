<?php 
session_start();
include("seguranca/seguranca.php"); 

if (!administrador_logado()) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
        <html>
        <head>
            <title>Catalogo de Sistemas</title>
            <link rel="stylesheet" href="css/catalogo.css">
            <link rel="stylesheet" href="css/modal.css">
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
                        <span class="hidden"><a href="catalogo.php">Sistemas</a></span>
                        <span class="hidden"><a href="cadastroProj.php">Cadastrar</a></span>
                        <span class="hidden"><a href="editarProjs.php">Editar</a></span>
                        <span class="hidden"><a href="login.php">Sair</a></span>
                    </div>
                </div>
              
            </header>
        
            <!-- Contêiner para o Widget de Previsão do Tempo -->
            <div class="weather-widget-container">
                <!--Joinville Clima-->
                <a class="weatherwidget-io" href="https://forecast7.com/pt/n26d30n48d85/joinville/" data-label_1="JOINVILLE" data-label_2="Clima" data-icons="Climacons Animated" data-mode="Current" data-theme="pure" data-basecolor="" >JOINVILLE Clima</a>
                <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                </script>
        
                <!--Barra Velha Clima-->
                <a class="weatherwidget-io" href="https://forecast7.com/pt/n26d63n48d68/barra-velha/" data-label_1="BARRA VELHA" data-label_2="Clima" data-icons="Climacons Animated" data-mode="Current" data-theme="pure" data-basecolor="" >BARRA VELHA Clima</a>
                <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                </script>
        
                <!--São Francisco Clima-->
                <a class="weatherwidget-io" href="https://forecast7.com/pt/n26d25n48d62/sao-francisco-do-sul/" data-label_1="SÃO FRANCISCO DO SUL" data-label_2="Clima" data-icons="Climacons Animated" data-mode="Current" data-theme="pure" data-basecolor="" >SÃO FRANCISCO DO SUL CLIMA</a>
                <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                </script>
                
            </div>
            
    <?php include("DB/catalogoDB.php"); ?>

    <?php foreach ($projetos as $projeto): ?>
        <div class="itens <?= empty($projeto['link']) ? 'open-modal' : '' ?>"
            data-image="<?= empty($projeto['link']) && !empty($projeto['imgModal_base64']) ? 'data:image/jpeg;base64,'.$projeto['imgModal_base64'] : 'data:image/jpeg;base64,'.$projeto['imagem_base64']; ?>">
            <?php if (!empty($projeto['link'])): ?>
                <a href="<?= htmlspecialchars($projeto['link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                    <img class="poster" src="data:image/jpeg;base64,<?= $projeto['imagem_base64']; ?>" alt="<?= htmlspecialchars($projeto['nome'], ENT_QUOTES, 'UTF-8'); ?>">
                </a>
            <?php else: ?>
                <img class="poster" src="data:image/jpeg;base64,<?= $projeto['imagem_base64']; ?>" alt="<?= htmlspecialchars($projeto['nome'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php endif; ?>
            <h2><?= htmlspecialchars($projeto['nome'], ENT_QUOTES, 'UTF-8'); ?></h2>
        </div>
    <?php endforeach; ?>



    <!-- Modal para exibir a imagem -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="closeModal">&times;</span>
                <img id="modalImg" src="" alt="Imagem do Projeto" style="width: 100%;">
            </div>
        </div>



            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="catalogo.js"></script>
            <script src="iframeClima.js"></script>
        
            
        </body>
        </html>
        
    </header>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
            //Função para abrir o modal com a imagem correta
        function openModal(imageSrc) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("modalImg");
            
            if (modal && modalImg) {
                modal.style.display = "block";
                modalImg.src = imageSrc;
            }
        }

        // Configura o evento de clique para cada item do catálogo
        document.querySelectorAll('.itens').forEach(item => {
            item.addEventListener('click', function(e) {
                // Checa se o projeto tem um link definido
                var link = this.querySelector('a');

                // Se não tiver link, ou seja, deve abrir o modal
                if (!link || link.getAttribute('href') === 'javascript:void(0);') {
                    e.preventDefault(); // Prevenir ação padrão do navegador
                    var imageSrc = this.getAttribute('data-image');
                    openModal(imageSrc);
                }
            });
        });

        // Configuração para fechar o modal
        var span = document.querySelector('.closeModal'); 
        if (span) {
            span.onclick = function() {
                var modal = document.getElementById("myModal");
                if (modal) {
                    modal.style.display = "none";
                }
            }
        }

        // Fecha o modal ao clicar fora dele
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
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
