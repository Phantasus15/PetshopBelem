<?php
include("../conexao.php");

if (isset($_POST['cadastroUsuario'])) {
  $nome = $_POST["nome"];
  $telefone = $_POST["telefone"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $confirmarsenha = $_POST["confirmar_senha"];
  $endereco = $_POST["endereco"];
  $cep = $_POST["cep"];
  $tipoUsuario = $_POST['tipo_usuario'];
  
  if ($senha === $confirmarsenha) {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $situacao = ($tipoUsuario == 'FUN') ? 0 : 1;
    $sql = "INSERT INTO usuario (nome, telefone, email, endereco, senha, cep, situacao, tipo_usuario)
                VALUES ('$nome', '$telefone', '$email', '$endereco', '$senha_hash', '$cep', '$situacao', '$tipoUsuario')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
        header('Location: ../login.php');
    } else {
        echo '<div class="alert alert-danger" role="alert">
                    Erro: ' . $sql . '<br>' . $conn->error . '
                  </div>';
    }
  } else {
    $_SESSION['mensagemerro'] = 'Senhas não são iguais!';
  }
}
?>