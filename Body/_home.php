<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-E9SdSYBnuEQdGsXDjArJnRZVomhy5cCqy4Qr6qxrBX0d2PmAYjAs1gW0N1Zuex3Zus5xuIUgyKvPOi+2o9l1Vg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .info-box {
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-box i {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 20px;
            display: block;
            text-align: center;
        }

        .info-box h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .info-box p {
            font-size: 16px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Bem-vindo ao Sistema de Gerenciamento</h1>
        <div class="info-box">
            <i class="fas fa-chart-bar"></i>
            <h2>Dashboard</h2>
            <p>Acompanhe o desempenho do seu projeto com estatísticas detalhadas.</p>
        </div>
        <div class="info-box">
            <i class="fas fa-users"></i>
            <h2>Equipe</h2>
            <p>Gerencie sua equipe de colaboradores e atribua tarefas de forma eficiente.</p>
        </div>
        <div class="info-box">
            <i class="fas fa-tasks"></i>
            <h2>Tarefas</h2>
            <p>Organize e acompanhe o progresso das tarefas do seu projeto.</p>
        </div>
        <div class="info-box">
            <i class="fas fa-calendar-alt"></i>
            <h2>Calendário</h2>
            <p>Agende eventos importantes e mantenha-se atualizado com o calendário integrado.</p>
        </div>
    </div>
</body>
</html>
