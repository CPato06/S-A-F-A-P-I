<?php
    include('db.php');
    $bd= new DB();
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $ref = $_POST['referencias'];
    $bd -> registrarDireccion($username, $email, $ref, $id);
    echo'<script type="text/javascript">
    alert("Direccion registrada con éxito");
    window.location.href="historial_compras.php";
    </script>';
    die();
?>
