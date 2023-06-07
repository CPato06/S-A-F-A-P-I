<?php 
    include('db.php');
    $bd = new DB();
    $p = $_GET['producto'];
    $c = $_GET['carrito'];

    $bd -> eliminarProductoCarrito($c, $p);
?>