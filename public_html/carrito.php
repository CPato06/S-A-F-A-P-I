<?php
  require_once('db.php');
  include_once "admin/db2.php";
  $con = mysqli_connect($host, $user, $pass, $db);
  $db = new DB();
  session_start();

  $usuario_id = $_SESSION['id'];
  $carrito_id = $db->getCarrito($usuario_id);
  $productos = $db->getProductosCarrito($carrito_id);
  $total = 0;

  $hayExistencia = 0;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Funko Shop</title>
    <meta name="twitter:" content="">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="img/Decoracion/Logo.png" />
  </head>
  <body>
  <?php include_once "header.php"; ?>
    <main class="main">
      <div class="container">
        <h2>Carrito</h2>
        <form action="" class="" style="display: flex; justify-content: space-between | space-around;">
          <p>
            <div class="divCarrito">
              <label >Imagen</label>
            </div>
            <div class="divCarrito">
              <label >Producto</label>
            </div>
            <div class="divCarrito">
              <label >Precio</label>
            </div>
            <div class="divCarrito">
              <label >Cantidad</label>
            </div>
            <div class="divCarrito">
              <label >Total</label>
            </div>
            <div class="divCarrito">
              <label >Eliminar</label>
            </div>
          </p>
        </form>
          <?php foreach ($productos as &$p):?>
            <?php
              $cantidad = $db->obtenerCantidad($carrito_id, $p['id'])
              ?>
            <form action="" class="" style="display: flex; justify-content: space-between | space-around; margin-top: 2%;">
            <p>
            <div class="divCarrito">
              <img style="width: 60%; height:  120px; display: inline-block;" src="<?=$p['imagen']?>" >
            </div>
            <div class="divCarrito" style="margin-top: 8%;">
              <label ><?=$p['nombre']?></label>
            </div>
            <div class="divCarrito" style="margin-top: 8%;">
              <label>$<?=$p['precio']?></label>
            </div>
            <div class="divCarrito" style="margin-top: 8%;">
              <?php if ($cantidad >= 2): ?>
              <button class="" onclick="botonMenos(<?=$carrito_id ?>, <?=$p['id'] ?>);history.go(0);">-</button>
            <?php else: ?>
              <button class="" disabled>-</button>
              <?php endif;?>
              <?php if ($p['existencia'] <= 0):
                $hayExistencia = 1;
                ?>
              <label>Producto Agotado</label>
              <?php else: ?>
              <label ><?=$cantidad?></label>
              <?php endif; ?>
              <?php if ($cantidad < $p['existencia']): ?>
              <button class="" onclick="botonMas(<?= $carrito_id ?>, <?=$p['id']?>);history.go(0);">+</button>
              <?php else: ?>
              <button class="" disabled>+</button>
              <?php endif;?>
            </div>
            <div class="divCarrito" style="margin-top: 8%;">
              <label >$<?=$cantidad * $p['precio']?></label>
            </div>
            <div class="divCarrito" style="margin-top: 8%;">
              <button class="btnCarrito" onclick="eliminarProductoCarrito(<?= $carrito_id ?>, <?=$p['id']?>);">Quitar del carrito</button>
            </div>
          </p>
          </form>
          <?php $total = $total + ($cantidad * $p['precio']) ?>
          <?php endforeach; ?>
          <form action="" class="" style="display: flex; justify-content: space-between | space-around; margin-top: 5%;">
            <p>
              <div class="divCarrito">
                <label></label>
              </div>
              <div class="divCarrito">
                <label></label>
              </div>
              <div class="divCarrito">
                <label></label>
              </div>
              <div class="divCarrito">
                <label>Costo final:</label>
              </div>
              <div class="divCarrito">
                <label>$<?=$total?></label>
              </div>
              <div class="divCarrito">
                <?php if ($hayExistencia == 0): ?>
                <button class="btnCarrito" ><a href="pago.php" class="txtblanco">Ir a envío</a></button>
              <?php else: ?>
              <?php endif; ?>
              </div>
            </p>
          </form>
      </div>
    </main>
    <?php include_once "footer.php"; ?>
  </body>
  <script src="js/carrito4.js"></script>
  <script src="js/carrito2.js"></script>
  <script src="js/slider.js"></script>
  <script src="js/carrito.js"></script>
</html>
