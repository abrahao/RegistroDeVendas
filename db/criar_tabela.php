<?php
session_start();

if ($_COOKIE['user']) {
  $_SESSION['user'] = $_COOKIE['user'];
}

if (!$_SESSION['user']) {
  header('Location: login.php');
}
?>
<div class="titulo">Criar Tabela</div>

<?php

require_once "./conexao.php";

$sql1 = "CREATE TABLE IF NOT EXISTS produto (
    idProduto INT AUTO_INCREMENT PRIMARY KEY,
    nomeProduto VARCHAR(50) NOT NULL,
    precoProduto FLOAT() NOT NULL
) ENGINE=INNODB";

$sql2 = "CREATE TABLE IF NOT EXISTS cliente (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    nomeCli VARCHAR(50) NOT NULL,
    cpfCli VARCHAR(30) NOT NULL,
    emailCli VARCHAR(100) NOT NULL,
    dataNasCli VARCHAR(10) NOT NULL,
    enderecoCli VARCHAR(100) NOT NULL,
    bairroCli VARCHAR(100) NOT NULL,
    cidadeCli VARCHAR(80) NOT NULL
) ENGINE=INNODB";

$sql3 = "CREATE TABLE IF NOT EXISTS pedidoVenda (
    idPedido INT AUTO_INCREMENT PRIMARY KEY,
    data_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idProduto INT,
    idCliente INT,
    CONSTRAINT fk_prod FOREIGN KEY (idProduto) REFERENCES produto (idProduto),
    CONSTRAINT fk_cli FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
    ) ENGINE=INNODB";

$conexao1 = novaConexao();
$conexao2 = novaConexao();
$conexao3 = novaConexao();
$resultado1 = $conexao1->query($sql1);
$resultado2 = $conexao2->query($sql2);
$resultado3 = $conexao3->query($sql3);

if ($resultado1 && $resultado2 && $resultado3) {
    echo "Tabelas criada!";
} else {
    echo "Erro: " . ($conexao1->error . $conexao2->error . $conexao3->error);
}

$conexao1->close();
$conexao2->close();
$conexao3->close();