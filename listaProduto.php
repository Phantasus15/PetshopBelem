<?php
include("logicaSistema/logicaListaProduto.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
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
  <h6>Destaque para Cães</h6>
    <div class="grid-container">
        <?php
        if(isset($_POST['nome_categoria_produto'])) {
          $categoriaProduto = $_POST['nome_categoria_produto'];
          $produtos = listaProdutosPorCategoria($conn, $categoriaProduto);

          foreach ($produtos as $produto) {
          ?>
            <div class="grid-item">
                <img class="card-img-top" src="<?= $produto['imagem'] ?>" alt="Imagem de capa do card">
                <div class="card-body">
                    <h5 class="card-title"><?= $produto["nome_produto"] ?></h5>
                    <br>
                    <p class="card-text"><?= $produto["valor"] ?></p>
                    <a href="visitaProduto.php?id=<?= $produto['id'] ?>" class="btn btn-primary">Visitar</a>
                    <a href="telaCarrinho.php" class="btn btn-primary">Adicionar</a>
                </div>
            </div>
          <?php
          }
          ?>
          
            <a href="#">Ver mais >></a>
      </div>
      <?php
        }
      ?>
    </div>  
</body>
<?php
include("footer.php");
?>
</html>