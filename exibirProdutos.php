<?php
// Conectar ao banco de dados (configure de acordo com o seu banco)
$conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar todos os produtos
$sql = "SELECT codigo, descricao, valor, marca, estoque, categoria FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="path/to/logo.png" alt="Logo do Pet Shop">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="#">Pedidos</a></li>
            <li><a href="#">Agendamento</a></li>
            <li><a href="#">Estoque</a></li>
            <li><a href="#">Histórico</a></li>
            <li><a href="#">Relatório</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h1>Produtos Disponíveis</h1>
    <div class="produtos-lista">
        <?php
        if ($result->num_rows > 0) {
            // Exibe os produtos em forma de cards
            while($row = $result->fetch_assoc()) {
                echo '<div class="produto-card">';
                echo '<img src="path/to/product_image.jpg" alt="Imagem do Produto">';
                echo '<h2>' . htmlspecialchars($row["descricao"]) . '</h2>';
                echo '<p>Categoria: ' . htmlspecialchars($row["categoria"]) . '</p>';
                echo '<p>Marca: ' . htmlspecialchars($row["marca"]) . '</p>';
                echo '<p>Preço: R$' . number_format($row["valor"], 2, ',', '.') . '</p>';
                echo '<p>Estoque: ' . htmlspecialchars($row["estoque"]) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum produto cadastrado.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
