<?php
include("../conexao.php");

if (isset($_POST['cadastroUsuario'])) {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit();
    }

    // Cria o hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Tipo de usuário
    $tipo_usuario = 'CLI';

    // Verifica a conexão com o banco de dados
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Verifica se o email já existe no banco de dados
    $sql_email_check = "SELECT * FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_email_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "Este email já está cadastrado.";
        exit();
    }

    // Insere os dados do novo usuário
    $sql = "INSERT INTO usuarios (nome, sobrenome, telefone, endereco, estado, cidade, cep, tipo, email, senha) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Ajustando os tipos para os parâmetros
    $stmt->bind_param("ssssssssss", $nome, $sobrenome, $telefone, $endereco, $estado, $cidade, $cep, $tipo_usuario, $email, $senha_hash);

    // Executa a consulta
    if ($stmt->execute()) {
        // Redireciona para a página inicial
        header("Location: ../login.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $stmt_check->close();
    $conn->close();
}
?>
