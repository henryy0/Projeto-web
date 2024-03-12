<?php

$host = 'localhost';
$dbname = 'SistemaDeGerenciamento';
$username = 'root';
$password = '';

try {
  
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $conn->exec("set names utf8");

   
    echo "Conexão bem sucedida!";
} catch (PDOException $e) {
 
    echo "Erro de conexão: " . $e->getMessage();
}
?>