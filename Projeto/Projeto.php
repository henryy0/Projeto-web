<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Projetos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gerenciador de Projetos</h1>
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addProjectModal">Adicionar Projeto</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Projeto</th>
                    <th>Data de Início</th>
                    <th>Data de Término</th>
                    <th>Status</th>
                    <th>Progresso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="projectTableBody">
                <!-- Conteúdo será preenchido por JavaScript -->
            </tbody>
        </table>


   <!-- Modal para adicionar projeto -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Adicionar Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProjectForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addProjectName">Nome do Projeto</label>
                            <input type="text" class="form-control" id="addProjectName" name="addProjectName" required>
                        </div>
                        <div class="form-group">
                            <label for="addProjectType">Tipo do Projeto</label>
                            <input type="text" class="form-control" id="addProjectType" name="addProjectType" required>
                        </div>
                        <div class="form-group">
                            <label for="addProjectStartDate">Data de Início</label>
                            <input type="date" class="form-control" id="addProjectStartDate" name="addProjectStartDate" required>
                        </div>
                        <div class="form-group">
                            <label for="addProjectEndDate">Data de Término</label>
                            <input type="date" class="form-control" id="addProjectEndDate" name="addProjectEndDate">
                        </div>
                        <div class="form-group">
                            <label for="addProjectStatus">Status do Projeto</label>
                            <select class="form-control" id="addProjectStatus" name="addProjectStatus" required>
                                <option value="Em andamento">Em andamento</option>
                                <option value="Concluído">Concluído</option>
                                <option value="Pausado">Pausado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="addProjectSummary">Resumo do Projeto</label>
                            <textarea class="form-control" id="addProjectSummary" name="addProjectSummary" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addProjectRisks">Riscos do Projeto</label>
                            <textarea class="form-control" id="addProjectRisks" name="addProjectRisks" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addProjectBudget">Orçamento do Projeto</label>
                            <input type="number" class="form-control" id="addProjectBudget" name="addProjectBudget" required>
                        </div>
                        <div class="form-group">
                            <label for="addProjectResources">Recursos do Projeto</label>
                            <input type="text" class="form-control" id="addProjectResources" name="addProjectResources" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar Projeto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar projeto -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Editar Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editProjectForm">
                    <div class="modal-body">
                        <input type="hidden" id="editProjectId" name="editProjectId">
                        <div class="form-group">
                            <label for="editProjectName">Nome do Projeto</label>
                            <input type="text" class="form-control" id="editProjectName" name="editProjectName" required>
                        </div>
                        <div class="form-group">
                            <label for="editProjectType">Tipo do Projeto</label>
                            <input type="text" class="form-control" id="editProjectType" name="editProjectType" required>
                        </div>
                        <div class="form-group">
                            <label for="editProjectStartDate">Data de Início</label>
                            <input type="date" class="form-control" id="editProjectStartDate" name="editProjectStartDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editProjectEndDate">Data de Término</label>
                            <input type="date" class="form-control" id="editProjectEndDate" name="editProjectEndDate">
                        </div>
                        <div class="form-group">
                            <label for="editProjectStatus">Status do Projeto</label>
                            <select class="form-control" id="editProjectStatus" name="editProjectStatus" required>
                                <option value="Em andamento">Em andamento</option>
                                <option value="Concluído">Concluído</option>
                                <option value="Pausado">Pausado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editProjectSummary">Resumo do Projeto</label>
                            <textarea class="form-control" id="editProjectSummary" name="editProjectSummary" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editProjectRisks">Riscos do Projeto</label>
                            <textarea class="form-control" id="editProjectRisks" name="editProjectRisks" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editProjectBudget">Orçamento do Projeto</label>
                            <input type="number" class="form-control" id="editProjectBudget" name="editProjectBudget" required>
                        </div>
                        <div class="form-group">
                            <label for="editProjectResources">Recursos do Projeto</label>
                            <input type="text" class="form-control" id="editProjectResources" name="editProjectResources" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Projeto/Projeto.js"></script>
</body>
</html>
