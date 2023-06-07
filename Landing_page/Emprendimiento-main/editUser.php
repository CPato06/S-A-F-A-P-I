
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
 
 $id = $_GET['id_usuario'];
 $name = $_POST['Name'];
 $lastname = $_POST['Lastname'];
 $status = $_POST['status'];
 $rol = $_POST['rol'];
 $dispositivo = $_POST['dispositivo'];
 // Actualizar los datos del usuario en la base de datos
 $query = "UPDATE usuarios SET Name='$name', Lastname='$lastname', Status='$status', id_rol='$rol', dispositivo='$dispositivo' WHERE id_usuario='$id'";
 $result = $conn->query($query);

 // Verificar si la actualización se realizó correctamente
 if ($result === TRUE) {
     //echo "Datos del usuario actualizados correctamente.";
     echo "<script>window.location.href='usuarios.php';</script>";
     exit();
        
 } else {
     //echo "Error al actualizar los datos del usuario: " . $conn->error;
 }

 }

// Obtener los datos del usuario de la base de datos
$id_usuario = $_GET['id_usuario'];
$query = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
$result = $conn->query($query);

// Verificar si se encontraron datos del usuario
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Obtener los datos de los dispositivos
    $sql = "SELECT rfid, Name FROM dispositivos";
    $result_dispositivos = $conn->query($sql);

    // Obtener los datos de los roles
    $sql3 = "SELECT id_rol, Name FROM rol";
    $result_roles = $conn->query($sql3);

    // Obtener los datos de los estados
    $sql2 = "SELECT id_status, Name FROM status";
    $result_estados = $conn->query($sql2);
} else {
    //echo "No se encontraron datos del usuario.";
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
                <input type="text" id="Name" class="form-control" name="Name" value="<?php echo $row['Name'] ?>">
            </div>
            <div class="form-group row">
                <label for="Lastname" class="col-sm-2 col-form-label">Lastame: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" id="Lastname" class="form-control" name="Lastname" value="<?php echo $row['Lastname'] ?>">
            </div>
            <div class="form-group row">
                <label for="dispositivos" class="col-sm-2 col-form-label">Dispositivo: </label>
            </div>
            <div class="col-sm-10">
                <select id="dispositivo" name="dispositivo" class="col-sm-10">
                <?php
                    while ($row = $result_dispositivos->fetch_assoc()) {
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
                    while ($row = $result_roles->fetch_assoc()) {
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
                    while ($row = $result_estados->fetch_assoc()) {
                        echo "<option value='" . $row['id_status'] . "'>" . $row['Name'] . "</option>";
                    }
                ?>
            </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Save</button>
            <a href="usuarios.php" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
</body>
<?php include('footer.php'); ?>