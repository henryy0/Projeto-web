<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>

    <!-- Header -->
    <?php include_once("Body/_topo.php"); ?>

    <!-- Container principal -->
    <div class="container-main">
        <!-- Menu Lateral -->
        <div class="menu">
            <?php include_once("Body/_menu.php"); ?>
        </div>

        <!-- Conteúdo Principal -->
        <div class="content">
            <!-- Autenticação de Login -->
            <?php include_once("Login/autenticar.php"); ?>

            <!-- Conteúdo Dinâmico -->
            <?php
            if (isset($_GET['tela'])) {
                $tela = $_GET['tela'];
                $allowed_pages = array(
                    'usuario' => "Usuario/frmusuario.php",
                    'projeto' => "Projeto/frmProjeto.php",
                    'tarefa' => "Tarefa/frmTarefa.php",
                    'chat' => "Chat/frmChat.php",
                    'equipe' => "Equipe.php",
                    'calendario' => "Calendario.php"
                );

                if (array_key_exists($tela, $allowed_pages)) {
                    include_once($allowed_pages[$tela]);
                } else {
                    include_once("Body/_home.php");
                }
            } else {
                include_once("Body/_home.php");
            }
            ?>
        </div>
    </div>

    <!-- Rodapé -->
    <?php include_once("Body/_rodape.php"); ?>

    <script src="js/bootstrap.js"></script>
</body>

</html>
