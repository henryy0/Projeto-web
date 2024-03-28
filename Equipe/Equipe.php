<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Equipe</title>
    <link rel="stylesheet" href="Equipe/Equipe.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Equipe</h1>
        <form id="equipe-form" method="post" action="Equipe/processa_adicionar_equipe.php">
            <label for="equipe-nome">Nome da Equipe:</label>
            <input type="text" id="equipe-nome" name="equipe_nome" required><br>
            <label for="equipe-descricao">Descrição:</label>
            <textarea id="equipe-descricao" name="equipe_descricao" required></textarea><br>
            <label for="equipe-lider">Líder da Equipe:</label>
            <select id="equipe-lider" name="equipe_lider" required>
                <!-- Opções dinâmicas para líderes (preenchido via JavaScript) -->
            </select><br>
            <label for="projeto-atribuido">Projeto Atribuído:</label>
            <select id="projeto-atribuido" name="projeto_atribuido" required>
                <!-- Opções dinâmicas para projetos (preenchido via JavaScript) -->
            </select><br>
            <button type="submit">Adicionar Equipe</button>
        </form>


        <h2>Equipes Adicionadas</h2>
        <ul>
            <?php
            // Inclui o arquivo de conexão com o banco de dados
            include 'conexao.php';

            // Consulta as equipes adicionadas
            $sql_equipes = "SELECT * FROM Equipe";
            $result_equipes = $conn->query($sql_equipes);

            // Exibe as equipes adicionadas
            if ($result_equipes->num_rows > 0) {
                while($row = $result_equipes->fetch_assoc()) {
                    echo "<li>" . $row["equipe_nome"] . "</li>";
                }
            } else {
                echo "<li>Nenhuma equipe adicionada ainda.</li>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
        </ul>
    </div>

    <script src="Equipe/Equipe.js"></script>
</body>
</html>
