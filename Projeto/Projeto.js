document.addEventListener('DOMContentLoaded', function () {
    // Função para carregar os projetos
    function loadProjects() {
        fetch('Projeto/get_projects.php')
            .then(response => response.json())
            .then(data => {
                const projectTableBody = document.getElementById('projectTableBody');
                projectTableBody.innerHTML = '';

                data.forEach(project => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${project.ID_Projeto}</td>
                        <td>${project.Nome_Projeto}</td>
                        <td>${project.Data_inicio_Projeto}</td>
                        <td>${project.Data_Fim_Projeto}</td>
                        <td>${project.Status_Projeto}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: ${calculateProjectProgress(project.CompletedTasks, project.TotalTasks)}%;" aria-valuenow="${calculateProjectProgress(project.CompletedTasks, project.TotalTasks)}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm mr-2 editButton" data-toggle="modal" data-target="#editProjectModal" data-id="${project.ID_Projeto}">Editar</button>
                            <button class="btn btn-danger btn-sm deleteButton" data-toggle="modal" data-target="#deleteProjectModal" data-id="${project.ID_Projeto}">Excluir</button>
                        </td>
                    `;
                    projectTableBody.appendChild(row);
                });

                // Adicionar evento de clique para botões de editar projeto
                document.querySelectorAll('.editButton').forEach(button => {
                    button.addEventListener('click', function () {
                        const projectId = this.getAttribute('data-id');
                        fetch(`Projeto/get_project.php?id=${projectId}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('editProjectId').value = data.ID_Projeto;
                                document.getElementById('editProjectName').value = data.Nome_Projeto;
                                document.getElementById('editProjectType').value = data.Tipo_Projeto;
                                document.getElementById('editProjectStartDate').value = data.Data_inicio_Projeto;
                                document.getElementById('editProjectEndDate').value = data.Data_Fim_Projeto;
                                document.getElementById('editProjectStatus').value = data.Status_Projeto;
                                document.getElementById('editProjectSummary').value = data.Resumo_Projeto;
                                document.getElementById('editProjectRisks').value = data.Riscos_Projeto;
                                document.getElementById('editProjectBudget').value = data.Orcamento_Projeto;
                                document.getElementById('editProjectResources').value = data.Recursos_Projeto;
                            })
                            .catch(error => console.error('Erro ao buscar dados do projeto para edição:', error));
                    });
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

});

// Função para calcular a porcentagem do projeto
function calculateProjectProgress(completedTasks, totalTasks) {
    if (totalTasks === 0) {
        return 0;
    }
    return Math.round((completedTasks / totalTasks) * 100);
}
