<?php
include("headerAdm.php");
include("conexao.php"); // Incluindo a conexão com o banco de dados

$sql_pedidos = "SELECT COUNT(*) as num_pedidos FROM pedidos";
$sql_agendamentos = "SELECT COUNT(*) as num_agendamentos FROM agendamentos";
$sql_clientes = "SELECT COUNT(*) as num_clientes FROM usuarios";
$sql_total_produtos = "SELECT SUM(quantidade) AS total_produtos FROM produto"; // Consulta para total de produtos

// Executando as consultas
$result_pedidos = $conn->query($sql_pedidos);
$result_agendamentos = $conn->query($sql_agendamentos);
$result_clientes = $conn->query($sql_clientes);
$result_total_produtos = $conn->query($sql_total_produtos);

// Pegando os resultados das consultas
$num_pedidos = $result_pedidos->fetch_assoc()['num_pedidos'];
$num_agendamentos = $result_agendamentos->fetch_assoc()['num_agendamentos'];
$num_clientes = $result_clientes->fetch_assoc()['num_clientes'];
$total_produtos = $result_total_produtos->fetch_assoc()['total_produtos'] ?? 0;
// Consultas para as categorias
$sql_categorias = [
    'medicamento' => "SELECT SUM(quantidade) AS total FROM produto WHERE categoria = 'medicamento'",
    'higiene' => "SELECT SUM(quantidade) AS total FROM produto WHERE categoria = 'higiene'",
    'racao' => "SELECT SUM(quantidade) AS total FROM produto WHERE categoria = 'ração'",
    'acessorios' => "SELECT SUM(quantidade) AS total FROM produto WHERE categoria = 'acessórios'"
];

// Resultados das categorias
$resultados = [];
foreach ($sql_categorias as $categoria => $query) {
    $result = $conn->query($query);
    $resultados[$categoria] = $result->fetch_assoc()['total'] ?? 0;
}

// Consultas para as últimas atualizações das categorias
$sql_last_update_categoria = [
    'medicamento' => "SELECT MAX(atualizado_em) AS ultima_atualizacao FROM produto WHERE categoria = 'medicamento'",
    'higiene' => "SELECT MAX(atualizado_em) AS ultima_atualizacao FROM produto WHERE categoria = 'higiene'",
    'racao' => "SELECT MAX(atualizado_em) AS ultima_atualizacao FROM produto WHERE categoria = 'ração'",
    'acessorios' => "SELECT MAX(atualizado_em) AS ultima_atualizacao FROM produto WHERE categoria = 'acessórios'"
];

// Resultados das últimas atualizações por categoria
$ultimas_atualizacoes = [];
foreach ($sql_last_update_categoria as $categoria => $query) {
    $result = $conn->query($query);
    $ultimas_atualizacoes[$categoria] = $result->fetch_assoc()['ultima_atualizacao'] ?? 'Não disponível';
}

$sql_pedidos = "SELECT SUM(total) AS faturamento_total FROM pedidos"; // Alterado para somar o total de faturamento
$sql_agendamentos = "SELECT COUNT(*) AS num_agendamentos_7d FROM agendamentos WHERE data >= CURDATE() - INTERVAL 7 DAY"; // Agendamentos dos últimos 7 dias
$sql_clientes = "SELECT COUNT(*) as num_clientes FROM usuarios";
$sql_total_produtos = "SELECT SUM(quantidade) AS total_produtos FROM produto"; // Consulta para total de produtos

// Consultas para cães e gatos
$sql_produtos_caes = "SELECT SUM(quantidade) AS total_caes FROM produto WHERE animal = 'cão'";
$sql_produtos_gatos = "SELECT SUM(quantidade) AS total_gatos FROM produto WHERE animal = 'gato'";

// Executando as consultas
$result_pedidos = $conn->query($sql_pedidos);
$result_agendamentos = $conn->query($sql_agendamentos);
$result_clientes = $conn->query($sql_clientes);
$result_total_produtos = $conn->query($sql_total_produtos);
$result_produtos_caes = $conn->query($sql_produtos_caes);
$result_produtos_gatos = $conn->query($sql_produtos_gatos);

// Pegando os resultados das consultas
$faturamento_total = $result_pedidos->fetch_assoc()['faturamento_total'] ?? 0;
$num_agendamentos_7d = $result_agendamentos->fetch_assoc()['num_agendamentos_7d'];
$num_clientes = $result_clientes->fetch_assoc()['num_clientes'];
$total_produtos = $result_total_produtos->fetch_assoc()['total_produtos'] ?? 0;
$total_produtos_caes = $result_produtos_caes->fetch_assoc()['total_caes'] ?? 0;
$total_produtos_gatos = $result_produtos_gatos->fetch_assoc()['total_gatos'] ?? 0;

