<?php
  require_once('db.php');
  session_start();

  include_once "admin/db2.php";
  $con = mysqli_connect($host, $user, $pass, $db);
  $db = new DB();
  $productos = $db->getProductos();
  $userId="";
  $carritoId = "";
  if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
    $carritoId = $db->getCarrito($userId);
  }
  $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
  $queryProducto = "SELECT * FROM productos where id='$id';  ";
  $resProducto = mysqli_query($con, $queryProducto);
  $rowProducto = mysqli_fetch_assoc($resProducto);
  $cantidad = $db->obtenerCantidad($carritoId, $id);
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
                    <a href="historial_compras.php" class="main-header__link2"><i class="fas fa-user"></i></a>
                    <a href="cerrar_sesion.php"  class="main-header__link2"><i class="fas fa-sign-out-alt"></i></a>
                  <?php else:?>
                    <a href="iniciar_sesion.php" class="main-header__link2"><i class="fas fa-user"></i></a>
                  <?php endif;?>
                </div>
              </div>
  </header>
  <div class="card card-solid">
      <div class="card-body">
          <div class="row">
              <div class="col-12 col-sm-6">
                  <h3 class="d-inline-block d-sm-none"><?php echo $rowProducto['nombre'] ?></h3>
                  <div class="col-12">
                    <img src="<?php echo $rowProducto['imagen'] ?>" class="product-image" alt="Product Image">
                  </div>
                  <div class="col-12 product-image-thumbs">
                    <div class="product-image-thumb active"><img src="<?php echo $rowProducto['imagen'] ?>" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="<?php echo $rowProducto['imagen_secundaria'] ?>" alt="Product Image"></div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"><?php echo $rowProducto['nombre'] ?></h3>
                <p><?php echo $rowProducto['descripcion'] ?></p>
                <hr>
                <h4>Existencias: <?php echo $rowProducto['existencia'] ?></h4>
                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        $<?php echo $rowProducto['precio']  ?>
                    </h2>
                </div>
                <?php
                if(isset($_SESSION['email'])):?>
                  <div class="mt-4">
                    <?php if($rowProducto['existencia'] > 0 AND $rowProducto['existencia'] > $cantidad):?>
                    <button class="btn btn-primary btn-lg btn-flat" onclick="agregarACarrito(<?= $carritoId ?>,<?=$rowProducto['id']?>, 1);history.go(0)"></i>
                      <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Añadir al carro
                    <?php else: ?>
                      <i>Agotado</i>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
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
