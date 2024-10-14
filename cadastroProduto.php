<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $marca = $_POST['marca'];
    $estoque = $_POST['estoque'];

    // Aqui você pode adicionar a lógica para salvar os dados no banco de dados
    echo "Produto cadastrado com sucesso!<br>";
    echo "Código: " . htmlspecialchars($codigo) . "<br>";
    echo "Descrição: " . htmlspecialchars($descricao) . "<br>";
    echo "Categoria: " . htmlspecialchars($categoria) . "<br>";
    echo "Valor: " . htmlspecialchars($valor) . "<br>";
    echo "Marca: " . htmlspecialchars($marca) . "<br>";
    echo "Estoque: " . htmlspecialchars($estoque) . "<br>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cadastroProduto.css">

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
        <div class="produto">
            <div class="produto-imagem">
                <img src="assets/item1.avif" alt="Ração" class="imagem-produto">
                <!-- Link para upload da imagem -->
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="imagem">Adicione uma foto do produto:</label>
                    <input type="file" name="imagem" id="imagem">
                    <button type="submit">Salvar Imagem</button>
                </form>
            </div>
            <form class="form-produto" action="telaCadastro.php" method="POST">
                <label for="codigo">Código Do Produto</label>
                <input type="text" id="codigo" name="codigo" required>
                
                <label for="descricao">Descrição do Produto</label>
                <input type="text" id="descricao" name="descricao" value="Ração para Cachorro Pedigree" required>
                
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="Ração">Ração</option>
                    <option value="Medicamento">Medicamento</option>
                    <option value="Higiene">Higiene</option>
                    <option value="Acessórios">Acessórios</option>
                </select>
                
                <label for="valor">Valor de Venda</label>
                <input type="text" id="valor" name="valor" value="40,00" required>
                
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" value="Pedigree" required>
                
                <label for="estoque">Estoque</label>
                <input type="text" id="estoque" name="estoque" value="5" required>
                
                <div class="botoes">
                    <button type="submit" class="btn editar">Editar</button>
                    <button type="button" class="btn cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>
</html>
