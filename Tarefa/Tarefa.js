document.addEventListener('DOMContentLoaded', function () {
    // Função para carregar projetos
    function loadProjects(selectElement) {
        fetch('Projeto/get_projects.php')
            .then(response => response.json())
            .then(data => {
                selectElement.innerHTML = '';
                data.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.ID_Projeto;
                    option.textContent = project.Nome_Projeto;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar projetos:', error));
    }

    // Função para carregar responsáveis
    function loadResponsibles(selectElement) {
        fetch('Usuario/get_users.php')
            .then(response => response.json())
            .then(data => {
                selectElement.innerHTML = '';
                data.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id_usuario;
                    option.textContent = user.nome_usuario;
                    selectElement.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar responsáveis:', error));
    }

    // Função para carregar tarefas
    function loadTasks() {
        const taskCardContainer = document.getElementById('taskCardContainer');
        if (!taskCardContainer) {
            console.error('Elemento taskCardContainer não encontrado.');
            return;
        }

        fetch('Tarefa/get_tasks.php')
            .then(response => {
                // Verifica se a resposta não é um erro
                if (!response.ok) {
                    throw new Error('Erro ao carregar tarefas: ' + response.statusText);
                }
                return response.json(); // Retorna os dados como JSON
            })
            .then(data => {
                // Limpa o contêiner antes de adicionar novos elementos
                taskCardContainer.innerHTML = '';

                // Itera sobre os dados e cria cartões de tarefa
                data.forEach(task => {
                    const taskCard = document.createElement('div');
                    taskCard.classList.add('card', 'mb-3', 'task-card');
                    taskCard.innerHTML = `
                        <div class="card-body">
                            <h5 class="card-title">${task.Nome_tarefa || 'Nome não definido'}</h5>
                            <p class="card-text">${task.Obs_tarefa || 'Descrição não definida'}</p>
                            <p class="card-text">Projeto: ${task.Nome_Projeto || 'Projeto não definido'}</p>
                            <p class="card-text">Responsável: ${task.nome_usuario || 'Responsável não definido'}</p>
                            <p class="card-text">Status: ${task.Status_tarefa || 'Status não definido'}</p>
                            <p class="card-text">Data de Início: ${task.Data_inicio_Tarefa || 'Data de início não definida'}</p>
                            <p class="card-text">Data de Término: ${task.Data_Fim_Tarefa || 'Data de término não definida'}</p>
                            <!-- Adicione outros campos conforme necessário -->
                            <button class="btn btn-danger deleteTaskButton" data-id="${task.ID_tarefa}">Excluir</button>
                            <button class="btn btn-primary editTaskButton" data-id="${task.ID_tarefa}">Editar</button>
                        </div>
                    `;
                    taskCardContainer.appendChild(taskCard);
                });
            })
            .catch(error => {
                console.error('Erro ao carregar tarefas:', error);
            });
    }

    // Carrega projetos e responsáveis ao iniciar a página
    const addTaskModal = document.getElementById('addTaskModal');
    const editTaskModal = document.getElementById('editTaskModal');

    if (addTaskModal && editTaskModal) {
        addTaskModal.addEventListener('show.bs.modal', function () {
            const projectSelect = document.getElementById('project');
            const responsibleSelect = document.getElementById('responsible');
            if (projectSelect && responsibleSelect) {
                loadProjects(projectSelect);
                loadResponsibles(responsibleSelect);
            }
        });

        editTaskModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Botão que acionou o modal
            const taskId = button.getAttribute('data-id'); // Extrai o ID da tarefa do botão

            const editTaskForm = document.getElementById('editTaskForm');
            if (editTaskForm) {
                fetch(`Tarefa/get_task.php?id=${taskId}`)
                    .then(response => {
                        // Verifica se a resposta não é um erro
                        if (!response.ok) {
                            throw new Error('Erro ao obter tarefa: ' + response.statusText);
                        }
                        return response.json(); // Retorna os dados da tarefa como JSON
                    })
                    .then(task => {
                        // Preencher os campos do formulário de edição com os dados da tarefa
                        editTaskForm.querySelector('#editTaskName').value = task.Nome_tarefa || '';
                        editTaskForm.querySelector('#editTaskStartDate').value = task.Data_inicio_Tarefa || '';
                        editTaskForm.querySelector('#editTaskEndDate').value = task.Data_Fim_Tarefa || '';
                        editTaskForm.querySelector('#editTaskStatus').value = task.Status_tarefa || '';
                        editTaskForm.querySelector('#editTaskDescription').value = task.Obs_tarefa || '';
                        editTaskForm.querySelector('#editTaskProject').value = task.Projeto_tarefa || '';
                        editTaskForm.querySelector('#editTaskResponsible').value = task.Responsavel_tarefa || '';
                        // Adicione campos adicionais conforme necessário
                    })
                    .catch(error => console.error('Erro ao carregar dados da tarefa:', error));
            }
        });
    }

    // Evento de clique no botão "Adicionar Tarefa"
    const addTaskForm = document.getElementById('addTaskForm');
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Impede o envio do formulário

            const formData = new FormData(addTaskForm); // Obtém os dados do formulário
            fetch('Tarefa/add_task.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    // Verifica se a resposta não é um erro
                    if (!response.ok) {
                        throw new Error('Erro ao adicionar tarefa: ' + response.statusText);
                    }
                    return response.json(); // Retorna os dados da resposta como JSON
                })
                .then(data => {
                    if (data.success) {
                        // Recarrega as tarefas após adicionar uma nova
                        loadTasks();
                        // Fecha o modal de adicionar tarefa
                        const addTaskModal = new bootstrap.Modal(document.getElementById('addTaskModal'));
                        addTaskModal.hide();
                    } else {
                        console.error('Erro ao adicionar tarefa:', data.message || 'Erro desconhecido');
                    }
                })
                .catch(error => console.error('Erro ao adicionar tarefa:', error));
        });
    }

    // Evento de clique no botão "Excluir Tarefa"
