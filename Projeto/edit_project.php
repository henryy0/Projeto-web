<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se todos os parâmetros necessários foram recebidos
    if (isset($_POST['editProjectId'], $_POST['editProjectName'], $_POST['editProjectType'], $_POST['editProjectStartDate'], $_POST['editProjectStatus'], $_POST['editProjectSummary'], $_POST['editProjectRisks'], $_POST['editProjectBudget'], $_POST['editProjectResources'])) {

        // Captura os dados do formulário
        $projectId = $_POST['editProjectId'];
        $projectName = $_POST['editProjectName'];
        $projectType = $_POST['editProjectType'];
        $projectStartDate = $_POST['editProjectStartDate'];
        $projectEndDate = $_POST['editProjectEndDate'];
        $projectStatus = $_POST['editProjectStatus'];
        $projectSummary = $_POST['editProjectSummary'];
        $projectRisks = $_POST['editProjectRisks'];
        $projectBudget = $_POST['editProjectBudget'];
        $projectResources = $_POST['editProjectResources'];

        // Configurações de conexão com o banco de dados
        $servername = "localhost";
        $username = "root"; // Insira seu usuário do banco de dados aqui
        $password = ""; // Insira sua senha do banco de dados aqui
        $dbname = "SistemaDeGerenciamento"; // Insira o nome do seu banco de dados aqui

        // Cria conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para atualizar o projeto no banco de dados
        $stmt = $conn->prepare("UPDATE Projeto SET Nome_Projeto=?, Tipo_Projeto=?, Data_inicio_Projeto=?, Data_Fim_Projeto=?, Status_Projeto=?, Resumo_Projeto=?, Riscos_Projeto=?, Orcamento_Projeto=?, Recursos_Projeto=? WHERE ID_Projeto=?");
        $stmt->bind_param("ssssssdsdi", $projectName, $projectType, $projectStartDate, $projectEndDate, $projectStatus, $projectSummary, $projectRisks, $projectBudget, $projectResources, $projectId);

        if ($stmt->execute()) {
            // Retorna uma resposta JSON para indicar sucesso
            echo json_encode(array("success" => true));
        } else {
            // Retorna uma resposta JSON com mensagem de erro, se houver
            echo json_encode(array("success" => false, "message" => "Erro ao editar projeto: " . $stmt->error));
        }

        // Fecha a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } else {
        // Retorna uma resposta JSON se os parâmetros não foram recebidos corretamente
        echo json_encode(array("success" => false, "message" => "Parâmetros incompletos"));
    }
} else {
    // Retorna uma resposta JSON se a requisição não for do tipo POST
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>
