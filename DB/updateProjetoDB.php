<?php
include("../conexao/conexao.php"); // Inclui a conexão com o banco de dados

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projetoId'])) {
    $projetoId = $_POST['projetoId'];
    $nomeProjeto = $_POST['nomeProjeto'];
    $linkProjeto = $_POST['linkProjeto'] ?? null; // Usa null como padrão se não for fornecido

    // Inicializa as variáveis $imagem e $imgModal com null
    $imagem = $imgModal = null;

    // Verifica se um arquivo de imagem do projeto foi enviado
    if (isset($_FILES['imgProjeto']) && $_FILES['imgProjeto']['error'] == 0) {
        $imagem = file_get_contents($_FILES['imgProjeto']['tmp_name']); // Lê o arquivo da imagem do projeto
    }

    // Verifica se um arquivo de imagem do modal foi enviado
    if (isset($_FILES['imgModal']) && $_FILES['imgModal']['error'] == 0) {
        $imgModal = file_get_contents($_FILES['imgModal']['tmp_name']); // Lê o arquivo da imagem do modal
    }

    // Prepara a consulta SQL para atualizar os dados, incluindo as imagens, se fornecidas
    $sql = "UPDATE projetos SET nome = :nome, link = :link" . 
           ($imagem ? ", imagem = :imagem" : "") . 
           ($imgModal ? ", imgModal = :imgModal" : "") . 
           " WHERE id = :id";
    $stmt = $conexao->prepare($sql);

    // Vincula os parâmetros necessários
    $stmt->bindParam(':nome', $nomeProjeto);
    $stmt->bindParam(':link', $linkProjeto);
    $stmt->bindParam(':id', $projetoId);
    if ($imagem) {
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
    }
    if ($imgModal) {
        $stmt->bindParam(':imgModal', $imgModal, PDO::PARAM_LOB);
    }

    // Executa a consulta
    $stmt->execute();

    // Redireciona após a atualização
    header("Location: ../admin.php");
    exit;
} else {
    // Redireciona se o método não for POST ou se o ID do projeto não for fornecido
    header("Location: ../error.php"); // Ajuste para a página de erro ou formulário apropriado
    exit;
}
?>
