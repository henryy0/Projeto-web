// Função para adicionar equipe
function adicionarEquipe() {
    const nome = document.getElementById('equipe-nome').value;
    const descricao = document.getElementById('equipe-descricao').value;
    const lider = document.getElementById('equipe-lider').value;
    const projeto = document.getElementById('projeto-atribuido').value;

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (nome && descricao && lider && projeto) {
        // Objeto com os dados da equipe a serem enviados
        const equipeData = {
            equipe_nome: nome,
            equipe_descricao: descricao,
            equipe_lider: lider,
            projeto_atribuido: projeto
        };

        // Envia os dados da equipe para o servidor usando AJAX
        fetch('processa_adicionar_equipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(equipeData)
        })
        .then(response => {
            // Verifica se a requisição foi bem-sucedida
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Erro ao adicionar equipe.');
            }
        })
        .then(data => {
            // Exibe uma mensagem de sucesso ou erro, dependendo da resposta do servidor
            alert(data.message);
        })
        .catch(error => {
            // Exibe mensagem de erro em caso de falha na requisição
            alert(error.message);
        });
    } else {
        // Exibe mensagem de erro se algum campo estiver em branco
        alert('Por favor, preencha todos os campos.');
    }
}
