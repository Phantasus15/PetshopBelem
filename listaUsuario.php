<?php
include("logicaSistema/logicaListaUsuario.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/home.css">

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


                

                <table class="table table-responsive table-hover table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $usuarios = listaUsuario($conn);

                    foreach ($usuarios as $usuario) {
                    ?>
                        <tr>
                            <td><?= $usuario["id"] ?></td>
                            <td><?= $usuario["email"] ?></td>
                            <td><?= $usuario["nome"] ?></td>
                            <td><?= $usuario["tipo_usuario"] ?></td>
                            <td>
                                <span class="status-active"><?= $usuario["situacao"] ?></span>
                            </td>
                            <td class="buttons">
                                <img
                                src="assets/icon_edita.png" height="30px" width="30px">
                                <a href="#" class="btn btn-default" title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                            <td class="buttons">
                                <img
                                src="assets/icon_delete.png" height="30px" width="30px">
                                <a href="#" class="btn btn-default" title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <form id="delete-form" action="" method="post">
                </form>
                <div class="crud-pagination">
                    <ul class="pagination">
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>