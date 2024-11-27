<?php
include("headerAdm.php");
include("conexao.php"); // Incluindo a conexão com o banco de dados


$sql_pedidos = "SELECT COUNT(*) as num_pedidos FROM pedidos"; 
$sql_agendamentos = "SELECT COUNT(*) as num_agendamentos FROM agendamentos";
$sql_clientes = "SELECT COUNT(*) as num_clientes FROM usuarios"; 

// Executando as consultas
$result_pedidos = $conn->query($sql_pedidos);
$result_agendamentos = $conn->query($sql_agendamentos);
$result_clientes = $conn->query($sql_clientes);

// Pegando os resultados das consultas
$num_pedidos = $result_pedidos->fetch_assoc()['num_pedidos'];
$num_agendamentos = $result_agendamentos->fetch_assoc()['num_agendamentos'];
$num_clientes = $result_clientes->fetch_assoc()['num_clientes'];

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .main {
            height: 100vh;
            padding: 20px;
            background-image: url("./assets/fundo.jfif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-custom {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
        }

        .card-header {
            background-color: #f8f9fa;
            font-size: 1.2rem;
            color: #333;
        }

        .card-footer {
            background-color: #f8f9fa;
            font-size: 0.9rem;
            color: #666;
        }

        .dashboard-card {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 2rem;
            color: #007bff;
        }

        /* Para dispositivos móveis */
        @media (max-width: 768px) {
            .card-custom {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container mt-5">
            <h2 class="text-center mb-4 text-white">Painel de Controle</h2>

            <div class="row">
                <!-- Card de Pedidos -->
                <div class="col-md-4 col-sm-12">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Número de Pedidos</strong>
                        </div>
                        <div class="card-body">
                            <h3 id="num-pedidos" class="card-title"><?php echo $num_pedidos; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização: 1 hora atrás
                        </div>
                    </div>
                </div>

                <!-- Card de Agendamentos -->
                <div class="col-md-4 col-sm-12">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Número de Agendamentos</strong>
                        </div>
                        <div class="card-body">
                            <h3 id="num-agendamentos" class="card-title"><?php echo $num_agendamentos; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização: 2 horas atrás
                        </div>
                    </div>
                </div>

                <!-- Card de Clientes -->
                <div class="col-md-4 col-sm-12">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Número de Clientes</strong>
                        </div>
                        <div class="card-body">
                            <h3 id="num-clientes" class="card-title"><?php echo $num_clientes; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização: 30 minutos atrás
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
