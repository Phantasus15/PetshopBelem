<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fapan";

$conn = new mysqli($servername,$username,$password,$dbname);

//Confirmar conexão
if ($conn->connect_error) {
    die("connection failed: ".
    $conn->connect_error);
}


?>