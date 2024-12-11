<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<style>
    .cards {
        background-color: #F9E3BECC;
        padding: 10px;
        margin: 15px;
        border-radius: 12px;
        height: 500px;
        width: 300px;
        text-align: center;
        cursor: pointer;
    }
    .container{
        overflow-y: scroll;
        scrollbar-width: none; 
        -ms-overflow-style: none;
    }
</style>
<?php
include("header.php");
include("conexao.php"); 

?>

<body>
    <div class="main">
        <div class="container" >
            <h1>Higiene para gatos:</h1>

            <div class="row g-2">
                <?php
                $sql = "SELECT * FROM produto WHERE categoria ='Higiene' AND animal='gato'";
                $result = $conn->query($sql);

                if ($result === false) {
                    die("Erro na consulta SQL: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-4">';
                        echo '    <div class="cards">';
                        echo '      <img src="' . $row["img"] . '" alt="Descrição da imagem" width="100%" height="350" />';
                        echo '        <div class="card-body">';
                        echo '            <h5 class="card-title"><a href="detalheProduto.php?id=' . $row["id"] . '" class="text-primary text-decoration-none">' . $row["nome"] . '</a></h5>';
                        echo '            <h6 class="card-subtitle mb-2 text-muted">Preço: R$ ' . number_format($row["preco"], 2, ',', '.') . '</h6>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Nenhum produto encontrado.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

<?php
include("footer.php");
?>
</html>