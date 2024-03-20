<?php
session_start();
// Verificar se o usuário está logado
if(!isset($_SESSION['id_usuario'])) {
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
}

// Conectar ao banco de dados e obter os dados do usuário
require_once "../conexao.php"; // Arquivo de conexão com o banco de dados
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM Usuario WHERE id_usuario = $id_usuario";
$resultado = $conn->query($sql);
if($resultado->num_rows > 0) {
    $dados_usuario = $resultado->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="../img/logo.png">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar Perfil</div>
                <div class="card-body">
                    <form action="editar_perfil_backend.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $dados_usuario['nome_usuario']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome:</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $dados_usuario['sobrenome_usuario']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $dados_usuario['email_usuario']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $dados_usuario['telefone_usuario']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                            <img src="<?php echo $dados_usuario['foto_usuario']; ?>" alt="Imagem do Usuário" class="mt-2" width="100">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
