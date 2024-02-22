<?php

session_start(); //iniciando um sessão

include("../seguranca/seguranca.php");
require_once("../conexao/conexao.php");

$teste_SenhaLogin = campo_e_valido("txtSenhaLogin", "Senha");
$teste_EmailLogin = campo_e_valido("txtEmailLogin", "Email");

if ($teste_SenhaLogin[0] == false) { exit; }
if ($teste_EmailLogin[0] == false) { exit; }

$txtSenhaLogin = $teste_SenhaLogin[1];
$txtEmailLogin = $teste_EmailLogin[1];

try {
    $comandoSQL = "SELECT * FROM usuarios WHERE login = \"$txtEmailLogin\" AND senha = \"$txtSenhaLogin\"";
    $select = $conexao->query($comandoSQL);
    $resultado = $select->fetchAll();

   if($resultado) {
        $_SESSION["txtLOGIN"] = true;
        $_SESSION["txtSENHA"] = true;
        header('Location: ../admin.php');

    } else {
           header('Location: ../login.php');
        }
    }

catch (PDOException $e) {
    echo("Erro ao gravar informação no banco de dados. \n\n".$e->getMessage());
}

$conexao = null;
