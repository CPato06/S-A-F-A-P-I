<?php
include_once "db2.php";
$con = mysqli_connect($host, $user, $pass, $db);
if(isset($_REQUEST['borrarProducto'])){
  $id= mysqli_real_escape_string($con,$_REQUEST['borrarProducto']??'');
  $query="DELETE from productos where id='$id';";
  $res=mysqli_query($con,$query);
  if($res){
      ?>
      <div class="alert alert-warning float-right" role="alert">
          El producto ha sido eliminado exitosamente.
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
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Productos
            <a href="dashboard.php?modulo=agregarProducto"><i class="fa fa-plus" aria-hidden="true" title="Agregar Producto"></i></a>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Productos</li>
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
                  <th>Precio</th>
                  <th>Existencias</th>
                  <th>Tipo</th>
                  <th>Marca</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $query = "SELECT * from productos";
                  $res = mysqli_query($con, $query);

                  while ($row = mysqli_fetch_assoc($res)) {
                 ?>
                <tr>
                  <td><?php echo $row['id'] ?>
                  <td><?php echo $row['nombre'] ?></td>
                  <td><?php echo '$'.$row['precio'].' '?></td>
                  <td><?php echo $row['existencia'] ?></td>
                  <td><?php echo $row['tipo'] ?></td>
                  <td><?php echo $row['marca'] ?></td>
                  <td style="text-align: center">
                    <a href="dashboard.php?modulo=editarProducto&id=<?php echo $row['id'] ?>" style="margin-right: 5px;" title="Editar Producto">
                      <i class="fas fa-edit"></i> </a>
                    <a href="dashboard.php?modulo=productos&borrarProducto=<?php echo $row['id'] ?>" class="text-danger borrar" title="Eliminar Producto" name="borrar2">
                      <i class="fas fa-trash" ></i> </a>
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
