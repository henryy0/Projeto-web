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

    <div class="container">
        <div class="row">
            <?php include_once("Body/_topo.php"); ?>
        </div>
    </div>
    <div class="container mb-3">
        <div class="row">
            <div class="col-sm-2">
                <?php include_once("Body/_menu.php"); ?>
                <?php include_once("Login/autenticar.php"); ?>
            </div>
            <div class="col-sm-10">
                <?php
                if(isset($_GET['tela']))
                {
                    $tela = $_GET['tela'];

                    switch ($tela) {
                        case 'usuario':
                            include_once("Usuario/frmusuario.php"); // Formulário de usuário
                            break;
                        case 'projeto':
                            include_once("Projeto/frmProjeto.php"); // Formulário de projeto
                            break;
                        case 'tarefa':
                            include_once("Tarefa/frmTarefa.php"); // Formulário de tarefa
                            break;
                        case 'chat':
                            include_once("Chat/frmChat.php"); // Formulário de chat
                            break;
                        case 'equipe':
                            include_once("Equipe.php"); // Formulário de equipe
                            break;
                        case 'calendario':
                            include_once("Calendario.php"); // Formulário de calendário
                            break;
                        default:
                            include_once("Body/_home.php"); // Página inicial
                            break;
                    }
                }
                else
                {
                    include_once("Body/_home.php"); // Página inicial
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <?php include_once("Body/_rodape.php"); ?>
        </div>
    </div>
    
    <script src="js/bootstrap.js"></script>
</body>

</html>
