<?php
include("../conexao.php");

if (isset($_POST['cadastroProduto'])) {
    $nomeProduto = $_POST["nome_produto"];
    $descricao = $_POST["descricao"];
    $categoriaProduto = $_POST["nome_categoria_produto"];
    $categoriaAnimal = $_POST["nome_categoria_animal"];
    $valor = $_POST["valor"];
    $marcaProduto = $_POST["nome_marca_produto"];
    $estoque = $_POST["estoque"];

    $diretorioImagem = '../assets/';
    $diretorioImagemRelativo = 'assets/';

// Upload de imagem quando confirmação de cadastro de produto
    if (isset($_FILES['imagem'])) {
        $nomeImagem = basename($_FILES['imagem']['name']);
        $caminhoImagem = $diretorioImagem . $nomeImagem;
        $tipoImagem = strtolower(pathinfo($caminhoImagem, PATHINFO_EXTENSION));
        $tamanhoImagem = $_FILES['imagem']['size'];

        if (getimagesize($_FILES['imagem']['tmp_name']) !== false) {

            if (!file_exists($caminhoImagem)) {

                if ($tamanhoImagem <= 500000) {

                    if (in_array($tipoImagem, ['jpg', 'png', 'jpeg', 'gif'])) {

                        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
                            $imagem = $diretorioImagemRelativo . $nomeImagem;
                            $query = "INSERT INTO produto (nome_produto, imagem, descricao, nome_categoria_produto, nome_categoria_animal, nome_marca_produto, valor, estoque) VALUES ('$nomeProduto', '$imagem', '$descricao', '$categoriaProduto', '$categoriaAnimal', '$marcaProduto', '$valor', '$estoque')";

                            if (mysqli_query($conn, $query)) {
                                $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
                                header('Location: ../cadastroProduto.php');
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> Erro: ' . $query . '<br>' . $conn->error . ' </div>';
                            }
                        } else {
                            echo 'Desculpe, houve um erro ao enviar seu arquivo.';
                        }
                    } else {
                        echo 'Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.';
                    }
                } else {
                    echo 'Desculpe, o seu arquivo é muito grande.';
                }
            } else {
                echo 'Desculpe, o arquivo já existe.';
            }
        } else {
            echo 'Arquivo não é uma imagem.';
        }
    }
} else {
    $_SESSION['mensagemerro'] = 'erro';
}
?>

<!-- Função para retornar lista de categorias em "cadastroProduto.php" -->
<?php
function listaCategoriaProduto($conn)
{
    $categorias = array();
    $query = "SELECT * FROM categoria_produto";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categorias[] = $row;
        }
    }
    return $categorias;
}

function listaCategoriaAnimal($conn)
{
    $categorias = array();
    $query = "SELECT * FROM categoria_animal";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categorias[] = $row;
        }
    }
    return $categorias;
}

function listaMarcaProduto($conn)
{
    $marcas = array();
    $query = "SELECT * FROM marca_produto";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $marcas[] = $row;
        }
    }
    return $marcas;
}
?>