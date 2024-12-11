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
                <label for="raca">Raça</label>
                <input type="text" id="raca" name="raca" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" id="data" name="data" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="horario">Horário</label>
                <select id="horario" name="horario" class="form-control" required>
                    <option value="">Selecione um horário</option>
                    <!-- Horários serão carregados aqui via JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="detalhes">Detalhes do Agendamento</label>
                <textarea id="detalhes" name="detalhes" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Quando o usuário selecionar a data
            $('#data').change(function() {
                var selectedDate = $(this).val(); // Obtém a data selecionada

                // Faz a requisição AJAX para verificar os horários ocupados
                $.ajax({
                    url: 'check_available_times.php', // Arquivo PHP que retorna os horários ocupados
                    method: 'POST',
                    data: { data: selectedDate }, // Passa a data selecionada
                    success: function(response) {
                        var busyTimes = JSON.parse(response); // Converte a resposta JSON em um array

                        // Definir os horários disponíveis
                        var availableTimes = [];
                        var morningTimes = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00'];
                        var afternoonTimes = ['14:00', '15:00', '16:00', '17:00', '18:00'];

                        // Filtra os horários ocupados da manhã
                        morningTimes = morningTimes.filter(function(time) {
                            return !busyTimes.includes(time);
                        });

                        // Filtra os horários ocupados da tarde
                        afternoonTimes = afternoonTimes.filter(function(time) {
                            return !busyTimes.includes(time);
                        });

                        // Combina os horários disponíveis da manhã e da tarde
                        availableTimes = morningTimes.concat(afternoonTimes);

                        // Preenche o select com os horários disponíveis
                        var options = '<option value="">Selecione um horário</option>';
                        availableTimes.forEach(function(time) {
                            options += '<option value="' + time + '">' + time + '</option>';
                        });
                        $('#horario').html(options); // Atualiza o select
                    }
                });
            });
        });
    </script>
</body>
<?php
include("footer.php");
?>
</html>
