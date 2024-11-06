<?php
include("logicaSistema/logicaCadastroProduto.php");
include("logicaSistema/logicaListaProduto.php");
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/listaProduto.css">

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
    <div class="grid-container">
        <?php
        $produtos = listaProduto($conn);

        foreach ($produtos as $produto) {
            ?>
            <div class="grid-item">
                <img class="card-img-top" src="<?= $produto['imagem'] ?>" alt="Imagem de capa do card wi" height="200px">
                <div class="card-body">
                    <h5 class="card-title"><?= $produto["nome_produto"] ?></h5>
                    <br>
                    <p class="card-text">R$<?= $produto["valor"] ?></p>
                    <a href="visitaProduto.php?id=<?= $produto['id'] ?>" class="btn btn-primary">Editar</a>
                    <a href="telaCarrinho.php" class="btn btn-primary">Arquivar</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>