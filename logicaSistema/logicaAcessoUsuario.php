<?php
session_start();

function funcionarioEstaLogado() {
    if (isset($_SESSION["tipo_usuario"])) {
        return ($_SESSION["tipo_usuario"] == 'ADM' || $_SESSION["tipo_usuario"] == 'FUN');
    }
    return false;
}
?>