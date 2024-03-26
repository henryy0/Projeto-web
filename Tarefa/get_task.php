<?php
// Verifica se o parâmetro 'id' foi enviado via GET
if (!isset($_GET['id'])) {
    // Se não foi enviado, retorna uma mensagem de erro
    http_response_code(400); // Bad Request
    echo json_encode(array("success" => false, "message" => "ID da tarefa não especificado."));
    exit();
}

// Captura o ID da tarefa enviado via GET
$task_id = $_GET['id'];

// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Seu nome de usuário do banco de dados
$password = ""; // Sua senha do banco de dados
$dbname = "SistemaDeGerenciamento"; // Nome do seu banco de dados

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    // Retorna uma resposta JSON de erro se a conexão falhar
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "Conexão falhou: " . $conn->connect_error));
    exit();
}

// Prepara e executa a consulta SQL para obter os detalhes da tarefa com base no ID, incluindo dados do projeto e do usuário
$sql = "SELECT Tarefa.*, Projeto.Nome_Projeto, Usuario.nome_usuario 
        FROM Tarefa
        LEFT JOIN Projeto ON Tarefa.Projeto_tarefa = Projeto.ID_Projeto
        LEFT JOIN Usuario ON Tarefa.Responsavel_tarefa = Usuario.id_usuario
        WHERE ID_tarefa = $task_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retorna os detalhes da tarefa, projeto e usuário como JSON se encontrado
    $task = $result->fetch_assoc();
    echo json_encode($task);
} else {
    // Se a tarefa não for encontrada, retorna uma mensagem de erro
    http_response_code(404); // Not Found
    echo json_encode(array("success" => false, "message" => "Tarefa não encontrada."));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