$sql_pedidos = "SELECT COUNT(*) as num_pedidos FROM pedidos";
$sql_agendamentos = "SELECT COUNT(*) as num_agendamentos FROM agendamentos";
$sql_clientes = "SELECT COUNT(*) as num_clientes FROM usuarios WHERE tipo != 'FUN'";
$sql_total_produtos = "SELECT SUM(quantidade) AS total_produtos FROM produto"; // Consulta para total de produtos

// Consultas para clientes ativos nos últimos 7 dias
$sql_clientes_ativos = "SELECT COUNT(*) as clientes_ativos FROM usuarios WHERE data_ultimo_acesso >= CURDATE() - INTERVAL 7 DAY";

// Consultas para clientes que compraram nos últimos 7 dias
$sql_clientes_compraram = "SELECT COUNT(DISTINCT cliente_id) as clientes_compraram FROM pedidos WHERE data_pedido >= CURDATE() - INTERVAL 7 DAY";

// Consultas para novos clientes nos últimos 7 dias
$sql_novos_clientes = "SELECT COUNT(*) as novos_clientes FROM usuarios WHERE data_criacao >= CURDATE() - INTERVAL 7 DAY";

// Executando as consultas
$result_pedidos = $conn->query($sql_pedidos);
$result_agendamentos = $conn->query($sql_agendamentos);
$result_clientes = $conn->query($sql_clientes);
$result_clientes_ativos = $conn->query($sql_clientes_ativos);
$result_clientes_compraram = $conn->query($sql_clientes_compraram);
$result_novos_clientes = $conn->query($sql_novos_clientes);

$num_pedidos = $result_pedidos->fetch_assoc()['num_pedidos'];
$num_agendamentos = $result_agendamentos->fetch_assoc()['num_agendamentos'];
$num_clientes = $result_clientes->fetch_assoc()['num_clientes'];
$clientes_ativos = $result_clientes_ativos->fetch_assoc()['clientes_ativos'];
$clientes_compraram = $result_clientes_compraram->fetch_assoc()['clientes_compraram'];
$novos_clientes = $result_novos_clientes->fetch_assoc()['novos_clientes'];

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
            <!-- Título -->
            <h1 class="mb-3 text-center">Dashboard</h1>

            <div class="row">
                <!-- Card Total Produtos -->
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Total</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $total_produtos; ?></h3>
                        </div>
                        <div class="card-footer">
                            Produtos totais em estoque
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Medicamentos</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $resultados['medicamento']; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização:
                            <?php echo date("d/m/Y H:i", strtotime($ultimas_atualizacoes['medicamento'])); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Higiene</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $resultados['higiene']; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização:
                            <?php echo date("d/m/Y H:i", strtotime($ultimas_atualizacoes['higiene'])); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Ração</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $resultados['racao']; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização:
                            <?php echo date("d/m/Y H:i", strtotime($ultimas_atualizacoes['racao'])); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Acessórios</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $resultados['acessorios']; ?></h3>
                        </div>
                        <div class="card-footer">
                            Última atualização:
                            <?php echo date("d/m/Y H:i", strtotime($ultimas_atualizacoes['acessorios'])); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Card Faturamento Total -->
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Faturamento Total</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">R$ <?php echo number_format($faturamento_total, 2, ',', '.'); ?></h3>
                        </div>
                        <div class="card-footer">
                            Faturamento total acumulado nos últimos 7 dias
                        </div>
                    </div>
                </div>

                <!-- Card Agendamentos nos Últimos 7 Dias -->
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Agendamentos </strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $num_agendamentos_7d; ?></h3>
                        </div>
                        <div class="card-footer">
                            Agendamentos realizados nos últimos 7 dias
                        </div>
                    </div>
                </div>

                <!-- Card Produtos para Cães -->
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Produtos para Cães</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $total_produtos_caes; ?></h3>
                        </div>
                        <div class="card-footer">
                            Quantidade de produtos para cães
                        </div>
                    </div>
                </div>

                <!-- Card Produtos para Gatos -->
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Produtos para Gatos</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $total_produtos_gatos; ?></h3>
                        </div>
                        <div class="card-footer">
                            Quantidade de produtos para gatos
                        </div>
                    </div>
                </div>
            </div>
               <!-- Card Clientes -->
            <div class="row">
                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Total de Clientes</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $num_clientes; ?></h3>
                        </div>
                        <div class="card-footer">
                            Clientes totais (excluindo o administrador)
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Clientes Ativos</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $clientes_ativos; ?></h3>
                        </div>
                        <div class="card-footer">
                            Clientes que acessaram nos últimos 7 dias
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Compras de clientes  </strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $clientes_compraram; ?></h3>
                        </div>
                        <div class="card-footer">
                            Clientes que compraram nos últimos 7 dias
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="card dashboard-card card-custom">
                        <div class="card-header">
                            <strong>Novos Clientes</strong>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $novos_clientes; ?></h3>
                        </div>
                        <div class="card-footer">
                            Novos clientes registrados nos últimos 7 dias
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