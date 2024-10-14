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

?>