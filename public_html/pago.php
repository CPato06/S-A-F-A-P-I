<?php
require_once('db.php');
include_once "admin/db2.php";
$con = mysqli_connect($host, $user, $pass, $db);
$db = new DB();
session_start();

$usuario_id = $_SESSION['id'];
$carrito_id = $db->getCarrito($usuario_id);
$productos = $db->getProductosCarrito($carrito_id);

$queryUsuario = "SELECT * FROM usuarios WHERE id = '$usuario_id';";
$resUsuario=mysqli_query($con,$queryUsuario);
$rowUsuario=mysqli_fetch_assoc($resUsuario);

$queryDirec = "SELECT * FROM direcciones WHERE usuario = '$usuario_id';";
$resDirec=mysqli_query($con,$queryDirec);
$rowDirec=mysqli_fetch_assoc($resDirec);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Funko Shop</title>
    <meta name="twitter:" content="">
    <link rel="stylesheet" href="css/stripe.css">
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
  <section class="col-lg-8 connectedSortable" style="margin-left: 15%">
  <form action="pagar_carrito.php?carrito=<?php echo $carrito_id ?>" method="post" id="payment-form">
    <div class="row">
        <div class="col-6">
            <h3>Datos del cliente</h3>
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nombreCli" id="nombreCli" class="form-control" value="<?php echo $rowUsuario['nombre'] ?>" required="required">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="emailCli" id="emailCli" class="form-control" value="<?php echo $rowUsuario['correo'] ?>" required="required">
            </div>
        </div>
        <div class="col-6">
              <h3>Direccion:</h3>
              <div class="form-group">
                  <label for="">Calle y número</label>
                  <input type="text" name="nombreRec" id="nombreRec" class="form-control" value="<?php echo $rowDirec['calle'] ?>" required="required">
              </div>
              <div class="form-group">
                  <label for="">Código Postal</label>
                  <input type="number" name="emailRec" id="emailRec" class="form-control" value="<?php echo $rowDirec['cpostal'] ?>" required="required">
              </div>
              <div class="form-group">
                  <label for="">Referencias</label>
                  <textarea name="direccionRec" id="direccionRec" class="form-control" row="3" value=""><?php echo $rowDirec['referencias'] ?></textarea>
              </div>
          </div>
      </div>
      </div>
    <div class="form-row">
        <h4 class="mt3">Datos de su tarjeta</h4>
        <div id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="mt-3">
        <a class="btn btn-warning" href="carrito.php" role="button">Ir a carrito</a>
        <button type="submit" class="btn btn-primary float-right">Pagar</button>
    </div>
</form>
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
  </body>
  <script src="js/carrito4.js"></script>
  <script src="js/carrito2.js"></script>
  <script src="js/slider.js"></script>
  <script src="js/carrito.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="js/stripe.js"></script>
</html>
