<?php
session_start();
// Verificar se o usuário está logado
if(!isset($_SESSION['id_usuario'])) {
    // Redirecionar para a página de login
    header("Location: ../index.php");
    exit();
}

// Conectar ao banco de dados
require_once "../conexao.php"; // Arquivo de conexão com o banco de dados

// Obter os dados do formulário
$id_usuario = $_SESSION['id_usuario'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Verificar se uma nova imagem foi enviada
if($_FILES['foto']['error'] === 0) {
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];
    $caminho_destino = "Usuario/imgusuario/$id_usuario/$nome_arquivo";
    
    // Mover a nova imagem para o diretório do usuário
    if(move_uploaded_file($caminho_temporario, $caminho_destino)) {
        // Atualizar o caminho da imagem no banco de dados
        $sql_update_imagem = "UPDATE Usuario SET foto_usuario = '$caminho_destino' WHERE id_usuario = $id_usuario";
        $conn->query($sql_update_imagem);

        // Remover a imagem anterior se existir
        $sql_select_imagem_anterior = "SELECT foto_usuario FROM Usuario WHERE id_usuario = $id_usuario";
        $resultado = $conn->query($sql_select_imagem_anterior);
        if($resultado->num_rows > 0) {
            $dados_usuario = $resultado->fetch_assoc();
            $caminho_imagem_anterior = $dados_usuario['foto_usuario'];
            if($caminho_imagem_anterior != null) {
                unlink($caminho_imagem_anterior);
            }
        }
    }
}

// Atualizar os outros campos no banco de dados
$sql_update_dados = "UPDATE Usuario SET nome_usuario = '$nome', sobrenome_usuario = '$sobrenome', email_usuario = '$email', telefone_usuario = '$telefone' WHERE id_usuario = $id_usuario";
if($conn->query($sql_update_dados) === TRUE) {
    echo "Dados atualizados com sucesso.";
} else {
    echo "Erro ao atualizar os dados: " . $conn->error;
}

$conn->close();
?>
