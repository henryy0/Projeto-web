<?php
// Inclua o arquivo de configuração do banco de dados
include_once 'conexao.php'; // Verifique se o caminho está correto

// Inicie a sessão apenas se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ob_start(); // Limpar o buffer de saída para evitar erro de redirecionamento

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario']) or !isset($_SESSION['nome_usuario'])) {
    $_SESSION['msg'] = "<p class='alert-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: ../index.php"); // login deve ser a tela inicial
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="CHat/chat.css">
</head>

<body>

    <div class="container">
        <div class="conteudo-chat">
            <div class="header-chat">
                <div class="usuario-dados">
                    <img src="img/logo.png" class="img-usuario" alt="<?php echo $_SESSION['nome_usuario']; ?>">
                    <div class="nome-usuario" id="nome-usuario"><?php echo $_SESSION['nome_usuario']; ?></div>
                </div>
                <div class="sair">
                    <a href="Usuario/logout.php" class="btn-sair">Sair</a>
                </div>
            </div>
            <div class="chat-box" id="chatBox">
                <span id="mensagem-chat"></span>
            </div>
            <form class="enviar-msg">
                <!-- Campo oculto com o id do usuário -->
                <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $_SESSION['id_usuario']; ?>">
                <!-- Campo para o usuário digitar a nova mensagem -->
                <input type="text" name="mensagem" id="mensagem" class="campo-msg" placeholder="Mensagem...">
                <input type="button" name="btnEnviar" class="btn-enviar-msg" onclick="enviar()" value="Enviar">
            </form>
        </div>
    </div>

    <script>
        // Recuperar o id que deve receber as mensagem do chat
        const mensagemChat = document.getElementById('mensagem-chat');

        // Endereço do websocket
        const ws = new WebSocket('ws://localhost:3306');

        // Realizar a conexão com websocket
        ws.onopen = (e) => {
            //console.log('Conectado!');
        }

        // Receber a mensagem do WebSocket
        ws.onmessage = (mensagemRecebida) => {

            // Ler as mensagem enviada pelo WebSocket
            let resultado = JSON.parse(mensagemRecebida.data);

            // Enviar a mensagem para o HTML, inserir no final da lista de mensagens
            mensagemChat.insertAdjacentHTML('beforeend', `<div class="msg-recebida">
                    <div class="det-msg-recebida">
                        <p class="texto-msg-recebida">${resultado.nome}: ${resultado.mensagem}</p>
                    </div>
                </div>`);

            // Role para o final após adicionar as mensagens
            scrollBottom();
        }

        // Função para enviar a mensagem
        const enviar = () => {

            // Recuperar o id do campo mensagem
            let mensagem = document.getElementById("mensagem");

            // Recuperar o nome do usuário
            var nomeUsuario = document.getElementById('nome-usuario').textContent;

            // Recuperar o id do usuário
            var usuarioId = document.getElementById('usuario_id').value;

            // Verificar se existe o id do usuário
            if (usuarioId === "") {
                alert("Erro: Necessário realizar o login para acessar a página!");
                window.location.href = "index.php";
                return;
            }

            // Criar o array de dados para enviar para websocket
            let dados = {
                mensagem: `${mensagem.value}`,
                usuario_id: usuarioId,
                nome: nomeUsuario
            }

            // Enviar a mensagem para websocket
            ws.send(JSON.stringify(dados));

            // Enviar a mensagem para o HTML, inserir no final da lista de mensagens
            mensagemChat.insertAdjacentHTML('beforeend', `<div class="msg-enviada">
                    <div class="det-msg-enviada">
                        <p class="texto-msg-enviada">${nomeUsuario}: ${mensagem.value}</p>
                    </div>
                </div>`);

            // Limpar o campo mensagem
            mensagem.value = '';

            // Role para o final após adicionar as mensagens
            scrollBottom();
        }

        // Role para o final após adicionar as mensagens
        function scrollBottom() {
            var chatBox = document.getElementById("chatBox");
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>

</body>

</html>
