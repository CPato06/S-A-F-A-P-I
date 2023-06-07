<?php include('conexion.php'); ?>
<?php include('header.php'); ?>
<div class="content-header">
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="d-flex justify-content-end"><a href="AddUser.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Agregar</a></div><br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Status</th>
                        <th>Rol</th>
                        <th>Dispositivo</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  //$con=  mysqli_connect("localhost","irais","quintero23.","mydb");
                  $query="SELECT u.id_usuario, u.Name, u.Lastname, s.Name as Status, r.Name as Rol, d.Name as Dispositivo FROM usuarios u INNER JOIN Status s ON s.id_status = u.Status INNER JOIN rol r ON r.id_rol = u.id_rol INNER JOIN dispositivos d ON d.rfid = u.dispositivo;";
                  $datos = $conn->query($query);
                  while($row=mysqli_fetch_array($datos)){
                  ?>
                    <tr>
                       
                        <th><?php echo $row["Name"]?></th>
                        <th><?php echo $row["Lastname"]?></th>
                        <th><?php echo $row["Status"]?></th>
                        <th><?php echo $row["Rol"]?></th>
                        <th><?php echo $row["Dispositivo"]?></th>
                        <th>
                            <a href="editUser.php?id_usuario=<?php echo $row['id_usuario'] ?>" class="btn btn-info"><i class="fas fa-user-edit"></i></a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash-alt"></i></a>
                        </th>
                    </tr>
                    <?php } 
                    $conn->close();
                    ?>  
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">¿Seguro que quieres eliminar a este usuario?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="deleteuser.php?id_usuario=<?php echo $row['id_usuario']?>" class="btn btn-danger">Confirmar</a>
      </div>
    </div>
  </div>
</div>
</body>
</hmtl>
<?php include('footer.php'); ?>


 