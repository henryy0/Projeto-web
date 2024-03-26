document.addEventListener('DOMContentLoaded', function () {
    // Função para carregar projetos
    function loadProjects() {
        const projectSelect = document.getElementById('project');
        if (!projectSelect) {
            console.error('Elemento project não encontrado.');
            return;
        }

        fetch('Projeto/get_projects.php')
            .then(response => response.json())
            .then(data => {
                projectSelect.innerHTML = '';
                data.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.ID_Projeto;
                    option.textContent = project.Nome_Projeto;
                    projectSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar projetos:', error));
    }

    // Função para carregar responsáveis
    function loadResponsibles() {
        const responsibleSelect = document.getElementById('responsible');
        if (!responsibleSelect) {
            console.error('Elemento responsible não encontrado.');
            return;
        }

        fetch('Usuario/get_users.php')
            .then(response => response.json())
            .then(data => {
                responsibleSelect.innerHTML = '';
                data.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id_usuario;
                    option.textContent = user.nome_usuario;
                    responsibleSelect.appendChild(option);
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
                            <p class="card-text">${task.obs_tarefa || 'Descrição não definida'}</p>
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
    

    // Carrega projetos, responsáveis e tarefas ao iniciar a página
    loadProjects();
    loadResponsibles();
    loadTasks();

    // Adicionar evento de submissão para adicionar tarefa
    const addTaskForm = document.getElementById('addTaskForm');
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('Tarefa/add_task.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#addTaskModal').modal('hide');
                    loadTasks(); // Recarregar a lista de tarefas após adição bem-sucedida
                } else {
                    console.error('Erro ao adicionar tarefa:', data.message);
                }
            })
            .catch(error => console.error('Erro ao adicionar tarefa:', error));
        });
    }

    // Adicionar evento de clique para abrir o modal de edição de tarefa
    const editTaskModal = document.getElementById('editTaskModal');
    if (editTaskModal) {
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('editTaskButton')) {
                const taskId = event.target.getAttribute('data-id');
                fetch(`Tarefa/get_task.php?id=${taskId}`)
                    .then(response => response.json())
                    .then(task => {
                        // Preencher os campos do modal com os dados da tarefa
                        document.getElementById('editTaskId').value = taskId; // Adicionar o ID da tarefa oculto
                        document.getElementById('editTaskName').value = task.Nome_tarefa || '';
                        document.getElementById('editTaskDescription').value = task.obs_tarefa || '';
                        document.getElementById('editTaskProject').value = task.Projeto_tarefa || '';
                        document.getElementById('editTaskResponsible').value = task.Responsavel_tarefa || '';
                        document.getElementById('editTaskStatus').value = task.Status_tarefa || '';
                        document.getElementById('editTaskStartDate').value = task.Data_inicio_Tarefa || '';
                        document.getElementById('editTaskEndDate').value = task.Data_Fim_Tarefa || '';
                        // Preencher outros campos conforme necessário
                        // ...

                        // Recarregar as opções do projeto e do responsável
                        loadProjects();
                        loadResponsibles();

                        $('#editTaskModal').modal('show');
                    })
                    .catch(error => console.error('Erro ao obter tarefa:', error));
            }
        });
    }


    // Adicionar evento de clique para confirmar exclusão de tarefa
    const taskCardContainer = document.getElementById('taskCardContainer');
    if (taskCardContainer) {
        taskCardContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('deleteTaskButton')) {
                const taskId = event.target.getAttribute('data-id');
                fetch(`Tarefa/delete_task.php?id=${taskId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadTasks(); // Recarregar a lista de tarefas após exclusão bem-sucedida
                    } else {
                        console.error('Erro ao excluir tarefa:', data.message);
                    }
                })
                .catch(error => console.error('Erro ao excluir tarefa:', error));
            }
        });
    }
});

