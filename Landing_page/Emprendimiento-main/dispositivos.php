<?php include('conexion.php'); ?>
<?php include('header.php'); ?>
<div class="content-header">
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dispositivos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
              <li class="breadcrumb-item active">Dispositivos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="d-flex justify-content-end"><a href="add_d.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Agregar</a></div><br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>RFID</th>
                        <th>Nombre</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  $query= "SELECT * FROM `dispositivos`;"; 
                  $datos = $conn->query($query);
                  while($row=mysqli_fetch_array($datos)){
                  ?>
                    <tr>
                        <th><?php echo $row["rfid"]?></th>
                        <th><?php echo $row["Name"]?></th>
                        <th><?php echo $row["Status"]?></th>
                        <th>
                            <a href="edit_d.php?rfid=<?php echo $row['rfid'] ?>" class="btn btn-info"><i class="fas fa-user-edit"></i></a>
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
        <a href="dispositivos.php?rfid=<?php echo $row['rfid'] ?>" class="btn btn-danger">Confirmar</a>
      </div>
    </div>
  </div>
</div>
</body>
</hmtl>
<?php include('footer.php'); ?>