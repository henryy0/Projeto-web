<?php
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

// Prepara e executa a consulta SQL para buscar os projetos
$sql = "SELECT * FROM Projeto";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Inicializa um array para armazenar os projetos
    $projects = array();

    // Percorre os resultados e adiciona os projetos ao array
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    // Retorna os projetos como JSON
    echo json_encode($projects);
} else {
    // Se não houver projetos, retorna uma mensagem de erro
    echo json_encode(array("message" => "Nenhum projeto encontrado"));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
