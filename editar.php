<?php
// Inclui o script que carrega os dados do projeto do banco de dados
include("DB/getProjetoData.php");

session_start();
include("seguranca/seguranca.php"); 

if (!administrador_logado()) {
    header("Location: login.php");
    exit;
}

if (!isset($projeto)) {
    // Redirecionar para a página de catálogo ou mostrar uma mensagem de erro
    header('Location: catalogo.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cadProj.css">
    <title>Editar Projeto</title>
    <script>
        function confirmarExclusao() {
            if (!confirm("Tem certeza de que deseja excluir este projeto?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="containerDG">
        <div class="container-login">
            <div class="wrap-login">
                <!-- Formulário para edição de projeto -->
                <form class="login-form" method="POST" action="DB/updateProjetoDB.php" enctype="multipart/form-data"> 
                    <span class="login-form-title margin-bottom-35">Editar Projeto</span>
                    
                    <input type="hidden" name="projetoId" value="<?= htmlspecialchars($projeto['id'] ?? ''); ?>">

                    <!-- Nome do Projeto -->
                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="text" name="nomeProjeto" value="<?= htmlspecialchars($projeto['nome'] ?? ''); ?>" required autofocus>
                        <span class="focus-input-form" data-placeholder="Nome do Projeto"></span>
                    </div>

                    <!-- Exibição da Imagem Atual do Projeto -->
                    <div class="wrap-input margin-bottom-35">
                        <label>Imagem de Logo do Projeto:</label>
                        <br>
                        <?php if (!empty($projeto['imagem_base64'])): ?>
                            <img src="<?= $projeto['imagem_base64']; ?>" alt="Imagem do Projeto" style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            <p>Nenhuma imagem disponível.</p>
                        <?php endif; ?>
                        <input class="input-form" type="file" name="imgProjeto" accept="image/*">
                    </div>

                    <!-- Campo para upload da imagem de modal, se houver -->
                    <div class="wrap-input margin-bottom-35">
                        <label>Imagem do Modal do Projeto:</label>
                        <br>
                        <?php if (!empty($projeto['imgModal_base64'])): ?>
                            <img src="<?= $projeto['imgModal_base64']; ?>" alt="Imagem de Modal" style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            <p>Nenhuma imagem de modal disponível.</p>
                        <?php endif; ?>
                        <input class="input-form" type="file" name="imgModal" accept="image/*">
                    </div>


                    <!-- Link do Projeto -->
                    <div class="wrap-input margin-bottom-35">
                        <input class="input-form" type="text" name="linkProjeto" placeholder="Url" value="<?= htmlspecialchars($projeto['link'] ?? ''); ?>">
                        <span class="focus-input-form" placeholder="Link do Projeto"></span>
                    </div>

                    <!-- Botão de Submissão -->
                    <div class="container-login-form-btn">
                        <button class="login-form-btn" type="submit">Atualizar Projeto</button>
                    </div>
                </form>

                <!-- Formulário para exclusão de projeto -->
                <form class="login-form" method="POST" action="DB/deleteBD.php" onsubmit="confirmarExclusao()">
                    <input type="hidden" name="projetoId" value="<?= htmlspecialchars($projeto['id'] ?? ''); ?>">
                    <button class="login-form-btn" type="submit">Excluir Projeto</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
