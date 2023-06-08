<?php
include('conexion.php');

// Obtener los datos ingresados por el usuario
$user = $_POST['username'];
$pwd = $_POST['password'];

// Escapar caracteres especiales para prevenir inyección de SQL
$user = $conn->real_escape_string($user);
$pwd = $conn->real_escape_string($pwd);

// Consulta para verificar las credenciales del usuario
$sql = "SELECT * FROM Usuarios WHERE Correo_empresa = '$user' AND Contraseña = '$pwd'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    include_once 'main.php';
} else {
    // Inicio de sesión fallido
    include_once 'login.php'
}

// Cerrar la conexión
$conn->close();
?>

