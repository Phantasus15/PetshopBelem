<?php
include("./conexao.php");

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'];
$query = $conn->prepare("SELECT nome, telefone, endereco, cep, email FROM usuario WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$usuario = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];

    $update = $conn->prepare("UPDATE usuario SET telefone = ?, endereco = ?, cep = ? WHERE email = ?");
    $update->bind_param("ssss", $telefone, $endereco, $cep, $email);

    if ($update->execute()) {
        $success_message = "Perfil atualizado com sucesso!";
        $usuario['telefone'] = $telefone;
        $usuario['endereco'] = $endereco;
        $usuario['cep'] = $cep;
    } else {
        $error_message = "Erro ao atualizar o perfil. Tente novamente.";
    }
}
?>