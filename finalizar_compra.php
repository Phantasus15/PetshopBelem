<?php
include("header.php");
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Verifique se o tipo de entrega foi enviado no POST
if (isset($_POST['tipo_entrega'])) {
    // Salve o valor do tipo de entrega na sessão
    $_SESSION['tipo_entrega'] = $_POST['tipo_entrega'];
    
    // Agora você pode usar o valor de $_SESSION['tipo_entrega'] onde precisar
    echo "Tipo de entrega selecionado: " . $_SESSION['tipo_entrega'];
} else {
    // Se não foi enviado, exiba uma mensagem
    echo "Tipo de entrega não foi selecionado.";
}



// Obtém o email do usuário logado
$email = $_SESSION['email'];

// Consulta os dados do usuário no banco
$query = "SELECT nome, sobrenome, telefone, endereco, cidade, estado, cep FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
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
        SET nome = '$nome', sobrenome='$sobrenome', telefone = '$telefone', endereco = '$endereco', cidade = '$cidade', estado = '$estado', cep = '$cep' 
        WHERE email = '$email'
    ";

    if (mysqli_query($conn, $update_query)) {
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}

// Verifica se o tipo de entrega foi enviado
$tipo_entrega = isset($_POST['tipo_entrega']) ? $_POST['tipo_entrega'] : 'Não especificado';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="main">
        <div class="container mt-5">
            <h1>Confirmar Endereço</h1>
            <form action="processar_compra.php" method="post">
                <!-- Campo oculto para o tipo de entrega -->
                <input type="hidden" name="tipo_entrega" value="<?php echo htmlspecialchars($tipo_entrega); ?>">

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
                <div class="form-group">
                    <p><strong>Tipo de Entrega:</strong> <?php echo htmlspecialchars($tipo_entrega); ?></p>
                </div>
                <button type="submit" class="btn btn-success">Finalizar Compra</button>
            </form>
        </div>
    </div>
</body>

</html>
