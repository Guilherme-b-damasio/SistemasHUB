<?php
include("conexao/conexao.php");

if (isset($_POST['ordem']) && is_array($_POST['ordem'])) {
    $novaOrdem = $_POST['ordem'];
    foreach ($novaOrdem as $posicao => $idProjeto) {
        // Atualize a ordem no banco de dados
        $sql = "UPDATE projetos SET ordem = :ordem WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        if(!$stmt->execute(['ordem' => $posicao + 1, 'id' => $idProjeto])) {
            // Log erro
            error_log("Erro ao atualizar ordem do projeto ID $idProjeto");
        }
    }
    echo "Ordem atualizada com sucesso!";
} else {
    // Log erro ou envie uma mensagem de erro apropriada
    echo "Erro ao receber os dados de ordem.";
}

?>
