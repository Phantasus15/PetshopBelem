<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Alterar o status do agendamento
    $sql = "UPDATE agendamentos SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Status alterado com sucesso!'); window.location.href='../acompanharAgendamento.php';</script>";
    } else {
        echo "<script>alert('Erro ao alterar o status.'); window.location.href='../acompanharAgendamento.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
