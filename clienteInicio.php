<?php
include("logicaSistema/logicaCadastroProduto.php")
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
        <div class="linha">
            <div class="card">
                <h6>Destaque para Cães</h6>
                <ul class="lista">
                <?php
                $categorias = listaCategoriaProduto($conn);
                foreach ($categorias as $categoriaProduto) {
                ?>
                    <li>
                        <form action="listaProduto.php" method="post">
                            <input type="hidden" name="nome_categoria_produto" value="<?= $categoriaProduto["id"] ?>">
                            <div class="imagem">
                                <img class="icone" src="assets/racao.png" alt="">
                            </div>
                            <p>
                            <button type="submit"><?= $categoriaProduto["nome"] ?></button>
                            </p>
                        </form>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div>
            <div class="card">
                <h6>Destaque para Gatos</h6>
                <ul class="lista">
                <?php
                $categorias = listaCategoriaProduto($conn);
                foreach ($categorias as $categoriaProduto) {
                ?>
                    <li>
                        <form action="listaProduto.php" method="post">
                            <input type="hidden" name="nome_categoria_produto" value="<?= $categoriaProduto["id"] ?>">
                            <div class="imagem">
                                <img class="icone" src="assets/racao.png" alt="">
                            </div>
                            <p>
                            <button type="submit"><?= $categoriaProduto["nome"] ?></button>
                            </p>
                        </form>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div>
        </div>
        <div class="linha">
            <div class="card">
                <h6>Agende seu banho e tosa</h6>
                <ul class="lista">
                    <li>
                        <a href="listaProduto.php">
                            <div class="imagem">

                                <img class="icone" src="assets\banhoetosa.png" alt="">
                            </div>
                            <p>
                                Banho e tosa
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>