<?php
include("./logicaSistema/logicaCadastroProduto.php");
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cadastroProduto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="main">
        <div class="produto">
            <div class="produto-imagem">
                <form action="logicaSistema/logicaCadastroProduto.php" method="post" enctype="multipart/form-data">
                <img src="" alt="Ração" class="imagem-produto">
                    <label for="imagem">Adicione uma foto do produto:</label>
                    <input type="file" name="imagem" required>
            </div>
            <div class="form-produto">
                <label for="codigo">Nome do produto</label>
                <input type="text" id="nome_produto" name="nome_produto" required>
                <label for="descricao">Descrição do Produto</label>
                <input type="text" id="descricao" name="descricao" required>
                <label for="nome_categoria_produto">Categoria produto</label>
                <select name="nome_categoria_produto" id="nome_categoria_produto" required>
                    <?php
                    $categorias = listaCategoriaProduto($conn);
                    foreach ($categorias as $categoriaProduto) {
                        ?>
                        <option value="<?= $categoriaProduto["id"] ?>"><?= $categoriaProduto["nome"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="nome_categoria_animal">Categoria animal</label>
                <select name="nome_categoria_animal" id="nome_categoria_animal" required>
                    <?php
                    $categorias = listaCategoriaAnimal($conn);
                    foreach ($categorias as $categoriaAnimal) {
                        ?>
                        <option value="<?= $categoriaAnimal["id"] ?>"><?= $categoriaAnimal["nome"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="marca_produto">Marca do Produto</label>
                <select name="nome_marca_produto" id="nome_marca_produto" required>
                    <?php
                    $marcas = listaMarcaProduto($conn);
                    foreach ($marcas as $marcaProduto) {
                        ?>
                        <option value="<?= $marcaProduto["id"] ?>"><?= $marcaProduto["nome"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="valor">Valor de Venda</label>
                <input type="text" id="valor" name="valor" required>
                <label for="estoque">Estoque</label>
                <input type="text" id="estoque" name="estoque" required>
                <div class="botoes">
                    <input class="btn btn-primary" type="submit" name="cadastroProduto" id="submit" value="Cadastrar">
                    <button type="button" class="btn cancelar">Cancelar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>