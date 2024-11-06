<?php
include("logicaSistema/logicaVisitaProduto.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/visitaProduto.css">

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
            <img class="card-img-top" src="<?= $produto['imagem'] ?>" alt="Imagem de capa do card" height="500px">
            <div class="card-body">
                <h3 class="card-title"><?= $produto['nome_produto'] ?></h3>
                <label><b>Descrição:</b> <?= $produto['descricao'] ?></label>
                <br>
                <label><b>categoria: </b><?= $produto['nome_categoria_produto'] ?></label>
                <br>
                <label><b>Valor:</b> R$<?= $produto['valor'] ?></label>
                <br>
                <a href="telaProduto.php" class="btn btn-primary">Comprar</a>
                <a href="telaCarrinho.php" class="btn btn-primary">Carrinho</a>
                <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>