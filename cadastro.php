<?php
session_start();
include("conexao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $telefone = $_POST["telefone"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $confirmarsenha = $_POST["confirmar_senha"];
  $endereco = $_POST["endereco"];
  $cep = $_POST["cep"];
  // Criptografa a senha
  $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

  if ($senha == $confirmarsenha) {
    $sql = "INSERT INTO cliente (nome, telefone, email, endereco, senha, cep)
                VALUES ('$nome', '$telefone', '$email', '$endereco', '$senha', '$cep')";

    if ($conn->query($sql) === TRUE) {
      $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
      header('Location: login.php');
      exit();
    } else {
      echo '<div class="alert alert-danger" role="alert">
                    Erro: ' . $sql . '<br>' . $conn->error . '
                  </div>';
    }
  } else {
    $_SESSION['mensagemerro'] = 'Senhas não são iguais!';
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/cadastro.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <h1>Cadastro</h1>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
      <label for="nome_cliente" class="form-label">Nome Completo</label>
      <input type="text" class="form-control" name="nome">
    </div>
    <div class="mb-3">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="tel" class="form-control" name="telefone">
    </div>
    <div class="mb-3">
      <label for="endereco" class="form-label">Endereço</label>
      <input type="text" class="form-control" name="endereco">
    </div>
    <div class="mb-3">
      <label for="cep" class="form-label">Seu cep</label>
      <input type="text" class="form-control" name="cep">
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" class="form-control" name="senha">
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Confirmar senha</label>
      <input type="password" class="form-control" name="confirmar_senha">
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>