<?php
include("conexao.php");

// Verifica se a data foi passada pela requisição
if (isset($_POST['data'])) {
    $data = mysqli_real_escape_string($conn, $_POST['data']);

    // Consulta os agendamentos existentes para o dia selecionado
    $query = "SELECT hora FROM agendamentos WHERE data = '$data'";
    $result = mysqli_query($conn, $query);

    $busyTimes = [];

    // Se houver horários já agendados, adiciona-os ao array
    while ($row = mysqli_fetch_assoc($result)) {
        $busyTimes[] = $row['hora'];
    }

    // Retorna os horários ocupados como um array JSON
    echo json_encode($busyTimes);
} else {
    echo json_encode([]);
}
?>
