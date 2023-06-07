<?php
// Establecer la conexión con la base de datos
$servername = "database-api.cdjnyiihv9g0.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "Adminpato";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

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

