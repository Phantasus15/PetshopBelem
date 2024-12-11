<?php
session_start();

if (isset($_GET['id'])) {
    $indice = intval($_GET['id']);

    if (isset($_SESSION['carrinho'][$indice])) {
        unset($_SESSION['carrinho'][$indice]); // Remove o item.
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reorganiza o array.
    }
}

header("Location: carrinho.php");
exit;
?>