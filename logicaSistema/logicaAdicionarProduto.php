<?php
// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
include("../conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $animal = mysqli_real_escape_string($conn, $_POST['animal']);
    $img = mysqli_real_escape_string($conn, $_POST['imagem']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO produto (nome, quantidade, preco, categoria, animal, img, descricao) 
            VALUES ('$nome', '$quantidade', '$preco', '$categoria', '$animal', '$img', '$descricao')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Produto adicionado com sucesso!');
                window.location.href = '../AdminIndex.php'; 
              </script>";
    } else {
        echo "<script>
                alert('Erro ao adicionar o produto: " . $conn->error . "');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Método de requisição inválido.');
            window.history.back();
          </script>";
}

// Fecha a conexão com o banco
$conn->close();
?>
