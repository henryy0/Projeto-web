<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Evento</title>
</head>
<body>
    <form method="POST" action="salvar_evento.php">
        <label for="txtDate">Data:</label>
        <input type="text" name="txtDate" id="txtDate" value="<?php echo date('d/m/Y'); ?>"><br><br>
        
        <label for="txtEvent">Evento:</label><br>
        <textarea name="txtEvent" id="txtEvent" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" name="btnSave" value="Salvar">
    </form>

    <?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações de conexão com o banco de dados
    $host = 'localhost';
    $dbname = 'sistemaDeGerenciamento';
    $username = 'root';
    $password = '';

    // Conexão com o banco de dados
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }

    // Prepara e executa a consulta SQL para inserir o evento no banco de dados
    $sql = "INSERT INTO Calendario (Date, Event) VALUES (:Date, :Event)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Date', $_POST['txtDate']);
    $stmt->bindParam(':Event', $_POST['txtEvent']);
    
    // Executa a consulta
    try {
        $stmt->execute();
        echo "<script>alert('Salvo');</script>";
    } catch (PDOException $e) {
        echo "Erro ao salvar: " . $e->getMessage();
    }
} else {
    // Se o formulário não foi submetido, redireciona de volta ao formulário
    header("Location: formulario.php");
    exit;
}
?>

</body>
</html>
