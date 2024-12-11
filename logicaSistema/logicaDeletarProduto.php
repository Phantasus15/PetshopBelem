<?php

include("../conexao.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID do produto não fornecido.");
}

// Obtém o ID do produto a ser deletado
$id = intval($_GET['id']);

// Cria a consulta para deletar o produto
$sql = "DELETE FROM produto WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Executa a consulta e verifica se houve sucesso
if ($stmt->execute()) {
    // Redireciona para a página principal com mensagem de sucesso
    header("Location: ../adminIndex.php?mensagem=Produto deletado com sucesso.");
    exit;
} else {
    // Exibe erro caso a exclusão falhe
    die("Erro ao deletar produto: " . $stmt->error);
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
