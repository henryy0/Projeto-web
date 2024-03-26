document.addEventListener('DOMContentLoaded', function () {
    const projectTableBody = document.getElementById('projectTableBody');

    // Função para calcular a porcentagem de progresso do projeto
    function calculateProjectProgress(completedTasks, totalTasks) {
        if (totalTasks === 0) {
            return 0;
        }
        return Math.round((completedTasks / totalTasks) * 100);
    }

    // Função para carregar os projetos
    function loadProjects() {
        fetch('Projeto/get_projects.php')
            .then(response => response.json())
            .then(data => {
                projectTableBody.innerHTML = '';

                data.forEach(project => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${project.ID_Projeto}</td>
                        <td>${project.Nome_Projeto}</td>
                        <td>${project.Data_inicio_Projeto}</td>
                        <td>${project.Data_Fim_Projeto}</td>
                        <td>${project.Status_Projeto}</td>
                        <td>${calculateProjectProgress(project.CompletedTasks, project.TotalTasks)}%</td>
                        <td>
                            <button class="btn btn-info btn-sm mr-2 editButton" data-toggle="modal" data-target="#editProjectModal" data-id="${project.ID_Projeto}">Editar</button>
                            <button class="btn btn-danger btn-sm deleteButton" data-toggle="modal" data-target="#deleteProjectModal" data-id="${project.ID_Projeto}">Excluir</button>
                        </td>
                    `;
                    projectTableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Erro ao carregar projetos:', error));
    }

    // Carregar os projetos ao carregar a página
    loadProjects();

    // Adicionar evento de clique para botão de adicionar projeto
    document.getElementById('addProjectForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('Projeto/add_project.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#addProjectModal').modal('hide');
                location.reload(); // Recarregar a página após adição bem-sucedida
            } else {
                console.error('Erro ao adicionar projeto:', data.message);
            }
        })
        .catch(error => console.error('Erro ao adicionar projeto:', error));
    });

    // Adicionar evento de clique para botões de excluir projeto
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('deleteButton')) {
            const projectId = event.target.getAttribute('data-id');
            if (confirm("Tem certeza de que deseja excluir este projeto?")) {
                fetch(`Projeto/delete_project.php?id=${projectId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarregar a página após exclusão bem-sucedida
                    } else {
                        console.error('Erro ao excluir projeto:', data.message);
                    }
                })
                .catch(error => console.error('Erro ao excluir projeto:', error));
            }
        }
    });

    // Adicionar evento de submissão para formulário de edição de projeto
    document.getElementById('editProjectForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('Projeto/edit_project.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#editProjectModal').modal('hide');
                location.reload(); // Recarregar a página após edição bem-sucedida
            } else {
                console.error('Erro ao editar projeto:', data.message);
            }
        })
        .catch(error => console.error('Erro ao editar projeto:', error));
    });
});
