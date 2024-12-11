<?php 
include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    .container {
        background-color: aliceblue;
        overflow-y: scroll;
        scrollbar-width: none;
        -ms-overflow-style: none;
        background-color: #FFF;
    }
</style>

<body>
    <div class="main">
        <div class="container mt-5">
            <?php
            include("conexao.php");

            // Verifique se o usuário está autenticado (cliente_id na sessão)
            if (!isset($_SESSION['usuario_id'])) {
                echo "<div class='alert alert-danger'>Você precisa estar logado para ver seus pedidos.</div>";
                exit;
            }

            $cliente_id = $_SESSION['usuario_id'];

            // Buscar os pedidos realizados pelo cliente, incluindo o status
            $query = "SELECT 
                        p.id AS pedido_id, 
                        p.total, 
                        p.data_pedido, 
                        p.status, 
                        u.nome AS nome_cliente 
                      FROM pedidos p 
                      JOIN usuarios u ON p.cliente_id = u.id 
                      WHERE p.cliente_id = ?";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $cliente_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>Meus Pedidos</h2>";

                while ($row = $result->fetch_assoc()) {
                    $pedido_id = $row['pedido_id'];

                    // Exibir informações básicas do pedido, incluindo o status
                    echo "<div class='card mb-3'>
        <div class='card-header'>
        <strong>Pedido ID:</strong> {$row['pedido_id']} | 
        <strong>Cliente:</strong> {$row['nome_cliente']} | 
        <strong>Total:</strong> R$ " . number_format($row['total'], 2, ',', '.') . " | 
        <strong>Data:</strong> {$row['data_pedido']} | 
        <strong>Status:</strong> {$row['status']}
        </div>
        <div class='card-body'>
        <h5>Itens do Pedido:</h5>";

                    // Buscar itens do pedido
                    $query_itens = "SELECT 
                                        i.produto_id, 
                                        i.quantidade, 
                                        i.preco_unitario, 
                                        pr.nome AS nome_produto 
                                    FROM itens_pedido i 
                                    JOIN produto pr ON i.produto_id = pr.id 
                                    WHERE i.pedido_id = ?";
                    $stmt_itens = $conn->prepare($query_itens);
                    $stmt_itens->bind_param("i", $pedido_id);
                    $stmt_itens->execute();
                    $result_itens = $stmt_itens->get_result();

                    if ($result_itens->num_rows > 0) {
                        echo "<table class='table table-bordered'>
                    <thead>
                    <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>";

                        while ($item = $result_itens->fetch_assoc()) {
                            $total_item = $item['quantidade'] * $item['preco_unitario'];
                            echo "<tr>
                        <td>{$item['nome_produto']}</td>
                        <td>{$item['quantidade']}</td>
                        <td>R$ " . number_format($item['preco_unitario'], 2, ',', '.') . "</td>
                        <td>R$ " . number_format($total_item, 2, ',', '.') . "</td>
                        </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<p>Não há itens neste pedido.</p>";
                    }

                    $stmt_itens->close();
                    echo "</div></div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Você ainda não fez nenhum pedido.</div>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>
