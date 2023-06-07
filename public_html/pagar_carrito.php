<?php
    include('db.php');
    $bd = new DB();
    $c = $_GET['carrito'];

    $bd -> pagarCarrito($c);
    header("Location: venta.php?id=$c");
?>
