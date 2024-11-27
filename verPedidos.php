<?php
include("headerAdm.php");
// Conexão com o banco de dados
include("conexao.php");

// Atualizar status do pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido_id'], $_POST['status'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $novo_status = $conn->real_escape_string($_POST['status']);

    $stmt = $conn->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $novo_status, $pedido_id);
    $stmt->execute();
    $stmt->close();
}

// Obter pedidos e seus itens
$sql = "
    SELECT 
        pedidos.id AS pedido_id,
        pedidos.data_pedido,
        pedidos.total,
        pedidos.status,
        usuarios.nome,
        usuarios.sobrenome,
        usuarios.endereco,
        itens_pedido.quantidade,
        itens_pedido.preco_unitario,
        produto.nome AS produto_nome
    FROM 
        pedidos
    JOIN 
        usuarios ON pedidos.cliente_id = usuarios.id
    JOIN 
        itens_pedido ON pedidos.id = itens_pedido.pedido_id
    JOIN 
        produto ON itens_pedido.produto_id = produto.id
    ORDER BY 
        pedidos.data_pedido DESC
";

$result = $conn->query($sql);
$pedidos = [];

while ($row = $result->fetch_assoc()) {
    $pedidos[$row['pedido_id']]['info'] = [
        'data_pedido' => $row['data_pedido'],
        'total' => $row['total'],
        'status' => $row['status'],
        'nome' => $row['nome'],
        'sobrenome' => $row['sobrenome'],
        'endereco' => $row['endereco']
    ];
    $pedidos[$row['pedido_id']]['itens'][] = [
        'produto_nome' => $row['produto_nome'],
        'quantidade' => $row['quantidade'],
        'preco_unitario' => $row['preco_unitario']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .main {
        height: 100vh;
        padding: 20px;
    }

    .container {
        overflow-y: scroll;
        scrollbar-width: none;
        -ms-overflow-style: none;
        background-color: #FFF;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="main">

        <div class="container mt-5">
            <h1 class="mb-4">Pedidos</h1>

            <?php foreach ($pedidos as $pedido_id => $pedido): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Pedido ID:</strong> <?= $pedido_id ?> |
                        <strong>Cliente:</strong> <?= $pedido['info']['nome'] . ' ' . $pedido['info']['sobrenome'] ?> |
                        <strong>Endereço:</strong> <?= $pedido['info']['endereco'] ?> |
                        <strong>Total:</strong> R$ <?= number_format($pedido['info']['total'], 2, ',', '.') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Itens do Pedido:</h5>
                        <ul class="list-group">
                            <?php foreach ($pedido['itens'] as $item): ?>
                                <li class="list-group-item">
                                    <?= $item['produto_nome'] ?> - <?= $item['quantidade'] ?>x -
                                    R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form method="POST" class="form-inline">
                            <input type="hidden" name="pedido_id" value="<?= $pedido_id ?>">
                            <select name="status" class="form-control mr-2">
                                <option value="Pendente" <?= $pedido['info']['status'] == 'Pendente' ? 'selected' : '' ?>>
                                    Pendente
                                </option>
                                <option value="Em entrega" <?= $pedido['info']['status'] == 'Em entrega' ? 'selected' : '' ?>>
                                    Em
                                    entrega</option>
                                <option value="Concluído" <?= $pedido['info']['status'] == 'Concluído' ? 'selected' : '' ?>>
                                    Concluído</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Atualizar Status</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>