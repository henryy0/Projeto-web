<?php
    // Informações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Insira seu usuário do banco de dados aqui
    $password = ""; // Insira sua senha do banco de dados aqui
    $dbname = "SistemaDeGerenciamento"; // Insira o nome do seu banco de dados aqui

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
?>
