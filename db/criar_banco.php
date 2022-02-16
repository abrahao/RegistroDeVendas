<?php
session_start();

if ($_COOKIE['user']) {
  $_SESSION['user'] = $_COOKIE['user'];
}

if (!$_SESSION['user']) {
  header('Location: login.php');
}
?>
<div class="titulo">Criar Banco</div>

<?php

require_once "conexao.php";

$conexao = novaConexao(null);
$sql = 'CREATE DATABASE IF NOT EXISTS meuBanco';

$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();