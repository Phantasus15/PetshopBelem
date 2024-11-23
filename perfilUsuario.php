<?php
include("logicaSistema/logicaPerfilUsuario.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cadastroProduto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="main">
        <div class="container">
            <div id="perfil">
                <div class="module-content">
                    <div class="header">
                        <h2>Perfil</h2>
                        <p>Visualize e atualize o seu perfil</p>
                    </div>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" class="w150 form-control" value="<?= htmlspecialchars($usuario['nome']) ?>"
                                disabled="true">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input id="telefone" type="text" name="telefone" class="w150 form-control" value="<?= htmlspecialchars($usuario['telefone']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input id="endereco" type="text" name="endereco" class="w300 form-control"
                                value="<?= htmlspecialchars($usuario['endereco']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="cep">Cep</label>
                            <input id="cep" type="text" name="cep" class="w300 form-control"
                                value="<?= htmlspecialchars($usuario['cep']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="w150 form-control" value="<?= htmlspecialchars($usuario['email']) ?>"
                                disabled="true">
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-primary">
                                Salvar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>