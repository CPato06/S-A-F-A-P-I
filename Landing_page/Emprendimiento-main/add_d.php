<?php include('conexion.php');
include('header.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $rfid = $_POST['rfid'];
    $name = $_POST['Name'];
    $status = $_POST['status'];

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO dispositivos (rfid, Name, status) VALUES ('$rfid', '$name', '$status')";

    if ($conn->query($sql) === TRUE) {
        // Los datos fueron insertados correctamente
        //echo "Los datos han sido insertados correctamente.";
        echo "<script>window.location.href='dispositivos.php';</script>";
        exit();
    } else {
        // Ocurrió un error al insertar los datos
       // echo "Error al insertar los datos: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
<body>
    <div class="mx-auto" style="width: 600px;">
        <form method="POST">
            <div class="form-group row">
                <label for="rfid" class="col-sm-2 col-form-label">RFID: </label>
            </div>
            <div class="col-sm-10">
                <input id="rfid" class="form-control" name="rfid" value="">
            </div>
            <div class="form-group row">
                <label for="Name" class="col-sm-2 col-form-label">Name: </label>
            </div>
            <div class="col-sm-10">
                <input id="Name" class="form-control" name="Name" value="">
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status: </label>
            </div>
            <div class="col-sm-10">
            <select name="status" id="status" class="col-sm-10">
                <option value="Disponible">Disponible</option>
                <option value="No disponible">No disponible</option>
            </select>
            </div>
            <button type="submit" class="btn btn-success mt-2">Agregar</button>
            <a href="dispositivos.php" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
  
</body>
<?php include('footer.php'); ?>