<?php
// Verifica se o ID do projeto foi recebido via método GET
if (isset($_GET['id'])) {
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Insira seu usuário do banco de dados aqui
    $password = ""; // Insira sua senha do banco de dados aqui
    $dbname = "SistemaDeGerenciamento"; // Insira o nome do seu banco de dados aqui

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém o ID do projeto
    $projectId = $_GET['id'];

    // Prepara e executa a consulta SQL para excluir o projeto
    $sql = "DELETE FROM Projeto WHERE ID_Projeto = $projectId";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("success" => true));
    } else {
        // Retorna uma resposta JSON de erro
        echo json_encode(array("success" => false, "message" => "Erro ao excluir projeto: " . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o ID do projeto não foi fornecido, retorna um erro
    echo json_encode(array("success" => false, "message" => "ID do projeto não fornecido"));
}
?>
