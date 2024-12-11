<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $animal = $_POST['animal'];
    $img = $_POST['imagem'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];

    // Validação básica
    if (empty($nome) || empty($preco) || empty($categoria) || empty($animal) || empty($quantidade)) {
        echo "<script>alert('Preencha todos os campos obrigatórios.'); history.back();</script>";
        exit;
    }

    // Atualizar os dados no banco de dados
    $sql = "UPDATE produto 
            SET nome = ?, preco = ?, categoria = ?, animal = ?, img = ?, descricao = ?, quantidade = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssssii", $nome, $preco, $categoria, $animal, $img, $descricao, $quantidade, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Produto atualizado com sucesso!'); window.location.href = '../adminIndex.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar o produto: " . $conn->error . "'); history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
