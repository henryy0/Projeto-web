<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "SistemaDeGerenciamento"; // Nome do seu banco de dados

    // Obtém os dados do formulário
    $projeto = $_POST['project'];
    $nome = $_POST['taskName'];
    $data_inicio = $_POST['taskStartDate'];
    $data_fim = $_POST['taskEndDate'];
    $obs = $_POST['taskDescription'];
    $status = $_POST['taskStatus'];
    $responsavel = $_POST['responsible'];

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        // Retorna uma resposta JSON de erro
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Conexão falhou: " . $conn->connect_error));
        exit();
    }

    // Prepara e executa a consulta SQL para adicionar a tarefa
    $sql = "INSERT INTO Tarefa (Projeto_tarefa, Nome_tarefa, Data_inicio_Tarefa, Data_Fim_Tarefa, Obs_tarefa, Status_tarefa, Responsavel_tarefa)
            VALUES ('$projeto', '$nome', '$data_inicio', '$data_fim', '$obs', '$status', '$responsavel')";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("success" => true));
    } else {
        // Retorna uma resposta JSON de erro com o código de status 500 (Erro interno do servidor)
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Erro ao adicionar tarefa: " . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Retorna uma resposta JSON de erro se o método de requisição não for POST
    http_response_code(400);
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>
