<?php
  require_once('db.php');
  session_start();

  include_once "admin/db2.php";
  $con = mysqli_connect($host, $user, $pass, $db);
  $db = new DB();
  $userId = $_SESSION['id'];

  $queryPrimer = "SELECT DATE(fecha) AS fecha FROM ventas ORDER BY fecha LIMIT 1;";
  $resPrimer=mysqli_query($con,$queryPrimer);
  $rowPrimer=mysqli_fetch_assoc($resPrimer);

  $inicio = $rowPrimer['fecha'];

  $queryFinal = "SELECT DATE(fecha) AS fecha FROM ventas ORDER BY fecha DESC LIMIT 1;";
  $resFinal=mysqli_query($con,$queryFinal);
  $rowFinal=mysqli_fetch_assoc($resFinal);

  $final = $rowFinal['fecha'];

  $queryUsuario = "SELECT * FROM usuarios WHERE id = '$userId';";
  $resUsuario=mysqli_query($con,$queryUsuario);
  $rowUsuario=mysqli_fetch_assoc($resUsuario);

  $queryDirec = "SELECT * FROM direcciones WHERE usuario = '$userId';";
  $resDirec=mysqli_query($con,$queryDirec);
  $rowDirec=mysqli_fetch_assoc($resDirec);

  $queryDirecCont = "SELECT COUNT(*) as contador FROM direcciones WHERE usuario = '$userId';";
  $resDirecCont=mysqli_query($con,$queryDirecCont);
  $rowDirecCont=mysqli_fetch_assoc($resDirecCont);

  if ( isset($_REQUEST['guardar'])) {
    $inicio = $_REQUEST['fechaInicio']??'';
    $final = $_REQUEST['fechaFinal']??'';
  }

  if ( isset($_REQUEST['eliminar'])) {
    $queryEliminar = "UPDATE usuarios SET correo = '' WHERE id = '$userId';";
    $resEliminar=mysqli_query($con,$queryEliminar);
  }
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Funko Shop</title>
    <meta name="twitter:" content="">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="img/Decoracion/Logo.png" />
  </head>
  <body>
    <header class="main-header2">
              <div class="container2 container--flex2">
                <div class="main-header__container2">
                  <h1 class="main-header__title2">Comics Funko Shop</h1>
                  <span class="icon-menu2" id="btn-menu"><i class="fas fa-bars"></i></span>
                  <nav class="main-nav2" id="main-nav">
                    <ul class="menu2">
                      <li class="menu__item2"><a href="index.php" class="menu__link2">Inicio</a></li>
                      <li class="menu__item2"><a href="productos.php" class="menu__link2">Productos</a></li>
                      <li class="menu__item2"><a href="contact.php" class="menu__link2">Contáctanos</a></li>
                    </ul>
                  </nav>
                </div>
                <div class="main-header__container2">
                  <p class="main-header__txt2">Envíos gratis a partir de $999</p>
                </div>
                <div class="main-header__container2">
                  <?php
                  if(isset($_SESSION['email'])):?>
                    <a href="carrito.php" class="main-header__btn2">Carrito <i class="fas fa-shopping-cart"></i></a>
                    <a href="editarUsuario.php" class="main-header__link2"><i class="fas fa-user"></i></a>
                    <a href="cerrar_sesion.php"  class="main-header__link2"><i class="fas fa-sign-out-alt"></i></a>
                  <?php else:?>
                    <a href="iniciar_sesion.php" class="main-header__link2"><i class="fas fa-user"></i></a>
                  <?php endif;?>
                </div>
              </div>
  </header>
  <section class="content" style="margin-left: 20px">
    <h1>Datos del usuario:</h1>
    <p>Nombre: <?php echo $rowUsuario['nombre'] ?></p>
    <p>Correo: <?php echo $rowUsuario['correo'] ?></p>
    <button type="button" name="button"><a href="editarUsuario.php" class="quitar_formato2">Modificar mis datos</a></button>
    <button type="button" name="eliminar" style="color:red" onclick="myFunction()">Eliminar usuario</button>
    <script>
    function myFunction() {
      if(confirm("¿Realmente quiere eliminar su usuario?")==true){
         location.href = "eliminarUsuario.php?carrito=<?php echo $userId ?>";
      }
    }
</script> <br> <br>
  <h3>Dirección del usuario:</h3>
<?php if ($rowDirecCont['contador'] <=0): ?>
  <br>
  <button type="button" name="button"><a href="registrarDireccion.php" class="quitar_formato2">+ Registrar mi direccion</a></button>
<?php else: ?>
  <p>Calle y número: <?php echo $rowDirec['calle'] ?></p>
  <p>Código Postal: <?php echo $rowDirec['cpostal'] ?></p>
  <p>Referencias: <?php echo $rowDirec['referencias'] ?></p>
  <button type="button" name="button"><a href="editarDireccion.php" class="quitar_formato2">Editar mi direccion</a></button>
<?php endif; ?>
    <br> <br> <br>
    <h1>Historial de compras</h1>
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
                  <th>Fecha</th>
                  <th>Total de la venta</th>
                  <th>Productos comprados</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * from ventas WHERE usuario = '$userId' AND CONVERT(fecha, date) BETWEEN DATE '$inicio' AND '$final'";
                    $res = mysqli_query($con, $query);

                      while ($row = mysqli_fetch_assoc($res)) {
                        $queryUser = "SELECT nombre, correo FROM usuarios  WHERE id = $row[usuario];";
                        $resUser = mysqli_query($con, $queryUser);
                        $rowUser = mysqli_fetch_assoc($resUser);
                 ?>
                <tr>
                  <td><?php echo $row['fecha'] ?></td>
                  <td><?php echo '$'.$row['ventaTotal'].' '?></td>
                  <td>
                  <?php
                  $queryProd = "SELECT C.producto_id, C.cantidad, P.nombre, P.imagen FROM carrito_productos C JOIN productos P ON C.producto_id = P.id WHERE carrito_id = $row[carritoID];";
                  $resProd = mysqli_query($con, $queryProd);
                    while ($rowProd = mysqli_fetch_assoc($resProd)) {
                   ?>
                   <img style="width: 10%; height:  10%;" src="<?php echo $rowProd['imagen']?>" alt="">
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
<footer class="main-footer2">
          <div class="footer__section">
            <h2 class="footer__title2">Acerca de nosotros</h2>
            <p class="footer__txt2">Somos un grupo de 3 amantes de los comics y el coleccionismo con el objetivo de llevar nuestro hobby a muchos hogares.</p>
          </div>
          <div class="footer__section">
            <h2 class="footer__title2">Ubicación:</h2>
            <p class="footer__txt2">Carr. Transpeninsular, Chametla, 23205 La Paz, B.C.S.</p>
            <h2 class="footer__title2">Contacto</h2>
            <p class="footer__txt2">Teléfono : +52 612 204 4457</p>
            <p class="footer__txt2">Email : contactocarlos@gmail.com</p>
          </div>
          <div class="footer__section">
            <h2 class="footer__title2">Enlaces Directos</h2>
            <a href="index.php" class="footer__link2">Inicio</a>
            <a href="productos.php" class="footer__link2">Productos</a>
            <a href="contact.php" class="footer__link2">Contáctanos</a>
          </div>
          <div class="footer__section">
            <h2 class="footer__title2">Registrate para recibir ofertas</h2>
            <p class="footer__txt2">Suscribete a nuestro newsletter para estar siempre informado de nuestras ofertas y novedades.</p>
            <input type="email" class="footer__input2" placeholder="Ingresa tu email">
          </div>
        </footer>
<script src="js/carrito.js"></script>
</body>
</html>
