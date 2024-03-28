<?php
// Verifica se o método de requisição é GET e se o ID da tarefa foi fornecido
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "SistemaDeGerenciamento"; // Nome do seu banco de dados

    // Obtém o ID da tarefa da URL
    $id = $_GET['id'];

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        // Retorna uma resposta JSON de erro se a conexão falhar
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Conexão falhou: " . $conn->connect_error));
        exit();
    }

    // Prepara e executa a consulta SQL para selecionar os detalhes da tarefa com base no ID
    $sql = "SELECT * FROM Tarefa WHERE ID_tarefa = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Retorna os detalhes da tarefa como JSON
        $task_data = $result->fetch_assoc();
        echo json_encode(array("success" => true, "task" => $task_data));
    } else {
        // Retorna uma mensagem de erro se a tarefa não for encontrada
        echo json_encode(array("success" => false, "message" => "Tarefa não encontrada"));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Retorna uma resposta JSON de erro se o método de requisição não for GET ou se o ID da tarefa não foi fornecido
    echo json_encode(array("success" => false, "message" => "ID da tarefa não especificado ou método de requisição inválido"));
}

?>
