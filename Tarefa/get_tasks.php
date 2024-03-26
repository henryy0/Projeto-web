<?php
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

// Prepara e executa a consulta SQL para recuperar as tarefas
$sql = "SELECT Tarefa.ID_tarefa, 
               Tarefa.Nome_tarefa, 
               Tarefa.Status_tarefa, 
               Projeto.Nome_Projeto, 
               Usuario.nome_usuario,
               Tarefa.Data_inicio_Tarefa, 
               Tarefa.Data_Fim_Tarefa,
               Tarefa.obs_tarefa, 
               Tarefa.Responsavel_tarefa
        FROM Tarefa
        INNER JOIN Projeto ON Tarefa.Projeto_tarefa = Projeto.ID_Projeto
        INNER JOIN Usuario ON Tarefa.Responsavel_tarefa = Usuario.id_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tasks = array();
    while ($row = $result->fetch_assoc()) {
        // Adiciona cada linha do resultado ao array de tarefas
        $tasks[] = $row;
    }
    // Retorna as tarefas como JSON
    echo json_encode($tasks);
} else {
    // Se não houver tarefas encontradas, retorna um array vazio como JSON
    echo json_encode(array());
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
