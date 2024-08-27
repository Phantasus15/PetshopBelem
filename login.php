<?php
include("conexao.php");
session_start()

if ($_SERVER["REQUEST_METHOD"]=="POST")
{$meuemail = mysqli_real_escape_string($conn,$_POST['email']);
  $minhasenha = mysqli_real_escape_string($conn,$_POST['senha']);
  $switch = mysqli_real_escape_string($conn,$_POST['switch']);
  if ($switch == 0)
  {$sql = "SELECT id, senha FROM cliente WHERE email = '$meuemail'";  
  } else if ($switch == 1) 
    {$sql ="SELECT id, senha FROM funcionario WHERE email = '$meuemail'";
    }
  $result = mysqli_querry($conn, $sql);
  $row = mysqli_fetch_array($result);
  if ($row)
  {$stored_hash = $row['senha'];
    if (password_verify($minhasenha, $stored_hash))  
      {$id = $row['id'];
      $email = $meuemail;
      $_SESSION['usuario'] = $email;
      $_SESSION['id'] = $id;
      if ($switch == 0) 
      {header('location: cliente/index.php');
        exit();
      } else if ($switch == 1) 
      {header('location: empresa/index.php');
        exit();
      }
      } else
      {$_SESSION['mensagemerro'] = "O email ou senha informados estão incorretos";
        header('location: login.php');
        exit();
      }
    } else 
      {$_SESSION['mensagemerro'] = "Usuario não localizado";
      header('location: login.php');
      exit();
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="flex-column">
    <form action="post">
        <h1>Login</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha">
          </div>
        <a href="cadastro.html">Cadastrar-se</a>
        <button type="button" class="btn btn-primary">Entrar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>