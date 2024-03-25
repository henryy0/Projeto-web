<?php
// Verifica se os dados do formulário foram submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepara e executa a consulta SQL para adicionar o projeto
    $stmt = $conn->prepare("INSERT INTO Projeto (Nome_Projeto, Tipo_Projeto, Data_inicio_Projeto, Data_Fim_Projeto, Status_Projeto, Resumo_Projeto, Riscos_Projeto, Orcamento_Projeto, Recursos_Projeto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdss", $nomeProjeto, $tipoProjeto, $dataInicio, $dataFim, $statusProjeto, $resumoProjeto, $riscosProjeto, $orcamentoProjeto, $recursosProjeto);

    // Obtém os dados do formulário
    $nomeProjeto = $_POST["addProjectName"];
    $tipoProjeto = $_POST["addProjectType"];
    $dataInicio = $_POST["addProjectStartDate"];
    $dataFim = $_POST["addProjectEndDate"];
    $statusProjeto = $_POST["addProjectStatus"];
    $resumoProjeto = $_POST["addProjectSummary"];
    $riscosProjeto = $_POST["addProjectRisks"];
    $orcamentoProjeto = $_POST["addProjectBudget"];
    $recursosProjeto = $_POST["addProjectResources"];

    // Executa a consulta
    if ($stmt->execute() === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("success" => true));
    } else {
        // Retorna uma resposta JSON de erro
        echo json_encode(array("success" => false, "message" => "Erro ao adicionar projeto: " . $conn->error));
    }

    // Fecha a consulta e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se não foram submetidos dados via POST, retorna um erro
    echo json_encode(array("success" => false, "message" => "Método não permitido"));
}
?>
