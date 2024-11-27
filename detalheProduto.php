<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<style>
    .main {
        height: 100vh;
    }

    .container {
        overflow-y: scroll;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    /* Estilo para o card */
    .cards {
        background-color: #F9E3BECC;
        padding: 20px;
        margin: 15px auto;
        border-radius: 12px;
        height: auto;
        width: 300px;
        text-align: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efeito ao passar o mouse */
    .foto {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    /* Título do produto */
    .cards h1 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    /* Descrição e preço */
    .cards p {
        font-size: 1rem;
        color: #555;
    }

    /* Botão de adicionar ao carrinho */
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        margin-top: 15px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-disabled {
        background-color: #cccccc;
        border: none;
        cursor: not-allowed;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .cards {
            width: 100%;
        }

        .foto {
            height: 150px;
        }
    }
</style>

<?php
include("header.php");
include("conexao.php");
?>

<body>
    <div class="main">
        <div class="container mt-5">
            <?php
            include("conexao.php");

            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

            if ($id > 0) {
                // Consulta para obter o produto e sua quantidade
                $stmt = $conn->prepare("SELECT * FROM produto WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $produto = $result->fetch_assoc();

                    // Verifica a quantidade do produto
                    $quantidade = $produto['quantidade'];

                    echo '<div class="cards">';
                    echo "    <h1>" . htmlspecialchars($produto['nome']) . "</h1>";
                    echo "    <img class='foto' src='" . htmlspecialchars($produto['img']) . "' alt='Imagem do produto'>";
                    echo "    <p><strong>Descrição:</strong> " . htmlspecialchars($produto['descricao']) . "</p>";
                    echo "    <p><strong>Preço:</strong> R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";

                    // Se a quantidade for zero, desativa o botão e exibe uma mensagem
                    if ($quantidade == 0) {
                        echo "<p class='text-danger'>Produto indisponível.</p>";
                        echo "<button class='btn btn-disabled' disabled>Adicionar ao Carrinho</button>";
                    } else {
                        echo "<a href='adicionarCarrinho.php?id=" . $produto['id'] . "&nome=" . urlencode($produto['nome']) . "&preco=" . $produto['preco'] ."' class='btn btn-primary'>Adicionar ao Carrinho</a>";
                    }

                    echo '</div>';
                } else {
                    echo "<p class='text-center'>Produto não encontrado.</p>";
                }

                $stmt->close();
            } else {
                echo "<p class='text-center'>ID inválido.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

<?php
include("footer.php");
?>

</html>
