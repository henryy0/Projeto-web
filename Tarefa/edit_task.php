<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // Seu nome de usuário do banco de dados
    $password = ""; // Sua senha do banco de dados
    $dbname = "SistemaDeGerenciamento"; // Nome do seu banco de dados

    // Obtém os dados do formulário
    $id = $_POST['editTaskId'];
    $projeto = $_POST['editTaskProject'];
    $nome = $_POST['editTaskName'];
    $data_inicio = $_POST['editTaskStartDate'];
    $data_fim = $_POST['editTaskEndDate'];
    $obs = $_POST['editTaskDescription'];
    $status = $_POST['editTaskStatus'];
    $responsavel = $_POST['editTaskResponsible'];

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara e executa a consulta SQL para editar a tarefa
    $sql = "UPDATE Tarefa SET Projeto_tarefa='$projeto', Nome_tarefa='$nome', Data_inicio_Tarefa='$data_inicio', Data_Fim_Tarefa='$data_fim', Obs_tarefa='$obs', Status_tarefa='$status', Responsavel_tarefa='$responsavel' WHERE ID_tarefa=$id";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("success" => true));
    } else {
        // Retorna uma resposta JSON de erro com a mensagem de erro
        echo json_encode(array("success" => false, "message" => "Erro ao editar tarefa: " . $conn->error));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Retorna uma resposta JSON de erro se o método de requisição não for POST
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>
