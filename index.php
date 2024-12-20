<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<style>
      .main {
        height: 100vh;
        padding: 20px;
    }
</style>
<?php
include("header.php");
?>

<body>
    <div class="main">
        <div class="linha">
            <div class="card">
                <h6>Destaque para Cães</h6>
                <ul class="lista">
                    <li>
                        <a href="listaRacao.php">
                            <div class="imagem">

                                <img class="icone" src="assets/racao.png" alt="">
                            </div>
                            <p>
                                Ração
                            </p>

                        </a>
                        
                    </li>
                    <li>
                        <a href="listaMedicamento.php">
                            <div class="imagem">

                                <img class="icone" src="assets/medicamento.png" alt="">
                            </div>
                            <p>
                                Medicamento
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="listaHigiene.php">
                            <div class="imagem">

                                <img class="icone" src="assets/banho.png" alt="">
                            </div>
                            <p>
                                Higiene
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="listaAcessorio.php">
                            <div class="imagem">

                                <img class="icone" src="assets/acessorios.png" alt="">
                            </div>
                            <p>
                                Acessorios
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <h6>Destaque para Gatos</h6>
                <ul class="lista">
                    <li>
                        <a href="listaRacaoGato.php">
                            <div class="imagem">

                                <img class="icone" src="assets/racao.png" alt="">
                            </div>
                            <p>
                                Ração
                            </p>

                        </a>
                        
                    </li>
                    <li>
                        <a href="listaMedicamentoGato.php">
                            <div class="imagem">

                                <img class="icone" src="assets/medicamento.png" alt="">
                            </div>
                            <p>
                                Medicamento
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="listaHigieneGato.php">
                            <div class="imagem">

                                <img class="icone" src="assets/banho.png" alt="">
                            </div>
                            <p>
                                Higiene
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="listaAcessorioGato.php">
                            <div class="imagem">

                                <img class="icone" src="assets/acessorios.png" alt="">
                            </div>
                            <p>
                                Acessorios
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="linha">
            <div class="card">
                <h6>Agende seu banho e tosa</h6>
                <ul class="lista">
                    <li>
                        <a href="criarAgendamento.php">
                            <div class="imagem">

                                <img class="icone" src="assets\banhoetosa.png" alt="">
                            </div>
                            <p>
                                Banho e tosa
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>