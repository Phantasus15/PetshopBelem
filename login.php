<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
        width: 30vw;
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
        background-color: #f2f2f2;
        width: 50%;
        height: 520px;
        border-radius: 20px;
    }
</style>

<body class="flex-column">
    <form action="logicaSistema/logicaLogin.php" method="post">
        <h1>Login</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input class="form-control" type="password" name="senha" id="senha" required>
        </div>
        <a href="cadastroUsuario.php">Cadastrar-se</a>
        <input type="submit" name="entrar" id="entrar" value="Entrar" class="btn btn-primary">
    </form>
</body>

</html>
