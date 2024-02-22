<?php
include("conexao/conexao.php"); // Caminho para a conexão com o banco de dados

// Consulta SQL para selecionar os campos necessários da tabela de projetos
$sql = "SELECT nome, imagem, link, imgModal, id FROM projetos ORDER BY ordem ASC";

$stmt = $conexao->query($sql);

$projetos = [];

// Verifica se a consulta retornou linhas
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Processa a imagem do projeto
        if (!empty($row['imagem'])) {
            $row['imagem_base64'] = base64_encode($row['imagem']);
        } else {
            // Define um valor padrão ou mantém nulo/omitido
            $row['imagem_base64'] = null;
        }

        // Processa a imagem do modal, se existir
        if (!empty($row['imgModal'])) {
            $row['imgModal_base64'] = base64_encode($row['imgModal']);
        } else {
            // Define um valor padrão ou mantém nulo/omitido
            $row['imgModal_base64'] = null;
        }

        // Remove as colunas de imagem originais para reduzir o tamanho do payload
        unset($row['imagem'], $row['imgModal']);

        // Adiciona o projeto processado ao array de projetos
        $projetos[] = $row;
    }
} else {
    // Mensagem opcional caso não haja projetos
    echo "Nenhum projeto encontrado.";
}

// Agora, $projetos contém todos os projetos com suas imagens em base64 e sem as colunas de imagem originais
?>
