<?php
include("conexao.php");

$id = $_GET['id'];
$sql = "SELECT * FROM produto WHERE id = $id";
$result = $conn->query($sql);
$produto = $result->fetch_assoc();
?>