<!DOCTYPE html>
<html lang="en">

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
    .container {
        background-color: aliceblue;
        padding: 20px;
    }

    .container {
        overflow-y: scroll;
        scrollbar-width: none;
        -ms-overflow-style: none;
        background-color: #FFF;
    }
    .main{
        height: 100vh;
    }
</style>

<?php
include("header.php");
include("conexao.php");

$totalGeral = 0;
?>

<body>
    <div class="main">
        <div class="container mt-5">
            <h1>Carrinho de Compras</h1>

            <?php if (!empty($_SESSION['carrinho'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço Unitário</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION['carrinho'] as $indice => $produto):
                            // Buscar a quantidade disponível no banco de dados para esse produto
                            $stmt = $conn->prepare("SELECT quantidade FROM produto WHERE id = ?");
                            $stmt->bind_param("i", $produto['id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $produtoBanco = $result->fetch_assoc();
                            $quantidadeDisponivel = $produtoBanco['quantidade'];  // Quantidade disponível no banco
                            $stmt->close();

                            // Calcular o total do produto
                            $totalProduto = $produto['preco'] * $produto['quantidade'];
                            $totalGeral += $totalProduto;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                                <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                                <td>
                                    <form action="atualizar_quantidade.php" method="POST" class="d-flex">
                                        <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                                        <button type="submit" name="acao" value="diminuir"
                                            class="btn btn-sm btn-outline-secondary">-</button>
                                        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>"
                                            class="form-control form-control-sm text-center mx-1" min="1" max="<?php echo $quantidadeDisponivel - 1; ?>" style="width: 60px;">
                                        <button type="submit" name="acao" value="aumentar"
                                            class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                    <small class="text-muted">Estoque disponível: <?php echo $quantidadeDisponivel; ?> unidades</small>
                                </td>
                                <td>R$ <?php echo number_format($totalProduto, 2, ',', '.'); ?></td>
                                <td>
                                    <a href="remover.php?id=<?php echo $indice; ?>" class="btn btn-danger btn-sm">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Geral:</strong></td>
                            <td colspan="2">R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-right">
                    <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
                </div>
            <?php else: ?>
                <p>Seu carrinho está vazio.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>
