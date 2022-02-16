<?php

function novaConexao($banco = 'meuBanco') {
    $servidor = '127.0.0.1:3307';
    $usuario = 'root';
    $senha = '';

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if($conexao->connect_error) {
        die('Erro: ' . $conexao->connect_error);
    }

    return $conexao;
}