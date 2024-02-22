<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "sistemashub";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro durante a conexão com o banco de dados.\n\n".$e->getMessage();
}
