<?php
  require_once('db.php');
  session_start();
  $db = new DB();

  $marca = "marvel";
  $productos = $db->getProductosMarca($marca);
  $userId="";
  $carritoId = "";
  if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
    $carritoId = $db->getCarrito($userId);
  }
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
            <h2 class="main-title">Marvel</h2>
            <section class="container-products">
            <?php foreach ($productos as &$p): ?>
              <div class="
                <?php if($p['tipo']=='nuevo'): ?>
                  product
                <?php elseif($p['tipo']=='exclusivo'): ?>
                  exclusiveproduct
                <?php elseif($p['tipo']=='limitado'): ?>
                  limitedproduct
                <?php else: ?>
                  oldproduct
                <?php endif; ?>
              ">
                <img src="<?=$p['imagen']?>" onmouseover="this.src='<?=$p['imagen_secundaria']?>';"
                    onmouseout="this.src='<?=$p['imagen']?>';" alt="" class="product__img">
                  <div class="product__description">
                    <h3 class="product__title"><?=$p['nombre']?></h3>
                    <span class="product__price">$<?=$p['precio']?></span>
                  </div>
                  <?php if(isset($_SESSION['id'])):?>
                    <a class="quitar_formato" href="pp.php?id=<?=$p['id']?>";><i class="product__icon fas fa-cart-plus"></i></a>
                  <?php endif;?>
              </div>
              <?php endforeach; ?>

            </section>
          </div>
        </main>
    <?php include_once "footer.php"; ?>
  </body>
  <script src="js/slider.js"></script>
  <script src="js/carrito.js"></script>
</html>
