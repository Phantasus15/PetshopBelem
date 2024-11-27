<?php
session_start();

// Inicializa o carrinho, caso ainda não exista.
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Pega os dados do produto via GET (ou POST).
$id = intval($_GET['id']);
$nome = $_GET['nome'];
$preco = floatval($_GET['preco']);
$quantidade = isset($_GET['quantidade']) ? intval($_GET['quantidade']) : 1;


// Verifica se o produto já está no carrinho.
$existe = false;
foreach ($_SESSION['carrinho'] as &$item) {
    if ($item['id'] === $id) {
        $item['quantidade'] += $quantidade; // Aumenta a quantidade.
        $existe = true;
        break;
    }
}

// Adiciona o produto ao carrinho, se ele ainda não estiver lá.
if (!$existe) {
    $_SESSION['carrinho'][] = [
        'id' => $id,
        'nome' => $nome,
        'preco' => $preco,
        'quantidade' => $quantidade,
        
    ];
}

// Redireciona para a página do carrinho.
header("Location: carrinho.php");
exit;
?>