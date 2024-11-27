<?php
session_start();
include("../conexao.php");

if (isset($_POST['entrar'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];
    $tipo_usuario = mysqli_real_escape_string($conn, $_POST['tipo_usuario']); // Recebe o tipo de usuário do formulário

    // Consulta para verificar o email e o tipo de usuário
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND tipo = '$tipo_usuario'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifica se a senha está correta
        if ($user['situacao'] == 1 && password_verify($senha, $user['senha'])) {
            $_SESSION['email'] = $email;
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['endereco'] = $user['endereco'];
            $_SESSION['cep'] = $user['cep'];
            $_SESSION['telefone'] = $user['telefone'];
            $_SESSION['tipo_usuario'] = $user['tipo'];
            $_SESSION['usuario_nome'] = $user['nome'];

            // Redireciona conforme o tipo de usuário
            if ($tipo_usuario === "FUN") {
                header("Location: ../adminIndex.php"); 
            } else if ($tipo_usuario === 'CLI') {
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo "<script>
            window.location.href = '../login.php';
            alert('Email, senha ou tipo de usuário incorretos.');
                  </script>";
        }
    } else {
        echo "<script>
        window.location.href = '../login.php';
        alert('Usuário não encontrado ou tipo incorreto.');
              </script>";
    }
}
?>