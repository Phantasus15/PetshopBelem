<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
  form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: auto;
    gap: 1rem;
    background: #fff;
    border-radius: 12%;
    width: 500px;
    padding: 20px;
  }

  body {
    background-image: url('https://i.pinimg.com/736x/6a/ab/0f/6aab0f8c573248e63c47ccd9aca18355.jpg');
    width: 99%;
    height: 95vh;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
  }

  .container-main {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
  }
</style>

<body>
  <div class="container-main">
    <form method="post" action="logicaSistema/logicaCadastroUsuario.php">
      <h1>Cadastro</h1>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="nome_cliente" class="form-label">Nome</label>
          <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Sobrenome" class="form-label">Sobrenome</label>
          <input type="text" class="form-control" name="Sobrenome" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="tel" class="form-control" name="telefone" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="estado" class="form-label">Estado</label>
          <input type="text" class="form-control" name="estado" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="cidade" class="form-label">Cidade</label>
          <input type="text" class="form-control" name="cidade" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="endereco" class="form-label">Endereço</label>
          <input type="text" class="form-control" name="endereco" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="cep" class="form-label">Seu CEP</label>
          <input type="text" class="form-control" name="cep" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" name="senha" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="senha" class="form-label">Confirmar Senha</label>
          <input type="password" class="form-control" name="confirmar_senha" required>
        </div>
      </div>

      <input class="btn btn-primary" type="submit" name="cadastroUsuario" id="submit" value="Cadastrar">
    </form>
  </div>

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
