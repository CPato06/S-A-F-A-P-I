
<?php
$servername = "database-api.cdjnyiihv9g0.us-east-2.rds.amazonaws.com"; // Cambia esto si tu servidor de base de datos es diferente
$username = "admin";
$password = "Adminpato";
$dbname = "mydb";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Aquí puedes ejecutar consultas a la base de datos utilizando $conn
$query="SELECT u.Name, u.Lastname, s.Name as Status, r.Name as Rol, d.Name as Dispositivo FROM usuarios u INNER JOIN Status s ON s.id_status = u.Status INNER JOIN rol r ON r.id_rol = u.id_rol INNER JOIN dispositivos d ON d.rfid = u.dispositivo;";
// Cerrar la conexión
$conn->close();
?>


