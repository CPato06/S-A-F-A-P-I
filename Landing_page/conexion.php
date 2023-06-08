<?php
// Establecer la conexión con la base de datos
$servername = "database-api.cdjnyiihv9g0.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "Adminpato";
$dbname = "FFF";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>