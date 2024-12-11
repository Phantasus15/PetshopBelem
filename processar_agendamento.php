<?php 
include("conexao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $raca = mysqli_real_escape_string($conn, $_POST['raca']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);
    $hora = mysqli_real_escape_string($conn, $_POST['horario']);
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

        // Verifica se o horário já está agendado
        $queryCheck = "SELECT * FROM agendamentos WHERE data = '$data' AND hora = '$hora'";
        $result = mysqli_query($conn, $queryCheck);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                    alert('Horário indisponível. Por favor, escolha outro.');
                    window.history.back();
                  </script>";
            exit();
        }

        // Insere os dados no banco de dados
        $query = "INSERT INTO agendamentos (usuario_id, nome, raca, telefone, data, hora, mensagem)
                  VALUES ('$usuario_id', '$nome', '$raca', '$telefone', '$data', '$hora', '$mensagem')";

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
