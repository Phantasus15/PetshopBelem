<?php
include("conexao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $sobrenome = mysqli_real_escape_string($conn, $_POST['sobrenome']);
    $profissional = mysqli_real_escape_string($conn, $_POST['profissional']);
    $raca = mysqli_real_escape_string($conn, $_POST['raca']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);
    $hora = mysqli_real_escape_string($conn, $_POST['horario']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $mensagem = mysqli_real_escape_string($conn, $_POST['detalhes']);

    // Obtém o ID do usuário logado a partir da sessão
    $usuario_id = $_SESSION['usuario_id'] ?? null;

    if ($usuario_id) {
        // Verifica se a data é um final de semana
        $diaSemana = date('w', strtotime($data));
        if ($diaSemana == 0 || $diaSemana == 6) {
            echo "<script>
                    alert('Não é permitido agendar nos finais de semana.');
                    window.history.back();
                  </script>";
            exit();
        }

        // Verifica se o horário está dentro do intervalo permitido
        $horaInicio = strtotime('08:00');
        $horaFim = strtotime('16:00');
        $horaAgendada = strtotime($hora);
        
        if ($horaAgendada < $horaInicio || $horaAgendada > $horaFim) {
            echo "<script>
                    alert('O horário deve ser entre 08:00 e 16:00. Você selecionou: $hora');
                    window.history.back();
                  </script>";
            exit();
        }

        // Insere os dados no banco de dados
        $query = "INSERT INTO agendamentos (usuario_id, nome, sobrenome, profissional, raca, data, hora, telefone, mensagem)
                  VALUES ('$usuario_id', '$nome', '$sobrenome', '$profissional', '$raca', '$data', '$hora', '$telefone', '$mensagem')";

        if (mysqli_query($conn, $query)) {
            // Redireciona para a página agendamento.php
            echo "<script>
                    alert('Agendamento realizado com sucesso!');
                    window.location.href = 'agendamento.php';
                  </script>";
            exit();
        } else {
            echo "Erro ao processar o agendamento: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
                alert('Usuário não identificado. Por favor, faça login novamente.');
                window.location.href = 'login.php';
              </script>";
    }
}
?>
