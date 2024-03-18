<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <h2 id="month-year"></h2>
            <div class="navigation-buttons">
                <button class="navigation-btn" onclick="previousMonth()">&#10094;</button>
                <button class="navigation-btn" onclick="nextMonth()">&#10095;</button>
            </div>
        </div>
        <div class="weekdays">
            <div>Domingo</div>
            <div>Segunda</div>
            <div>Terça</div>
            <div>Quarta</div>
            <div>Quinta</div>
            <div>Sexta</div>
            <div>Sábado</div>
        </div>
        <div class="calendar-body" id="days-container"></div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>