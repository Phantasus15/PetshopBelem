<?php
$servername = "localhost";
$username = "root";
$password = "fapan";
$dbname = "petshop";

$conn = new mysqli($servername,$username,$password,$dbname);

//Confirmar conexão
if ($conn->connect_error) {
    die("connection failed: ".
    $conn->connect_error);
}
?>