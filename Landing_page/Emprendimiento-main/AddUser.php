
<?php include('conexion.php');
include('header.php'); 
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT rfid, Name FROM dispositivos";
$sql2 = "SELECT id_status, Name FROM status";
$sql3 = "SELECT id_rol, Name FROM rol";
$result = $conn->query($sql);
$result2=$conn->query($sql2);
$result3=$conn->query($sql3);

 // Obtener los datos del formulario
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name = $_POST['Name'];
 $lastname = $_POST['Lastname'];
 $status = $_POST['status'];
 $rol = $_POST['rol'];
 $dispositivo = $_POST['dispositivo'];

 $query = "INSERT INTO usuarios (Name, Lastname, Status, id_rol,  dispositivo) VALUES ('$name', '$lastname', '$status','$rol' ,'$dispositivo')";
 $result4 = $conn->query($query);
 if ($result4 === TRUE) {
    echo "Registro agregado exitosamente";
} else {
    echo "Error al agregar el registro: " . $conn->error;
}
 }
$conn->close();
?>
<body>
    <div class="mx-auto" style="width: 600px;">
        <form method="POST">
            <div class="form-group row">
                <label for="Name" class="col-sm-2 col-form-label">Name: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" id="Name" class="form-control" name="Name" value="">
            </div>
            <div class="form-group row">
                <label for="Lastname" class="col-sm-2 col-form-label">Lastame: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" id="Lastname" class="form-control" name="Lastname" value="">
            </div>
            <div class="form-group row">
                <label for="dispositivos" class="col-sm-2 col-form-label">Dispositivo: </label>
            </div>
            <div class="col-sm-10">
                <select id="dispositivo" name="dispositivo" class="col-sm-10">
                <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['rfid'] . "'>" . $row['Name'] . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="rol" class="col-sm-2 col-form-label">Rol: </label>
            </div>
            <div class="col-sm-10">
                <select id="rol" name="rol" class="col-sm-10">
                <?php
                    while ($row = $result3->fetch_assoc()) {
                        echo "<option value='" . $row['id_rol'] . "'>" . $row['Name'] . "</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status: </label>
            </div>
            <div class="col-sm-10">
            <select name="status" id="status" class="col-sm-10">
                <?php
                    while ($row = $result2->fetch_assoc()) {
                        echo "<option value='" . $row['id_status'] . "'>" . $row['Name'] . "</option>";
                    }
                ?>
            </select>
            </div>
            <button type="submit" class="btn btn-success mt-2">Agregar</button>
            <a href="usuarios.php" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
  
</body>
<?php include('footer.php'); ?>