const taskCardContainer = document.getElementById('taskCardContainer');
if (taskCardContainer) {
taskCardContainer.addEventListener('click', function (event) {
if (event.target.classList.contains('deleteTaskButton')) {
const taskId = event.target.getAttribute('data-id');
if (confirm('Tem certeza de que deseja excluir esta tarefa?')) {
    fetch('Tarefa/delete_task.php?id=' + taskId, {
method: 'DELETE'
})
.then(response => {
if (!response.ok) {
throw new Error('Erro ao excluir tarefa: ' + response.statusText);
}
return response.json();
})
.then(data => {
if (data.success) {
// Recarrega as tarefas após excluir uma
loadTasks();
} else {
console.error('Erro ao excluir tarefa:', data.message || 'Erro desconhecido');
}
})
.catch(error => console.error('Erro ao excluir tarefa:', error));
}
}
});
}

// Evento de envio do formulário de edição de tarefa
const editTaskForm = document.getElementById('editTaskForm');
if (editTaskForm) {
    editTaskForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio do formulário

        const formData = new FormData(editTaskForm); // Obtém os dados do formulário
        fetch('Tarefa/update_task.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                // Verifica se a resposta não é um erro
                if (!response.ok) {
                    throw new Error('Erro ao atualizar tarefa: ' + response.statusText);
                }
                return response.json(); // Retorna os dados da resposta como JSON
            })
            .then(data => {
                if (data.success) {
                    // Recarrega as tarefas após editar uma
                    loadTasks();
                    // Fecha o modal de editar tarefa
                    const editTaskModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                    editTaskModal.hide();
                } else {
                    console.error('Erro ao atualizar tarefa:', data.message || 'Erro desconhecido');
                }
            })
            .catch(error => console.error('Erro ao atualizar tarefa:', error));
    });
}

// Carrega as tarefas ao iniciar a página
loadTasks();
});
