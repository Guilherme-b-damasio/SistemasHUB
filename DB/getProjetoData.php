<?php
include("conexao/conexao.php"); // Inclui a conexão com o banco de dados

// Supondo que você tenha um identificador para o projeto (como um ID na URL)
$projetoIdSanitized = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$projetoId = filter_var($projetoIdSanitized, FILTER_VALIDATE_INT);

if ($projetoId === false) {
    die('ID do projeto inválido.');
}

$sql = "SELECT nome, imagem, link, id, imgModal FROM projetos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->execute(['id' => $projetoId]);

$projeto = $stmt->fetch(PDO::FETCH_ASSOC);



if ($projeto) {
    // Se a imagem não estiver vazia, codifique-a em base64 para exibição

    if (!empty($projeto['imagem'])) {
        // Obtém informações da imagem
        $infoImagem = getimagesizefromstring($projeto['imagem']);
        
        if ($infoImagem !== false) {
            // Extrai o tipo MIME
            $tipoImagem = $infoImagem['mime'];
            
            // Prepara a string base64 com o tipo correto
            $projeto['imagem_base64'] = 'data:' . $tipoImagem . ';base64,' . base64_encode($projeto['imagem']);
        } else {
            $projeto['imagem_base64'] = null;
            // Tratar erro: os dados da imagem não puderam ser processados
        }
    } else {
        $projeto['imagem_base64'] = null;
    }

    // Codifica a imagem do modal do projeto em base64 para exibição, se existir
    if (!empty($projeto['imgModal'])) {
        // Obtém informações da imagem
        $infoImagem = getimagesizefromstring($projeto['imgModal']);
        
        if ($infoImagem !== false) {
            // Extrai o tipo MIME
            $tipoImagem = $infoImagem['mime'];
            
            // Prepara a string base64 com o tipo correto
            $projeto['imgModal_base64'] = 'data:' . $tipoImagem . ';base64,' . base64_encode($projeto['imgModal']);
        } else {
            $projeto['imgModal_base64'] = null;
            // Tratar erro: os dados da imagem não puderam ser processados
        }
    } else {
        $projeto['imgModal_base64'] = null;
    }
    

} else {
    echo "Projeto não encontrado.";
}


?>
