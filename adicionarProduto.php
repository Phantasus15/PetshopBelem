<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<?php
include("headerAdm.php");
?>
<style>
    .container {
        overflow-y: scroll;
        scrollbar-width: none;
        -ms-overflow-style: none;
        background-color: #FFF;
        border-radius: 12px;
        padding: 12px;
    }

    form{
    }
</style>

<body>
    <div class="main">
        <div class="container mt-5">
            <h1>Adicionar Produto</h1>
            <form action="logicaSistema/logicaAdicionarProduto.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto"
                        required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                        placeholder="Digite o preço" required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" step="1" class="form-control" id="quantidade" name="quantidade"
                        placeholder="Digite a quantidade" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select class="form-control" id="categoria" name="categoria" required>
                        <option value="Higiene">Higiene</option>
                        <option value="Acessorio">Acessorio</option>
                        <option value="Ração">Ração</option>
                        <option value="Medicamento">Medicamento</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="animal">Animal</label>
                    <select class="form-control" id="animal" name="animal" required>
                        <option value="cão">Cão</option>
                        <option value="gato">Gato</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem</label>
                    <input type="text" step="0.01" class="form-control" id="imagem" name="imagem"
                        placeholder="Digite a url da imagem" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text"  class="form-control" id="descricao" name="descricao"
                        placeholder="Digite a Descrição" required>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar Produto</button>
            </form>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>