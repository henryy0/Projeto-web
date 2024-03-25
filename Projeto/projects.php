<?php include 'conexao'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Projetos</h1>

    <!-- Aqui você pode adicionar formulários e tabelas para exibir, criar, atualizar e excluir projetos -->

    <?php
    // Exemplo de consulta para listar projetos
    $sql = "SELECT * FROM Projeto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Saída de dados de cada linha
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["ID_Projeto"]. " - Nome: " . $row["Nome_Projeto"]. "<br>";
        }
    } else {
        echo "0 resultados";
    }
    ?>
</body>
</html>
