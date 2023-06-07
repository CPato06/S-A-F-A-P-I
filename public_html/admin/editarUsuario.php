<?php
include_once "db2.php";
$con = mysqli_connect($host, $user, $pass, $db);
if (isset($_REQUEST['guardar'])) {

    $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['pass'] ?? ''));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');

    $query = "UPDATE administradores SET nombre = '$nombre', correo = '$email', contrasena = '$pass' WHERE ID_admin = '$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php?modulo=usuarios&mensaje=El Usuario '.$nombre.' ha sido editado exitosamente" />  ';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            Error al editar usuario <?php echo mysqli_error($con); ?>
        </div>
<?php
    }
}
$id= mysqli_real_escape_string($con,$_REQUEST['id']??'');
$query="SELECT ID_admin, nombre, correo, contrasena from administradores where ID_admin = '$id';";
$res=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($res);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar usuario</h1>
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
              <form class="dashboard.php?modulo=editarUsuario" method="post">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>" required="required" >
                </div>
                <div class="form-group">
                  <label>Correo</label>
                  <input type="email" name="email" class="form-control" value="<?php echo $row['correo'] ?>" required="required" >
                </div>
                <div class="form-group">
                  <label>Contraseña</label>
                  <input type="password" name="pass" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $row['ID_admin'] ?>">
                  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
                </div>
              </form>
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
