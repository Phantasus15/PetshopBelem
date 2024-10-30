<?php
session_start();

function funcionarioEstaLogado() {
    if (isset($_SESSION["tipoUsuario"])) {
        return ($_SESSION["tipoUsuario"] == 'ADM' || $_SESSION["tipoUsuario"] == 'FUN');
    }
    return false;
}
?>