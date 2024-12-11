<?php
session_start();
include("../conexao.php");

if (isset($_POST['entrar'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Consulta para verificar o email no banco de dados
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifica se a conta está ativa e a senha está correta
        if ($user['situacao'] == 1 && password_verify($senha, $user['senha'])) {
            // Armazena as informações do usuário na sessão
            $_SESSION['email'] = $email;
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['endereco'] = $user['endereco'];
            $_SESSION['cep'] = $user['cep'];
            $_SESSION['telefone'] = $user['telefone'];
            $_SESSION['tipo_usuario'] = $user['tipo'];
            $_SESSION['usuario_nome'] = $user['nome'];

            // Atualiza a data de último acesso na tabela 'usuarios'
            $userId = $user['id']; // Obtém o ID do usuário
            $updateQuery = "UPDATE usuarios SET data_ultimo_acesso = NOW() WHERE id = $userId";
            mysqli_query($conn, $updateQuery);

            // Redireciona conforme o tipo de usuário
            if ($user['tipo'] === "FUN") {
                header("Location: ../adminIndex.php");
            } elseif ($user['tipo'] === "CLI") {
                header("Location: ../index.php");
            } else {
                echo "<script>
                alert('Tipo de usuário desconhecido.');
                window.location.href = '../login.php';
                </script>";
            }
            exit();
        } else {
            echo "<script>
            alert('Senha incorreta ou conta desativada.');
            window.location.href = '../login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Usuário não encontrado.');
        window.location.href = '../login.php';
        </script>";
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
