<?php
include("../conexao.php"); // Caminho ajustado para incluir o arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = intval($_POST['produto_id']);
    $quantidade = intval($_POST['quantidade']);

    if ($quantidade >= 0) {
        $stmt = $conn->prepare("UPDATE produto SET quantidade = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $produto_id);

        if ($stmt->execute()) {
            header("Location: ../adminIndex.php?msg=Quantidade atualizada com sucesso");
        } else {
            header("Location: ../adminIndex.php?msg=Erro ao atualizar quantidade");
        }

        $stmt->close();
    } else {
        header("Location: ../adminIndex.php?msg=Quantidade inválida");
    }

    $conn->close();
}
