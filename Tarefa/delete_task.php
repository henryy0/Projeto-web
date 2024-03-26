<?php
// Verifica se o método de requisição é DELETE
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "SistemaDeGerenciamento"; // Nome do seu banco de dados

    // Obtém o ID da tarefa a ser excluída
    $id = $_GET['id'];

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara e executa a consulta SQL para excluir a tarefa
    $sql = "DELETE FROM Tarefa WHERE ID_tarefa=$id";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("success" => true));
    } else {
        // Retorna uma resposta JSON de erro com a mensagem de erro
        echo json_encode(array("success" => false, "message" => "Erro ao excluir tarefa: " . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Retorna uma resposta JSON de erro se o método de requisição não for DELETE
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>
