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
                    <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Pedidos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Agendamentos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Estoque<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Histórico<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Relatório<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="listaUsuario.php">Usuarios<span class="sr-only">(current)</span></a>
                </li>
                <?php if(!isset($_SESSION['email'])): ?>
                    <li style="float:right"><a href="./logicaSistema/logicaLogout.php">Logout</a></li>
                    <?php else: ?>
                    <li style="float:right"><a class="active" href="login.php">Entrar</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="perfil">
            <ul class="navbar-nav mr-auto centro">
                <li class="nav-item active">
                    Perfil
                </li>
                <li class="nav-item active">
                    <i class="bi bi-person-circle"></i>
                </li>
            </ul>
        </div>
    </nav>