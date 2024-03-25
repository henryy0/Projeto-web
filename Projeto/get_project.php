<?php
// Verifica se o parâmetro ID foi fornecido na URL
if (isset($_GET['id'])) {
    // Captura o ID do projeto da URL
    $projectID = $_GET['id'];

    $servername = "localhost";
    $username = "root"; // Insira seu usuário do banco de dados aqui
    $password = ""; // Insira sua senha do banco de dados aqui
    $dbname = "SistemaDeGerenciamento"; // Insira o nome do seu banco de dados aqui
    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta SQL para buscar o projeto com o ID fornecido
    $sql = "SELECT * FROM Projeto WHERE ID_Projeto = $projectID";

    // Executa a consulta
    $result = $conn->query($sql);

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Extrai os dados do projeto
        $projectData = $result->fetch_assoc();

        // Retorna os dados do projeto como JSON
        echo json_encode($projectData);
    } else {
        // Retorna uma mensagem de erro se o projeto não foi encontrado
        echo json_encode(array("error" => "Projeto não encontrado"));
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Retorna uma mensagem de erro se o parâmetro ID não foi fornecido
    echo json_encode(array("error" => "ID do projeto não fornecido"));
}
?>
