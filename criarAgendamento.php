<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Formulário de Agendamento</h2>
        <form action="processar_agendamento.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nome">Raça</label>
                <input type="text" id="raca" name="raca" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="telefone" id="telefone" name="telefone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="horario">Horário</label>
                <input type="time" id="horario" name="horario" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="detalhes">Detalhes do Agendamento</label>
                <textarea id="detalhes" name="detalhes" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>
    </div>
</body>
<?php
include("footer.php");
?>
</html>
