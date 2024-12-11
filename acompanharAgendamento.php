<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    .main {
        height: 100vh;
        padding: 20px;
    }

    .container {
        background-color: #FFF;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
</style>
<?php
include("headerAdm.php");

include("conexao.php");

// Filtro de busca
$busca = isset($_GET['busca']) ? "%" . $conn->real_escape_string($_GET['busca']) . "%" : "%";

// Consulta SQL com filtro
$sql = "SELECT * FROM agendamentos WHERE nome LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $busca);
$stmt->execute();
$result = $stmt->get_result();
?>

<body>
    <div class="main">

        <div class="container mt-4">
            <h1>Agendamentos</h1>

            <!-- Campo de busca -->
            <form method="GET" action="agendamentos.php" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="busca" placeholder="Digite o nome do cliente"
                        value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Tabela de Agendamentos -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['sobrenome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['data']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['hora']) . "</td>";
                            echo "<td>";
                            echo "<form method='POST' action='logicaSistema/alterarStatus.php'>";
                            echo "<select name='status' class='form-control' onchange='this.form.submit()'>";
                            $status_options = ['Pendente', 'Confirmado', 'Cancelado'];
                            foreach ($status_options as $status) {
                                $selected = $row['status'] == $status ? 'selected' : '';
                                echo "<option value='$status' $selected>$status</option>";
                            }
                            echo "</select>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td><button class='btn btn-danger' onclick='confirmarDelecao(" . $row['id'] . ")'>Deletar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum agendamento encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            // Função para confirmar a exclusão
            function confirmarDelecao(id) {
                if (confirm("Tem certeza de que deseja excluir este agendamento?")) {
                    window.location.href = "logicaSistema/logicaDeletarAgendamento.php?id=" + id;
                }
            }
        </script>

    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>