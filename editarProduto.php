<?php
include("headerAdm.php");

// Conexão com o banco de dados
include("conexao.php");

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    die("ID do produto não fornecido.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM produto WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Produto não encontrado.");
}

$produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
    .edit-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-top: 30px;
    }

    .edit-container img {
        max-width: 300px;
        border-radius: 10px;
    }

    .form-container {
        flex: 1;
    }


</style>

<body>
    <div class="container">
        <h1 class="mt-4">Editar Produto</h1>
        <div class="edit-container">
      
            <div class="image-container">
                <img src="<?= $produto['img'] ?>" alt="Imagem do Produto">
            </div>

           
            <div class="form-container">
                <form action="logicaSistema/logicaSalvarEdicaoProduto.php" method="post">

                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">

                    <div class="form-group">
                        <label for="nome">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto['nome'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="preco">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                            value="<?= $produto['preco'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" step="0.01" class="form-control" id="quantidade" name="quantidade"
                            value="<?= $produto['quantidade'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="Higiene" <?= $produto['categoria'] == 'Higiene' ? 'selected' : '' ?>>Higiene
                            </option>
                            <option value="Acessorio" <?= $produto['categoria'] == 'Acessorio' ? 'selected' : '' ?>>
                                Acessorio</option>
                            <option value="Ração" <?= $produto['categoria'] == 'Ração' ? 'selected' : '' ?>>Ração</option>
                            <option value="Medicamento" <?= $produto['categoria'] == 'Medicamento' ? 'selected' : '' ?>>
                                Medicamento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="animal">Animal</label>
                        <select class="form-control" id="animal" name="animal" required>
                            <option value="cão" <?= $produto['animal'] == 'cão' ? 'selected' : '' ?>>Cão</option>
                            <option value="gato" <?= $produto['animal'] == 'gato' ? 'selected' : '' ?>>Gato</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagem">URL da Imagem</label>
                        <input type="text" class="form-control" id="imagem" name="imagem" value="<?= $produto['img'] ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"
                            required><?= $produto['descricao'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="adminIndex.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
include("footer.php");
?>

</html>
