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

// Obtener los datos del formulario de registro
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$nombre_empresa = $_POST['nombre_empresa'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];

// Consulta para insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (correo, contraseña, nombre_empresa, nombre, apellido_paterno, apellido_materno) VALUES ('$correo', '$contraseña', '$nombre_empresa', '$nombre', '$apellido_paterno', '$apellido_materno')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. Usuario registrado correctamente.";
} else {
    echo "Error al registrar usuario: " . $conn->error;
}

// Cerrar la conexión con la base de datos
$conn->close();
?>
