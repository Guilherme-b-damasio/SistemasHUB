<?php
session_start();
include("../conexao/conexao.php"); // Inclui a conexão com o banco de dados
include("../seguranca/seguranca.php");

if (!administrador_logado()) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['projetoId'])) {
    $projetoId = $_POST['projetoId'];

    // Prepare a declaração para evitar SQL injection
    $stmt = $conexao->prepare("DELETE FROM projetos WHERE id = ?");
    $stmt->execute([$projetoId]);

    if ($stmt->rowCount()) {
        echo "<script>alert('Projeto excluído com sucesso.');window.location.href='../catalogo.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o projeto.');window.location.href='../editarProjeto.php?id=" . $projetoId . "';</script>";
    }
} else {
    header('Location: ../catalogo.php');
}
?>
