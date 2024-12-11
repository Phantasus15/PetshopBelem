<?php
session_start();
include("conexao.php"); // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    // Consulta ao banco de dados para verificar o usuário
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ? AND tipo = ?");
    $stmt->bind_param("ss", $email, $tipo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Armazena informações na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $tipo;

            // Redireciona de acordo com o tipo de usuário
            if ($tipo === 'cliente') {
                header("Location: index.php");
            } elseif ($tipo === 'funcionario') {
                header("Location: funcionario_dashboard.php");
            }
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
