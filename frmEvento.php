<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Evento</title>
    <link rel="stylesheet" href="css/event.css">
</head>
<body>
    <div class="event-form-container">
        <h2>Criar Novo Evento</h2>
        <form action="criar_evento.php" method="POST">
            <label for="title">Título do Evento:</label>
            <input type="text" id="title" name="title" required><br><br>
            
            <label for="description">Descrição:</label><br>
            <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
            
            <label for="date">Data do Evento:</label>
            <input type="date" id="date" name="date" required><br><br>
            
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
