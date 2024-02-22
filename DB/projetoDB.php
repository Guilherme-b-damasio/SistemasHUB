<?php
include("../conexao/conexao.php"); // Caminho correto para a conexão com o banco de dados
include("../seguranca/seguranca.php"); // Caminho correto para o script de segurança, se necessário

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeProjeto = $_POST['nomeProjeto'];
    $linkProjeto = $_POST['linkProjeto'] ?? ''; // Usa operador de coalescência nula para lidar com ausência de link

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    // Processa o upload da imagem do projeto
    if (isset($_FILES["imgProjeto"]) && $_FILES["imgProjeto"]["error"] == 0) {
        $fileTypeProjeto = pathinfo($_FILES["imgProjeto"]["name"], PATHINFO_EXTENSION);
        
        if (in_array($fileTypeProjeto, $allowTypes)) {
            $imgContentProjeto = file_get_contents($_FILES['imgProjeto']['tmp_name']);
        } else {
            echo "Erro: Formato de arquivo do projeto não permitido.";
            exit;
        }
    } else {
        echo "Erro: Falha ao fazer upload do arquivo do projeto.";
        exit;
    }

    // Processa o upload da imagem do modal, se existir
    $imgContentModal = null; // Inicializa como null para casos onde a imagem do modal não é enviada
    if (isset($_FILES["imgModal"]) && $_FILES["imgModal"]["error"] == 0) {
        $fileTypeModal = pathinfo($_FILES["imgModal"]["name"], PATHINFO_EXTENSION);
        
        if (in_array($fileTypeModal, $allowTypes)) {
            $imgContentModal = file_get_contents($_FILES['imgModal']['tmp_name']);
        } else {
            echo "Erro: Formato de arquivo do modal não permitido.";
            exit;
        }
    }

    // Prepara a consulta SQL para inserção dos dados, incluindo as imagens
    $sql = "INSERT INTO projetos (nome, imagem, link, imgModal) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $nomeProjeto);
    $stmt->bindParam(2, $imgContentProjeto, PDO::PARAM_LOB); // Imagem do projeto
    $stmt->bindParam(3, $linkProjeto);
    $stmt->bindParam(4, $imgContentModal, PDO::PARAM_LOB); // Imagem do modal

    // Executa a consulta e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        header("Location: ../admin.php"); // Redireciona para a página de administração em caso de sucesso
    } else {
        echo "Erro ao cadastrar o projeto.";
    }
}
?>
