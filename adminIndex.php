<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<!--Alerta para sucesso de alteração de quantidade-->
<?php if (isset($_GET['msg'])): ?>
    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Aviso:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= htmlspecialchars($_GET['msg']) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Exibe o modal automaticamente ao carregar a página
        document.addEventListener('DOMContentLoaded', function () {
            $('#feedbackModal').modal('show');
        });
    </script>
<?php endif; ?>



<?php include("headerAdm.php"); ?>

<style>
    .main {
        height: 100vh;
        padding: 20px;
        background-image: url("./assets/fundo.jfif");
        overflow: hidden;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .itens {
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .itens::-webkit-scrollbar {
        width: 8px;
    }

    .itens::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }

    .cards {
        background-color: #F9E3BECC;
        padding: 10px;
        margin: 15px;
        border-radius: 12px;
        height: 500px;
        width: 300px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<body>
    <div class="main">
        <div class="container">
            <button class="btn btn-primary mb-3" onclick="window.location.href='adicionarProduto.php'">
                Adicionar produto
            </button>

            <form method="GET" action="adminIndex.php" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="busca" placeholder="Digite o nome do produto"
                        value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
                </div>
            </form>

            <div class="itens">
                <div class="row g-2">
                    <?php
                    $busca = isset($_GET['busca']) ? "%" . $conn->real_escape_string($_GET['busca']) . "%" : "%";

                    $sql = "SELECT * FROM produto WHERE nome LIKE ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $busca);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result === false) {
                        die("Erro na consulta SQL: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-4">';
echo '    <div class="cards">';
echo '        <img src="' . htmlspecialchars($row["img"]) . '" alt="Descrição da imagem" width="100%" height="350" />';
echo '        <div class="card-body">';
echo '            <h5 class="card-title">' . htmlspecialchars($row["nome"]) . '</h5>';
echo '            <h6 class="card-subtitle mb-2 text-muted">Preço: R$ ' . number_format($row["preco"], 2, ',', '.') . '</h6>';
echo '            <h6 class="card-subtitle mb-2 text-muted">Quantidade: ' . number_format($row["quantidade"], 2, ',', '.') . '</h6>';

// Adicionando o contador
echo '            <div class="quantity-counter">';
echo '                <button class="btn btn-outline-secondary decrement" data-id="' . $row["id"] . '">-</button>';
echo '                <span id="quantity-' . $row["id"] . '" class="quantity">' . $row["quantidade"] . '</span>';
echo '                <button class="btn btn-outline-secondary increment" data-id="' . $row["id"] . '">+</button>';
echo '            </div>';

// Formulário escondido para envio do valor
echo '            <form method="POST" action="logicaSistema/atualizarQuantidade.php" class="mt-2">';
echo '                <input type="hidden" name="produto_id" value="' . $row["id"] . '">';
echo '                <input type="hidden" name="quantidade" id="input-quantity-' . $row["id"] . '" value="' . $row["quantidade"] . '">';
echo '                <button type="submit" class="btn btn-success mt-2">Atualizar</button>';
echo '            </form>';

echo '        </div>';
echo '        <div class="text-center">';
echo '            <button class="btn btn-warning mt-2" onclick="window.location.href=\'editarProduto.php?id=' . $row["id"] . '\'">Editar</button>';
echo '            <button class="btn btn-danger mt-2" onclick="confirmarDelecao(' . $row["id"] . ')">Deletar</button>';
echo '        </div>';
echo '    </div>';
echo '</div>';

                        }
                    } else {
                        echo "<p>Nenhum produto encontrado.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>//JavaScript para funcionamento do contador
    document.addEventListener("DOMContentLoaded", function () {
        const updateQuantityInForm = (id, newQuantity) => {
            const inputField = document.getElementById(`input-quantity-${id}`);
            inputField.value = newQuantity;
        };

        const updateQuantity = (id, delta) => {
            const quantitySpan = document.getElementById(`quantity-${id}`);
            let currentQuantity = parseInt(quantitySpan.innerText);
            const newQuantity = currentQuantity + delta;

            if (newQuantity >= 0) {
                quantitySpan.innerText = newQuantity;
                updateQuantityInForm(id, newQuantity);
            }
        };

        document.querySelectorAll(".increment").forEach(button => {
            button.addEventListener("click", () => {
                const id = button.getAttribute("data-id");
                updateQuantity(id, 1);
            });
        });

        document.querySelectorAll(".decrement").forEach(button => {
            button.addEventListener("click", () => {
                const id = button.getAttribute("data-id");
                updateQuantity(id, -1);
            });
        });
    });
//fim contador</script>

</body>

<script>
    function confirmarDelecao(id) {
        if (confirm("Tem certeza de que deseja excluir este produto?")) {
            window.location.href = "logicaSistema/logicaDeletarProduto.php?id=" + id;
        }
    }
</script>

<?php include("footer.php"); ?>

</html>
