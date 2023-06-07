<?php
require_once('db.php');
session_start();

$db = new DB();
$productos = $db->getProductosNuevos();
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
        <div class="container-slider">
          <div class="slider" id="slider">
            <div class="slider__section">
              <img src="img/slider/inicio.jpg" alt="" class="slider__img">
              <div class="slider__content">
                <h2 class="slider__title">Comics Funko Shop</h2>
                <p class="slider__txt">Los funko de tus personajes favoritos en un solo lugar</p>
              </div>
            </div>
            <div class="slider__section">
              <img src="img/slider/dc.jpg" alt="" class="slider__img">
              <div class="slider__content">
                <h2 class="slider__title">Funko Pop DC</h2>
                <p class="slider__txt">Los mejores funko de DC están justo aquí</p>
                <a href="dc_product.php" class="btn-shop">Comprar Ahora</a>
              </div>
            </div>
            <div class="slider__section">
              <img src="img/slider/marvel.jpg" alt="" class="slider__img">
              <div class="slider__content">
                <h2 class="slider__title">Funko Pop Marvel</h2>
                <p class="slider__txt">Los mejores funko de Marvel los encuentras aquí</p>
                <a href="marvel_product.php" class="btn-shop">Comprar Ahora</a>
              </div>
            </div>
            <div class="slider__section">
              <img src="img/slider/promocion.jpg" alt="" class="slider__img">
              <div class="slider__content">
                <h2 class="slider__title">Próximamente</h2>
                <p class="slider__txt">Disfruta de cashback del 21 al 24 de noviembre</p>
              </div>
            </div>
          </div>
          <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
          <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
        </div>
        <main class="main">
          <div class="container">
            <h2 class="main-title">Lo + Nuevo</h2>
            <section class="container-products">
            <?php foreach ($productos as &$p): ?>
              <div class="product">
                <img src="<?= $p['imagen']?>" alt="" class="product__img">
                <div class="product__description">
                  <h3 class="product__title"><?= $p['nombre']?></h3>
                  <span class="product__price">$<?= $p['precio']?></span>
                </div>
                <?php if(isset($_SESSION['id'])):?>
                  <a class="quitar_formato" href="pp.php?id=<?=$p['id']?>";><i class="product__icon fas fa-cart-plus"></i></a>
                <?php endif;?>
              </div>
            <?php endforeach; ?>
        </main>
    <?php include_once "footer.php"; ?>
  </body>
  <script src="js/slider.js"></script>
</html>
