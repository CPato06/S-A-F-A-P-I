<?php
include('conexion.php');
// Obtener los datos del formulario de inicio de sesión
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];

// Consulta preparada para verificar si los datos son correctos
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasenia = ?");
$stmt->bind_param("ss", $usuario, $contrasenia);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se encontraron registros en la base de datos
if ($resultado->num_rows > 0) {
    // Inicio de sesión exitoso
    session_start();
    $_SESSION['usuario'] = $usuario;
    echo "Inicio de sesión exitoso. Bienvenido, $usuario!";
} else {
    // Inicio de sesión fallido
    echo "Usuario o contraseña incorrectos. Por favor, inténtalo nuevamente.";
}

// Cerrar la conexión con la base de datos
$stmt->close();
$conn->close();
?>

