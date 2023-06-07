<?php
include_once "db2.php";
$con = mysqli_connect($host, $user, $pass, $db);
if(isset($_REQUEST['borrarUsuario'])){
  $queryValidacion = "SELECT COUNT(*) as validacion FROM administradores;";
  $resValidacion=mysqli_query($con,$queryValidacion);
  $rowValidacion=mysqli_fetch_assoc($resValidacion);
  if ($rowValidacion['validacion'] > 1){
  $id= mysqli_real_escape_string($con,$_REQUEST['borrarUsuario']??'');
  $query="DELETE from administradores where ID_admin='$id';";
  $res=mysqli_query($con,$query);
  if($res){
      ?>
      <div class="alert alert-warning float-right" role="alert">
          El usuario ha sido eliminado exitosamente.
      </div>
      <?php
  }else{
      ?>
      <div class="alert alert-danger float-right" role="alert">
          Error al borrar <?php echo mysqli_error($con); ?>
      </div>
      <?php
  }
}
else {
  ?>
  <div class="alert alert-danger float-right" role="alert">
      Error al borrar. No puedes borrar al último administrador.
  </div>
  <?php
}
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Acciones
                    <a href="dashboard.php?modulo=crearUsuario"><i class="fa fa-plus" aria-hidden="true" title="Agregar Usuario"></i></a>
                  </th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $query = "SELECT ID_admin, nombre, correo from administradores";
                  $res = mysqli_query($con, $query);

                  while ($row = mysqli_fetch_assoc($res)) {
                 ?>
                <tr>
                  <td><?php echo $row['ID_admin'] ?>
                  <td><?php echo $row['nombre'] ?></td>
                  <td><?php echo $row['correo'] ?></td>
                  <td style="text-align: center">
                    <a href="dashboard.php?modulo=editarUsuario&id=<?php echo $row['ID_admin'] ?>" style="margin-right: 5px;" title="Editar Usuario">
                      <i class="fas fa-edit"></i> </a>
                    <a href="dashboard.php?modulo=usuarios&borrarUsuario=<?php echo $row['ID_admin'] ?>" class="text-danger borrar" title="Eliminar Usuario">
                      <i class="fas fa-trash"></i> </a>
                  </td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
