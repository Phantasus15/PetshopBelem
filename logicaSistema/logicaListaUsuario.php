<?php
include("conexao.php");

function listaUsuario($conn)
{
	$usuarios = array();
	$query = "SELECT * FROM usuario";
	$result = mysqli_query($conn, $query);	
	
	while ($usuario = mysqli_fetch_assoc($result)) {
        switch ($usuario['situacao']) {
            case 1:
                $usuario['situacao'] = 'Aprovado';
                break;
            case 2:
                $usuario['situacao'] = 'Bloqueado';
                break;
            case 0:
                $usuario['situacao'] = 'Pendente';
                break;
            default:
                $usuario['situacao'] = 'Indefinido';
                break;
        }

        array_push($usuarios, $usuario);
    }

	return $usuarios;
}

?>