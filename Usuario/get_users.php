<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SistemaDeGerenciamento";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT id_usuario, nome_usuario, sobrenome_usuario, foto_usuario FROM Usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(array("message" => "Nenhum usuário encontrado."));
}

$conn->close();
?>
