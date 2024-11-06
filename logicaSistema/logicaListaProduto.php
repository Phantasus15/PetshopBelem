<?php
include("conexao.php");

function listaProduto($conn)
{
	$produtos = array();
	$query = "SELECT * FROM produto";
	$result = mysqli_query($conn, $query);

	while ($produto = mysqli_fetch_assoc($result)) {
		array_push($produtos, $produto);
	}

	return $produtos;
}

function listaProdutosPorCategoria($conn, $categoriaAnimal, $categoriaProduto)
{
	$query = "SELECT * FROM produto WHERE nome_categoria_produto = {$categoriaProduto} AND nome_categoria_animal = {$categoriaAnimal}";
	$resultado = mysqli_query($conn, $query);

	if (!$resultado) {
		die("Erro na consulta: " . mysqli_error($conn));
	}

	$produtos = array();

	while ($produto = mysqli_fetch_assoc($resultado)) {
		$produtos[] = $produto;
	}

	return $produtos;
}


?>