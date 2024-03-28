<?php
session_start();
// Conexão com o banco de dados (substitua pelas suas informações)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SistemaDeGerenciamento";

// Cria a conexão

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém os dados do formulário
$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Consulta o banco de dados para encontrar o usuário com o login fornecido
$sql = "SELECT * FROM Usuario WHERE login_usuario='$login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuário encontrado, verifica a senha
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha_usuario'])) {
        // Senha correta, inicia a sessão e redireciona para a página inicial
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nome_usuario'] = $row['nome_usuario'];
        header("Location: ../Sistema.php");
        exit();
    } else {
        // Senha incorreta
        echo "Senha incorreta.";
    }
} else {
    // Usuário não encontrado
    echo "Usuário não encontrado.";
}

$conn->close();
?>
