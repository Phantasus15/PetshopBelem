<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
include("header.php");
?>
<?php
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Obtém o email do usuário logado
$email = $_SESSION['email'];

// Consulta os dados do usuário no banco
$query = "SELECT nome, sobrenome, telefone, endereco, cidade, estado, cep FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result); // Pega os dados do usuário
} else {
    echo "Erro ao buscar os dados do usuário.";
    exit();
}

// Atualiza os dados do perfil ao enviar o formulário
if (isset($_POST['salvar'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $sobrenome = mysqli_real_escape_string($conn, $_POST['sobrenome']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $cep = mysqli_real_escape_string($conn, $_POST['cep']);

    $update_query = "
        UPDATE usuarios 
        SET nome = '$nome', sobrenome='$sobrenome' ,telefone = '$telefone', endereco = '$endereco', cidade = '$cidade', estado = '$estado', cep = '$cep' 
        WHERE email = '$email'
    ";

    if (mysqli_query($conn, $update_query)) {
        echo "Perfil atualizado com sucesso!";
        // Opcional: Redirecionar ou exibir mensagem
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}
?>

<style>
    .container{
        background-color: aliceblue;
        padding: 20px;
    }
</style>

<body>
    <div class="main">

        <div class="container mt-5">
            <h2>Editar Perfil</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                        value="<?php echo htmlspecialchars($user['nome']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                        value="<?php echo htmlspecialchars($user['sobrenome']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone"
                        value="<?php echo htmlspecialchars($user['telefone']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado"
                        value="<?php echo htmlspecialchars($user['estado']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade"
                        value="<?php echo htmlspecialchars($user['cidade']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco"
                        value="<?php echo htmlspecialchars($user['endereco']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="cep">Cep</label>
                    <input type="text" class="form-control" id="cep" name="cep"
                        value="<?php echo htmlspecialchars($user['cep']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado"
                        value="<?php echo htmlspecialchars($user['estado']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
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
    </div>
</body>

</html>