<?php
include_once "db2.php";
$con = mysqli_connect($host, $user, $pass, $db);

$queryNumVentas="SELECT COUNT(*) AS num from ventas
where fecha BETWEEN DATE( DATE_SUB(NOW(),INTERVAL 7 DAY) ) AND NOW(); ";
$resNumVentas=mysqli_query($con,$queryNumVentas);
$rowNumVentas=mysqli_fetch_assoc($resNumVentas);

$queryVentasHoy="SELECT COUNT(*) AS num from ventas
where fecha BETWEEN DATE( DATE_SUB(NOW(),INTERVAL 0 DAY) ) AND NOW(); ";
$resVentasHoy=mysqli_query($con,$queryVentasHoy);
$rowVentasHoy=mysqli_fetch_assoc($resVentasHoy);

$queryNumClientes="SELECT COUNT(*) AS num from usuarios; ";
$resNumClientes=mysqli_query($con,$queryNumClientes);
$rowNumClientes=mysqli_fetch_assoc($resNumClientes);

$contador = 0;
$contador2 = 0;
$queryClientes="SELECT * FROM usuarios;";
$resClientes=mysqli_query($con,$queryClientes);
while($rowClientes=mysqli_fetch_assoc($resClientes)){
  $queryVentas= "SELECT usuario FROM ventas WHERE usuario = $rowClientes[id];";
  $resVentas=mysqli_query($con,$queryVentas);
  $row_cnt = mysqli_num_rows($resVentas);
    if($row_cnt > 0){
      $contador = $contador + 1;
    }
    $contador2 = $contador2 + 1;
  }

  $queryClientes2="SELECT * FROM usuarios WHERE correo = '';";
  $resClientes2=mysqli_query($con,$queryClientes2);
  while($rowClientes2=mysqli_fetch_assoc($resClientes2)){
    $queryVentas2= "SELECT usuario FROM ventas WHERE usuario = $rowClientes2[id];";
    $resVentas2=mysqli_query($con,$queryVentas2);
    $row_cnt2 = mysqli_num_rows($resVentas2);
      if($row_cnt2 > 0){
        $contador = $contador - 1;
      }
      $contador2 = $contador2 - 1;
    }
$datosClientes=$contador2.",";
$datosClientes=$datosClientes.$contador;
$datosClientes=rtrim($datosClientes,",");

$queryNumProducto="SELECT C.producto_id, P.nombre, SUM( C.cantidad ) AS num FROM  carrito_productos C JOIN productos P ON C.producto_id = P.id GROUP BY C.producto_id ORDER BY num DESC LIMIT 10; ";
$resNumProducto=mysqli_query($con,$queryNumProducto);
$labelProducto="";
$datosProducto="";
while($rowNumProducto=mysqli_fetch_assoc($resNumProducto)){
  $labelProducto=$labelProducto."'".$rowNumProducto['nombre']."',";
  $datosProducto=$datosProducto.$rowNumProducto['num'].",";
}

$labelProducto=rtrim($labelProducto,",");
$datosProducto=rtrim($datosProducto,",");

$queryVentasDia="SELECT sum(ventaTotal) as total, fecha FROM ventas GROUP BY DAY(fecha) ORDER BY fecha;";
$resVentasDia=mysqli_query($con,$queryVentasDia);
$labelVentas="";
$datosVentas="";

while($rowVentasDia=mysqli_fetch_assoc($resVentasDia)){
  $labelVentas=$labelVentas."'". date_format(date_create($rowVentasDia['fecha']),"Y-m-d")."',";
  $datosVentas=$datosVentas.$rowVentasDia['total'].",";
}
$labelVentas=rtrim($labelVentas,",");
$datosVentas=rtrim($datosVentas,",");

$queryVentasDia2="SELECT sum(ventaTotal-200) as total, fecha FROM ventas GROUP BY DAY(fecha) ORDER BY fecha;";
$resVentasDia2=mysqli_query($con,$queryVentasDia2);
$datosVentas2="";

while($rowVentasDia2=mysqli_fetch_assoc($resVentasDia2)){
  $datosVentas2=$datosVentas2.$rowVentasDia2['total'].",";
}
$datosVentas2=rtrim($datosVentas2,",");

$queryVentasXDia="SELECT COUNT(*) as tVentas, fecha FROM ventas GROUP BY DAY(fecha) ORDER BY fecha;";
$resVentasXDia=mysqli_query($con,$queryVentasXDia);
$datosVentasDia="";
while($rowVentasXDia=mysqli_fetch_assoc($resVentasXDia)){
  $datosVentasDia=$datosVentasDia.$rowVentasXDia['tVentas'].",";
}
$datosVentasDia=rtrim($datosVentasDia,",");
?>
<script>
  var labelVentas=[<?php echo $labelVentas; ?>];
  var datosVentas=[<?php echo $datosVentas; ?>];
  var datosVentas2=[<?php echo $datosVentas2; ?>];
  var diaVentas=[<?php echo $datosVentasDia; ?>];
  var labelProducto=[<?php echo $labelProducto; ?>];
  var datosProducto=[<?php echo $datosProducto; ?>];
  var datosClientes=[<?php echo $datosClientes; ?>];
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Estadísticas</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $rowNumVentas['num']; ?></h3>

              <p>Ventas en la última semana</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $contador2 ?></h3>

              <p>Usuarios registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $contador?></h3>

              <p>Clientes totales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $rowVentasHoy['num']; ?></h3>

              <p>Ventas de hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Relacion ganancias - ventas
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                 </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Ventas por dia
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas2" height="300" style="height: 300px;"></canvas>
                 </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>

        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Productos más vendidos
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas3" height="300" style="height: 300px;"></canvas>
                 </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>

        <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Relacion Usuarios - Clientes
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas4" height="300" style="height: 300px;"></canvas>
                 </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map card -->
          <div class="card bg-gradient-primary">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-map-marker-alt mr-1"></i>
                Visitantes por estado
              </h3>
              <!-- card tools -->
              <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <div class="card-body" style="color: #a5bfdd">
              <div id="vmap" style="width: 450px; height: 300px;"></div>
            </div>
          </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
