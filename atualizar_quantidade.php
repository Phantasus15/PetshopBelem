<?php
session_start();
if (isset($_POST['indice']) && isset($_POST['acao']) && isset($_SESSION['carrinho'][$_POST['indice']])) {
    $indice = $_POST['indice'];
    $acao = $_POST['acao'];

    if ($acao == 'aumentar') {
        $_SESSION['carrinho'][$indice]['quantidade']++;
    } elseif ($acao == 'diminuir' && $_SESSION['carrinho'][$indice]['quantidade'] > 1) {
        $_SESSION['carrinho'][$indice]['quantidade']--;
    }
}
header("Location: carrinho.php");
exit;
?>
