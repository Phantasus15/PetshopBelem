<?php
include("conexao.php");

function listaUsuario($conn)
{
	$usuarios = array();
	$query = "SELECT * FROM usuario";
	$result = mysqli_query($conn, $query);

	while ($usuario = mysqli_fetch_assoc($result)) {
		array_push($usuarios, $usuario);
	}

	return $usuarios;
}

?>