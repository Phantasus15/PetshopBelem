<?php include("header.php"); ?>
<?php
// Conexão com o banco de dados
include("conexao.php");

// Verificar se o cliente está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<div class='alert alert-danger'>Você precisa estar logado para acessar seus agendamentos.</div>";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Obter agendamentos do cliente logado
$sql = "
    SELECT 
        id, nome, sobrenome, profissional, raca, data, hora, telefone, mensagem, status
    FROM 
        agendamentos
    WHERE 
        usuario_id = ?
    ORDER BY 
        data DESC, hora ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$agendamentos = [];
while ($row = $result->fetch_assoc()) {
    $agendamentos[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<style>
      .main {
        height: 100vh;
        padding: 20px;
    }
    .container{
        overflow-y: scroll;
        scrollbar-width: none; 
        -ms-overflow-style: none;
        background-color: #FFF;
    }
</style>
<body>
    <div class="main">

        <div class="container mt-5">
            <h1 class="mb-4">Meus Agendamentos</h1>

            <!-- Listagem de agendamentos -->
            <?php if (!empty($agendamentos)): ?>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>Agendamento ID:</strong> <?= $agendamento['id'] ?> |
                            <strong>Data:</strong> <?= date("d/m/Y", strtotime($agendamento['data'])) ?> |
                            <strong>Horário:</strong> <?= $agendamento['hora'] ?> |
                            <strong>Status:</strong> <?= $agendamento['status'] ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Nome do Cliente:</strong> <?= $agendamento['nome'] . ' ' . $agendamento['sobrenome'] ?>
                            </p>
                            <p><strong>Profissional:</strong> <?= $agendamento['profissional'] ?></p>
                            <p><strong>Raça:</strong> <?= $agendamento['raca'] ?></p>
                            <p><strong>Telefone:</strong> <?= $agendamento['telefone'] ?></p>
                            <p><strong>Mensagem:</strong> <?= $agendamento['mensagem'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Você ainda não tem agendamentos.</p>
            <?php endif; ?>

        </div>
    </div>
</body>
<?php
include("footer.php");
?>
</html>