<?php
include("../conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o agendamento
    $sql = "DELETE FROM agendamentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Agendamento excluído com sucesso!'); window.location.href='../acompanharAgendamento.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o agendamento.'); window.location.href='../acompanharAgendamento.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
    