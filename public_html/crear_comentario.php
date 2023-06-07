<?php 
    include('db.php');
    $bd= new DB();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];
    $bd -> agregarComentario($username, $email, $comentario);
    header("Location: contact.php");
    die();


?>