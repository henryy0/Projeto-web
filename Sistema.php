<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CollaboraPro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Adicionando o Favicon -->
    <link rel="icon" type="image/png" href="img/logo.png">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Adicionando a Logo -->
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Logo" height="30">
                CollaboraPro
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- Alterando "Sistema CRUD" para "CollaboraPro" -->
                    <li class="nav-item">
                        <a class="nav-link" href="?tela=tarefa">Tarefa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?tela=projeto">Projeto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?tela=equipe">Equipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?tela=chat">Chat</a>
                    </li>
                    <!-- Exibição da Imagem do Usuário e Menu Dropdown -->
                    <?php
                    if(isset($_SESSION['id_usuario'])) {
                        // Conexão com o banco de dados
                        $servername = "localhost";
                        $username = "root"; // Insira seu usuário do banco de dados aqui
                        $password = ""; // Insira sua senha do banco de dados aqui
                        $dbname = "SistemaDeGerenciamento"; // Insira o nome do seu banco de dados aqui

                        // Cria a conexão
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Verifica a conexão
                        if ($conn->connect_error) {
                            die("Conexão falhou: " . $conn->connect_error);
                        }

                        // Obtém o ID do usuário logado
                        $id_usuario = $_SESSION['id_usuario'];

                        // Consulta para obter o caminho da imagem do usuário
                        $sql = "SELECT foto_usuario FROM Usuario WHERE id_usuario = $id_usuario";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Exibe a imagem do usuário e o menu dropdown
                            $row = $result->fetch_assoc();
                            $caminho_imagem = "Usuario/imgusuario/" . $id_usuario . "/" . $row['foto_usuario'];

                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            echo '<img src="' . $caminho_imagem . '" alt="Imagem do Usuário" class="rounded-circle" height="30" width="30">';
                            echo '</a>';
                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            echo '<a class="dropdown-item" href="Usuario/editar_perfil.php">Atualizar Informações</a>';
                            echo '<div class="dropdown-divider"></div>';
                            echo '<a class="dropdown-item" href="Usuario/logout.php">Sair</a>';
                            echo '</div>';
                            echo '</li>';
                        }

                        $conn->close();
                    } else {
                        // Se o usuário não estiver logado, exibe o link de login
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="Usuario/login.php">';
                        echo '<i class="fas fa-user"></i> Login';
                        echo '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php
                    // Incluir o conteúdo da tela solicitada
                    if(isset($_GET['tela'])) {
                        $tela = $_GET['tela'];
                        switch ($tela) {
                            case 'tarefa':
                                include_once("Tarefa/frmtarefa.php");
                                break;
                            case 'projeto':
                                include_once("Projeto/frmProjeto.php");
                                break;
                            case 'equipe':
                                include_once("Equipe/frmEquipe.php");
                                break;
                            case 'chat':
                                include_once("Chat/frmChat.php");
                                break;
                            default:
                                include_once("Body/_home.php");
                                break;
                        }
                    } else {
                        include_once("Body/_home.php"); 
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <p>&copy; <?php echo date("Y"); ?> CollaboraPro</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
