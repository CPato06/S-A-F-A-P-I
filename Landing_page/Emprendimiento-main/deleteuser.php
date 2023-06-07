<?php 
// include("conexion.php");
// $conn = new mysqli($servername, $username, $password, $dbname);
// $id = $_GET['id_usuario'];
// $sql = "DELETE FROM usuarios WHERE id_usuario = '$id'";
// if(mysqli_query($conn,$sql)){
//     echo "<script>window.location.href='usuarios.php';</script>";
// exit();
// }
// else{
// Header("Location: ../error404.html");
// }
// mysqli_close($conn);
include('conexion.php');
// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
// Obtener el ID del usuario a borrar
$id = $_GET['id_usuario'];

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Ejecutar la consulta SQL para borrar el usuario
$sql = "DELETE FROM usuarios WHERE id_usuario = '$id'";

if ($conn->query($sql) === TRUE) {
    // El usuario fue borrado exitosamente
    echo "El usuario ha sido borrado correctamente.";
} else {
    // Ocurrió un error al borrar el usuario
    echo "Error al borrar el usuario: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>