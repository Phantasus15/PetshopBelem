<?php
session_start();
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    // Validação simples
    if (empty($nome) || empty($sobrenome) || empty($telefone) || empty($endereco) || empty($cidade) || empty($estado) || empty($cep)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    // Obtém o email do usuário logado
    if (!isset($_SESSION['email'])) {
        echo "Usuário não está logado.";
        exit;
    }
    $email = $_SESSION['email'];

    // Começa a transação
    $conn->begin_transaction();

    try {
        // Atualiza os dados do usuário logado
        $stmt = $conn->prepare("
            UPDATE usuarios 
            SET nome = ?, sobrenome = ?, telefone = ?, endereco = ?, cidade = ?, estado = ?, cep = ? 
            WHERE email = ?
        ");
        $stmt->bind_param("ssssssss", $nome, $sobrenome, $telefone, $endereco, $cidade, $estado, $cep, $email);
        $stmt->execute();
        $stmt->close();

        // Obtém o ID do usuário logado
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($cliente_id);
        $stmt->fetch();
        $stmt->close();

        // Cálculo do total do pedido
        $total = 0;
        foreach ($_SESSION['carrinho'] as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        // Inserção do pedido
        $stmt = $conn->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (?, ?)");
        $stmt->bind_param("id", $cliente_id, $total);
        $stmt->execute();
        $pedido_id = $stmt->insert_id;
        $stmt->close();

        // Inserção dos itens do pedido e atualização do estoque
        $stmt = $conn->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
        $updateStockStmt = $conn->prepare("UPDATE produto SET quantidade = quantidade - ? WHERE id = ?");

        foreach ($_SESSION['carrinho'] as $item) {
            $produto_id = $item['id'];
            $quantidade = $item['quantidade'];
            $preco_unitario = $item['preco'];

            // Inserir no itens_pedido
            $stmt->bind_param("iiid", $pedido_id, $produto_id, $quantidade, $preco_unitario);
            $stmt->execute();

            // Atualizar o estoque
            $updateStockStmt->bind_param("ii", $quantidade, $produto_id);
            $updateStockStmt->execute();
        }

        $stmt->close();
        $updateStockStmt->close();

        // Commit da transação
        $conn->commit();

        // Limpar o carrinho
        $_SESSION['carrinho'] = [];

        // Redireciona para a página de confirmação
        header("Location: finalizar_compra_confirmacao.php");
        exit;
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollback();
        echo "Erro: " . $e->getMessage();
        exit;
    }
}
?>
