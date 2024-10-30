<?php
session_start();
include("conexao.php");

if (isset($_POST['entrar'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];
    
    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['situacao'] == 1 && password_verify($senha, $user['senha'])) {
            $_SESSION['email'] = $email;
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

            if ($user['tipo_usuario'] == 'ADM' || $user['tipo_usuario'] == 'FUN') {
                header("Location: funcionarioInicio.php");
            } elseif ($user['tipo_usuario'] == 'CLI') {
                header("Location: index.php");
            }
            exit();
        } else {
            echo "Email ou senha incorretos.";
        }
    } else {
        echo "Email ou senha incorretos.";
    }
}
?>