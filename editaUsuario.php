<!DOCTYPE html>
<?php
include("logicaSistema/logicaEditaUsuario.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/editaUsuario.css">
    </link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<?php
include("header.php");
?>

<body>
    <div class="main">
        <div class="container">
            <div class="module-content">
                <div class="header">
                    <img
                    src="assets/icon_usuario.png">
                    <h2>Usuários</h2>
                    <p>Gerencie os usuários do sistema</p>
                </div>
                <form id="crud-form" method="post" action="#">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <div class="tab-content">
                        <div id="tab-geral" class="tab-pane active">
                        <div class="form-group required">
                            <label for="login">Nome de usuário</label>
                            <input id="login" type="text" name="nome" class="form-control" value="<?= $usuario['nome'] ?>" maxlength="20">
                        </div>
                        <div class="form-group required">
                            <label for="nome">Email</label>
                            <input id="nome" type="text" name="email" class="form-control" value="<?= $usuario['email'] ?>" maxlength="20">
                        </div>
                        <div class="form-group required">
                            <label for="status">Status</label>
                            <select id="status" name="situacao" class="form-control">
                                <option value="">Selecione</option>
                                <option value="2" <?= $usuario['situacao'] == 2 ? 'selected' : '' ?>>Bloqueado</option>
                                <option value="1" <?= $usuario['situacao'] == 1 ? 'selected' : '' ?>>Aprovado</option>
                                <option value="0" <?= $usuario['situacao'] == 0 ? 'selected' : '' ?>>Pendente</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <span class="btns">
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-save"></span>&nbsp;
                                Salvar </button>
                            <a href="listaUsuario.php"
                                class="btn btn-default">
                                <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;
                                Voltar </a>
                        </span>

                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>