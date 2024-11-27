<?php
session_start();

// Verifica se a sessão está ativa
if (session_status() === PHP_SESSION_ACTIVE) {
    // Limpa os dados da sessão
    session_unset();

    // Destroi a sessão
    session_destroy();
}

// Redireciona para a página de login ou página inicial
header("Location: ../login.php");
exit();
?>