<?php
include("./conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        die("Usuário não encontrado.");
    }
} else {
    die("ID de usuário não informado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $situacao = intval($_POST['situacao']);

    $query = "UPDATE usuario SET nome = ?, email = ?, situacao = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $nome, $email, $situacao, $id);

    if ($stmt->execute()) {
        header("Location: listaUsuario.php?msg=Usuario+atualizado+com+sucesso");
        exit;
    } else {
        echo "Erro ao atualizar usuário: " . $conn->error;
    }
}
?>