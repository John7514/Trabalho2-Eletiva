<?php
$host = "localhost";
$user = "root"; // Altere se necessário
$pass = "";     // Altere se necessário
$db   = "sistema_faculdade";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>