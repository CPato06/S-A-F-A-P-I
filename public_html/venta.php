<?php
  require_once('db.php');
  include_once "admin/db2.php";
  $con = mysqli_connect($host, $user, $pass, $db);
  $db = new DB();
  session_start();

  $venta_id = $_GET['id'];
  $productos = $db->getProductosCarrito($venta_id);
  $total = 0;
  // $detalles = $db->getVenta($venta_id);
?>

<!DOCTYPE html>
<html lang="en">
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
    <h2>Gracias por tu compra!!!</h2>
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
      </p>
    </form>
<?php foreach ($productos as &$p):?>
  <?php
  $query = "SELECT cantidad FROM carrito_productos WHERE producto_id = $p[id] AND carrito_id = '$venta_id';";
  $res = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($res);
  $quantity = ($p['existencia'] - $row['cantidad']);
  $total = $total + ($p['precio'] * $row['cantidad']);
  $db->actualizarExistenica($p['id'], $quantity);
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
    <label ><?=$row['cantidad']?></label>
  </div>
  <div class="divCarrito" style="margin-top: 8%;">
    <label >$<?=$p['precio'] * $row['cantidad']?></label>
  </div>
</p>
</form>
          <?php endforeach; ?>
          <?php
          $query = "SELECT usuario_id FROM carrito WHERE id = '$venta_id';";
          $res = mysqli_query($con, $query);
          $row = mysqli_fetch_assoc($res);
          $query = "INSERT INTO ventas (fecha, usuario, ventaTotal, carritoID) VALUES (now(), $row[usuario_id], '$total', '$venta_id');";
          $res = mysqli_query($con, $query);
           ?>
           <form action="" class="" style="display: flex; justify-content: space-between | space-around; margin-top: 5%;">
             <p>
               <div class="divCarrito">
                 <label>Total: $<?=$total?></label>
               </div>
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
                 <label></label>
               </div>
               <div class="divCarrito">
                 <button class="btnCarrito"  ><a class="txtblanco" href="index.php"> Continuar comprando</a></button>
               </div>
             </p>
           </form>
       </div>
     </main>
  <?php include_once "footer.php"; ?>
</body>
</html>
