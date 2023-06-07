<?php
include('db.php');
$bd = new DB();
$p = $_GET['carrito'];
$bd -> eliminarUsuario($p);
@session_start();
session_destroy();
header("Location: index.php");
?>
