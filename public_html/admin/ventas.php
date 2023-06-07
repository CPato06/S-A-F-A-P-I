<?php
include_once "db2.php";
$con = mysqli_connect($host, $user, $pass, $db);

$queryPrimer = "SELECT DATE(fecha) AS fecha FROM ventas ORDER BY fecha LIMIT 1;";
$resPrimer=mysqli_query($con,$queryPrimer);
$rowPrimer=mysqli_fetch_assoc($resPrimer);

$inicio = $rowPrimer['fecha'];

$queryFinal = "SELECT DATE(fecha) AS fecha FROM ventas ORDER BY fecha DESC LIMIT 1;";
$resFinal=mysqli_query($con,$queryFinal);
$rowFinal=mysqli_fetch_assoc($resFinal);

$final = $rowFinal['fecha'];

if ( isset($_REQUEST['guardar'])) {
  $inicio = $_REQUEST['fechaInicio']??'';
  $final = $_REQUEST['fechaFinal']??'';
}

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Ventas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <label>Filtrar por fecha:</label>
    <form method="post">
    <div class="form-inline" style="margin-bottom: 5px">
      <div class="form-group">
        <input type="date" value="<?php echo $inicio ?>" name="fechaInicio" class="form-control" style="margin-left: 5px; margin-right: 5px; width: 200px">
      </div>
      <label for="">   -    </label>
      <input type="date" value="<?php echo $final ?>" name="fechaFinal" class="form-control" style="margin-left: 5px; margin-right: 5px; width: 200px">
      <button type="submit" name="guardar" class="btn btn-primary">Filtrar</button>
    </div>
    </form>

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
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>Total de la venta</th>
                  <th>Productos comprados</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * from ventas WHERE CONVERT(fecha, date) BETWEEN DATE '$inicio' AND '$final'";
                    $res = mysqli_query($con, $query);

                      while ($row = mysqli_fetch_assoc($res)) {
                        $queryUser = "SELECT nombre, correo FROM usuarios  WHERE id = $row[usuario];";
                        $resUser = mysqli_query($con, $queryUser);
                        $rowUser = mysqli_fetch_assoc($resUser);
                 ?>
                <tr>
                  <td><?php echo $row['ID_venta'] ?>
                  <td><?php echo $row['fecha'] ?></td>
                  <td><?php echo $rowUser['nombre']?> <br> <?php echo $rowUser['correo']?></td>
                  <td><?php echo '$'.$row['ventaTotal'].' '?></td>
                  <td>
                  <?php
                  $queryProd = "SELECT C.producto_id, C.cantidad, P.nombre FROM carrito_productos C JOIN productos P ON C.producto_id = P.id WHERE carrito_id = $row[carritoID];";
                  $resProd = mysqli_query($con, $queryProd);
                    while ($rowProd = mysqli_fetch_assoc($resProd)) {
                   ?>
                  <?php echo $rowProd['nombre']?> - (<?php echo $rowProd['cantidad']?>) <br>
                  <?php
                } ?>
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
