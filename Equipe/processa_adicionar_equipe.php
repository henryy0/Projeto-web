<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include '../conexao.php';

    // Verifica se os campos do formulário foram recebidos corretamente
    if(isset($_POST['equipe_nome'], $_POST['equipe_descricao'], $_POST['equipe_lider'])) {
        // Recebe os dados do formulário
        $equipe_nome = $_POST['equipe_nome'];
        $equipe_descricao = $_POST['equipe_descricao'];
        $equipe_lider_id = $_POST['equipe_lider'];
        $projeto_atribuido_ID = isset($_POST['projeto_atribuido']) ? $_POST['projeto_atribuido'] : null;

        // Verifica se o ID do líder da equipe existe na tabela de usuários
        $query_verifica_lider = "SELECT id_usuario FROM Usuario WHERE id_usuario = ?";
        $stmt_verifica_lider = $conn->prepare($query_verifica_lider);
        $stmt_verifica_lider->bind_param("i", $equipe_lider_id);
        $stmt_verifica_lider->execute();
        $result_verifica_lider = $stmt_verifica_lider->get_result();

        if ($result_verifica_lider->num_rows > 0) {
            // O ID do líder da equipe é válido, então podemos continuar com a inserção
            // Prepara uma declaração para evitar injeção de SQL
            $stmt = $conn->prepare("INSERT INTO Equipe (equipe_nome, equipe_descricao, equipe_lider_id, Projeto_atribuido_ID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $equipe_nome, $equipe_descricao, $equipe_lider_id, $projeto_atribuido_ID);

            // Executa a query de inserção
            if ($stmt->execute()) {
                // Define uma mensagem de sucesso
                $mensagem = "Equipe adicionada com sucesso!";
            } else {
                // Em caso de erro, define uma mensagem de erro
                $mensagem = "Erro ao adicionar equipe: " . $stmt->error;
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            // O ID do líder da equipe não é válido
            $mensagem = "ID do líder da equipe inválido.";
        }
        
        // Fecha a declaração de verificação do líder da equipe
        $stmt_verifica_lider->close();
    } else {
        // Se algum campo estiver faltando, define uma mensagem de erro
        $mensagem = "Por favor, preencha todos os campos do formulário.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();

    // Redireciona de volta para a página de adicionar equipe com a mensagem
    header("Location: ../Sistema.php?tela=equipe&mensagem=" . urlencode($mensagem));
    exit();
}
?>
