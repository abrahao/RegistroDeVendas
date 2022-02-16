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

$sql1 = "CREATE TABLE IF NOT EXISTS empresa (
    id_emp INT AUTO_INCREMENT PRIMARY KEY,
    data_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome_emp VARCHAR(50) NOT NULL
    ) ENGINE=INNODB";

$sql2 = "CREATE TABLE IF NOT EXISTS vendedor (
    id_vendd INT AUTO_INCREMENT PRIMARY KEY,
    data_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome_vendd VARCHAR(30) NOT NULL
) ENGINE=INNODB";

$sql3 = "CREATE TABLE IF NOT EXISTS questionario (
    id_quest INT AUTO_INCREMENT PRIMARY KEY,
    data_cad timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    vendedor VARCHAR(30) NOT NULL,
    prodt_vend VARCHAR(50) NOT NULL,
    quest_1 VARCHAR(100) NOT NULL,
    quest_2 VARCHAR(10) NOT NULL,
    quest_3 VARCHAR(10) NOT NULL,
    quest_4 VARCHAR(10) NOT NULL,
    quest_5 VARCHAR(10) NOT NULL,
    quest_6 VARCHAR(500) NOT NULL,
    quest_7 VARCHAR(500) NOT NULL,
    id_emp INT,
    CONSTRAINT fk_emp FOREIGN KEY (id_emp) REFERENCES empresa(id_emp)
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
    echo "Erro: " . ($conexao1->error . $conexao2->error . $conexao3->error );
}

$conexao1->close();
$conexao2->close();
$conexao3->close();