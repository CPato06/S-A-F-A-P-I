<?php include('header.php'); ?>
<div class="content-header">
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
</div>

<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Consumo mensual en watts</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="consumo-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Consumo mensual en pesos</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="gasto-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Consumo total en watts</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="total-watts-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Consumo total en pesos</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="costo-total-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
<?php include('footer.php'); ?>
<?php include('datos.php'); ?>


<script>
  // Obtén una referencia al elemento canvas
  var consumoChart = document.getElementById('consumo-chart').getContext('2d');

  // Construye el array de datasets con los datos de consumo por usuario
  var datasets = [];
  <?php foreach ($consumoPorUsuario as $usuario => $consumo) : ?>
    datasets.push({
      label: '<?php echo $usuario; ?>',
      data: <?php echo json_encode($consumo); ?>,
      fill: false,
      borderColor: getRandomColor(),
      borderWidth: 1
    });
  <?php endforeach; ?>

  // Define los datos y las etiquetas para la gráfica
  var consumoData = {
    labels: <?php echo json_encode($meses); ?>,
    datasets: datasets
  };

  // Configura las opciones de la gráfica
  var consumoOptions = {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Crea la gráfica utilizando Chart.js
  var chart = new Chart(consumoChart, {
    type: 'line',
    data: consumoData,
    options: consumoOptions
  });

  // Función auxiliar para generar colores aleatorios para las líneas
  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }


  //Grafica de gasto

   // Obtén una referencia al elemento canvas
   var gastoChart = document.getElementById('gasto-chart').getContext('2d');

   // Calcula el gasto en pesos para cada usuario
   var gastoPorUsuario = {};
   <?php foreach ($consumoPorUsuario as $usuario => $consumo) : ?>
      var conversion = <?php echo $tasaConversion; ?>;
      var gasto = <?php echo json_encode($consumo); ?>.map(function(watts) {
      return watts * conversion;
    });
      gastoPorUsuario['<?php echo $usuario; ?>'] = gasto;
    <?php endforeach; ?>

    // Define los datos y las etiquetas para la gráfica
    var gastoData = {
      labels: <?php echo json_encode($meses); ?>,
      datasets: Object.keys(gastoPorUsuario).map(function(usuario) {
        return {
          label: usuario,
          data: gastoPorUsuario[usuario],
          backgroundColor: getRandomColor(),
          borderColor: getRandomColor(),
          borderWidth: 1
        };
      })
    };

    // Configura las opciones de la gráfica
    var gastoOptions = {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        },
        x: {
          stacked: true
        }
      }
    };

    // Crea la gráfica utilizando Chart.js
    var chart = new Chart(gastoChart, {
      type: 'bar',
      data: gastoData,
      options: gastoOptions
    });

  // Obtén una referencia a los elementos canvas
  var totalWattsChart = document.getElementById('total-watts-chart').getContext('2d');
  var costoTotalChart = document.getElementById('costo-total-chart').getContext('2d');

  // Calcula el total de watts y el costo total por mes
  var totalWatts = [];
  var costoTotal = [];
  <?php foreach ($meses as $index => $mes) : ?>
    var sumWatts = <?php echo array_sum(array_column($consumoPorUsuario, $index)); ?>;
    var sumCosto = sumWatts * <?php echo $tasaConversion; ?>;
    totalWatts.push(sumWatts);
    costoTotal.push(sumCosto);
  <?php endforeach; ?>

  // Define los datos y las etiquetas para la gráfica de total de watts
  var totalWattsData = {
    labels: <?php echo json_encode($meses); ?>,
    datasets: [{
      label: 'Total de Watts',
      data: totalWatts,
      backgroundColor: getRandomColor(),
      borderColor: getRandomColor(),
      borderWidth: 1
    }]
  };

  // Configura las opciones de la gráfica de total de watts
  var totalWattsOptions = {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Crea la gráfica de total de watts utilizando Chart.js
  var totalWattsChartObj = new Chart(totalWattsChart, {
    type: 'line',
    data: totalWattsData,
    options: totalWattsOptions
  });

  // Define los datos y las etiquetas para la gráfica de costo total
  var costoTotalData = {
    labels: <?php echo json_encode($meses); ?>,
    datasets: [{
      label: 'Costo Total (Pesos)',
      data: costoTotal,
      backgroundColor: getRandomColor(),
      borderColor: getRandomColor(),
      borderWidth: 1
    }]
  };

  // Configura las opciones de la gráfica de costo total
  var costoTotalOptions = {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Crea la gráfica de costo total utilizando Chart.js
  var costoTotalChartObj = new Chart(costoTotalChart, {
    type: 'bar',
    data: costoTotalData,
    options: costoTotalOptions
  });
</script>

