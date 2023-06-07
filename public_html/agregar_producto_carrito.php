<?php
    include('db.php');
    $bd = new DB();
    $p = $_GET['producto'];
    $c = $_GET['carrito'];
    $q = 1;

    $bd -> agregarProductoCarrito($c, $p, $q);
?>
