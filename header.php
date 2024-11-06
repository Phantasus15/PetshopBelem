<?php
include("conexao.php");
include("logicaSistema/logicaAcessoUsuario.php");
?>
<link rel="stylesheet" href="css/header.css">
<nav class="navbar navbar-expand-lg">
    <img src="assets/logo.jfif" style="height:75px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">

                <a class="nav-link"
                    href="<?php if (funcionarioEstaLogado()) { ?>funcionarioInicio.php<?php } else { ?>clienteInicio.php<?php } ?>">Inicio<span
                        class="sr-only">(current)</span></a>

            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Pedidos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Agendamentos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Histórico<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Relatório<span class="sr-only">(current)</span></a>
            </li>
            <?php if (funcionarioEstaLogado()) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="listaEstoque.php">Estoque<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cadastroProduto.php">Cadastrar<span class="sr-only">(current)</span></a>
                </li>
                <li>
                    <a class="nav-link" href="listaUsuario.php">Usuarios<span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="perfil">
        <ul class="navbar-nav mr-auto centro">
            <li class="nav-item active"><i class="bi bi-person-circle"></i></li>
            <li class="nav-item active">Seja bem vindo(a)! <br> <u><a
                        href="perfilUsuario.php"><?= usuarioLogado() ?></a></u> </li>
            <?php if (isset($_SESSION['email'])) { ?>
                <li style="float:right"><a href="./logicaSistema/logicaLogout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>