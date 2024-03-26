<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionais podem ser colocados aqui */
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gerenciador de Tarefas</h1>
        
        <!-- Botão para adicionar tarefa -->
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addTaskModal">Adicionar Tarefa</button>

        <!-- Container para exibir as tarefas -->
        <div class="row" id="taskCardContainer">
            <!-- Cards de tarefa serão inseridos aqui via JavaScript -->
        </div>

       <!-- Modal de Adicionar Tarefa -->
       <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Adicionar Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário para adicionar tarefa -->
                    <form id="addTaskForm">
                    <!-- Campo para nome da tarefa -->
                    <div class="form-group">
                        <label for="taskName">Nome da Tarefa</label>
                        <input type="text" class="form-control" id="taskName" name="taskName" required>
                    </div>
                    <!-- Campo para projeto da tarefa -->
                    <div class="form-group">
                        <label for="project">Projeto</label>
                        <select class="form-control" id="project" name="project" required>
                        <!-- Opções de projetos carregadas dinamicamente via JavaScript -->
                        </select>
                    </div>
                    <!-- Campo para responsável pela tarefa -->
                    <div class="form-group">
                        <label for="responsible">Responsável</label>
                        <select class="form-control" id="responsible" name="responsible" required>
                        <!-- Opções de responsáveis carregadas dinamicamente via JavaScript -->
                        </select>
                    </div>
                    <!-- Outros campos adicionais, como data de início, data de fim, status, observações, etc. -->
                    <div class="form-group">
                        <label for="taskStartDate">Data de Início</label>
                        <input type="date" class="form-control" id="taskStartDate" name="taskStartDate" required>
                    </div>
                    <div class="form-group">
                        <label for="taskEndDate">Data de Término</label>
                        <input type="date" class="form-control" id="taskEndDate" name="taskEndDate">
                    </div>
                    <div class="form-group">
                        <label for="taskStatus">Status</label>
                        <select class="form-control" id="taskStatus" name="taskStatus" required>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Atrasada">Atrasada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Descrição/Observações</label>
                        <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3"></textarea>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="addTaskForm" class="btn btn-primary">Adicionar Tarefa</button>
                </div>
                </div>
            </div>
        </div>



        <!-- Modal para editar tarefa -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário para editar tarefa -->
                    <form id="editTaskForm">
                    <!-- Campo para nome da tarefa -->
                    <div class="form-group">
                        <label for="editTaskName">Nome da Tarefa</label>
                        <input type="text" class="form-control" id="editTaskName" name="editTaskName" required>
                    </div>
                    <!-- Campo para projeto da tarefa -->
                    <div class="form-group">
                        <label for="editTaskProject">Projeto</label>
                        <select class="form-control" id="editTaskProject" name="editTaskProject" required>
                        <!-- Opções de projetos carregadas dinamicamente via JavaScript -->
                        </select>
                    </div>
                    <!-- Campo para responsável pela tarefa -->
                    <div class="form-group">
                        <label for="editTaskResponsible">Responsável</label>
                        <select class="form-control" id="editTaskResponsible" name="editTaskResponsible" required>
                        <!-- Opções de responsáveis carregadas dinamicamente via JavaScript -->
                        </select>
                    </div>
                    <!-- Outros campos adicionais, como data de início, data de fim, status, observações, etc. -->
                    <div class="form-group">
                        <label for="editTaskStartDate">Data de Início</label>
                        <input type="date" class="form-control" id="editTaskStartDate" name="editTaskStartDate" required>
                    </div>
                    <div class="form-group">
                        <label for="editTaskEndDate">Data de Término</label>
                        <input type="date" class="form-control" id="editTaskEndDate" name="editTaskEndDate">
                    </div>
                    <div class="form-group">
                        <label for="editTaskStatus">Status</label>
                        <select class="form-control" id="editTaskStatus" name="editTaskStatus" required>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Atrasada">Atrasada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTaskDescription">Descrição/Observações</label>
                        <textarea class="form-control" id="editTaskDescription" name="editTaskDescription" rows="3"></textarea>
                    </div>
                    <!-- Campo oculto para armazenar o ID da tarefa -->
                    <input type="hidden" id="editTaskId" name="editTaskId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="editTaskForm" class="btn btn-primary">Salvar Alterações</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal para excluir tarefa -->
        <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteProjectModalLabel">Excluir Projeto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza de que deseja excluir este projeto?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteProject">Excluir</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Tarefa/Tarefa.js"></script>
</body>
</html>
