<?php
session_start();

// Destruir todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Redirecionar o usuário de volta para a página de login ou para qualquer página desejada
header("Location: ../index.php");
exit;
?>
