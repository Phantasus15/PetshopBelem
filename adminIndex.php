<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<?php
include("headerAdm.php");
?>
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
        /* Altura máxima da área rolável */
        overflow-y: auto;
     
        scrollbar-width: none; 
        -ms-overflow-style: none;
      
    }

    .itens::-webkit-scrollbar {
        width: 8px;
        /* Largura da barra de rolagem no Webkit */
    }

    .itens::-webkit-scrollbar-thumb {
        background-color: #ccc;
        /* Cor da barra */
        border-radius: 4px;
        /* Bordas arredondadas */
    }

    .itens::-webkit-scrollbar-thumb:hover {
        background-color: #aaa;
        /* Cor ao passar o mouse */
    }

    .cards {
        background-color: #F9E3BECC;
        padding: 10px;
        margin: 15px;
        border-radius: 12px;
        height: 500px;
        width: 300px;
        text-align: center;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        flex-grow: 1;
    }
</style>


<body>
    <div class="main">
        <div class="container">
            <!-- Botão para adicionar novo produto -->
            <button class="btn btn-primary mb-3" onclick="window.location.href='adicionarProduto.php'">
                Adicionar produto
            </button>

            <!-- Campo de busca -->
            <form method="GET" action="adminIndex.php" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="busca" placeholder="Digite o nome do produto"
                        value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
                </div>
            </form>

            <div class="itens">

                <div class="row g-2">
                    <?php
                    // Filtro de busca
                    $busca = isset($_GET['busca']) ? "%" . $conn->real_escape_string($_GET['busca']) . "%" : "%";

                    // Consulta SQL com filtro
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
                            echo '      <img src="' . $row["img"] . '" alt="Descrição da imagem" width="100%" height="350" />';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . $row["nome"] . '</h5>';
                            echo '            <h6 class="card-subtitle mb-2 text-muted">Preço: R$ ' . number_format($row["preco"], 2, ',', '.') . '</h6>';
                            echo '            <h6 class="card-subtitle mb-2 text-muted">Quantidade: ' . $row["quantidade"] . '</h6>';
                            echo '        </div>';
                            echo '        <div class=" text-center">';
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
</body>

<script>
    function confirmarDelecao(id) {
        if (confirm("Tem certeza de que deseja excluir este produto?")) {
            window.location.href = "logicaSistema/logicaDeletarProduto.php?id=" + id;
        }
    }
</script>

<?php
include("footer.php");
?>

</html>