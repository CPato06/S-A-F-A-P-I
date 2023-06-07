<?php include('conexion.php');
include('header.php'); 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos actualizados del formulario
    $rfid = $_POST['rfid'];
    $name = $_POST['Name'];
    $status = $_POST['status'];

    // Preparar la consulta SQL para actualizar los datos
    $query = "UPDATE dispositivos SET Name='$name', status='$status' WHERE rfid='$rfid'";
    $result = $conn->query($query);

    if ($result === TRUE) {
        //echo "Los datos han sido actualizados correctamente.";
        echo "<script>window.location.href='dispositivos.php';</script>";
     exit();
    } else {
        //echo "Error al actualizar los datos: " . $conn->error;
    }
}

$rfid = $_GET['rfid'];
$query = "SELECT * FROM dispositivos WHERE rfid='$rfid'";
$result = $conn->query($query);

$row = $result->fetch_assoc();

?>
<body>
    <div class="mx-auto" style="width: 600px;">
        <form method="POST">
            <div class="form-group row">
                <label for="rfid" class="col-sm-2 col-form-label">RFID: </label>
            </div>
            <div class="col-sm-10">
                <input id="rfid" class="form-control" name="rfid" value="<?php echo $row['rfid'] ?>">
            </div>
            <div class="form-group row">
                <label for="Name" class="col-sm-2 col-form-label">Name: </label>
            </div>
            <div class="col-sm-10">
                <input id="Name" class="form-control" name="Name" value="<?php echo $row['Name'] ?>">
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status: </label>
            </div>
            <div class="col-sm-10">
            <select name="status" id="status" class="col-sm-10" value="<?php echo $row['status'] ?>">
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