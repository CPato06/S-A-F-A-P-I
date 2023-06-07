<?php
    include('db.php');
    $bd= new DB();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    $ingresar = $bd -> ingresarUsuario($email, $password_hash);
    if ($ingresar){
        $id = $bd -> obtenerID($email, $password_hash);
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        header("Location: index.php");
        die();
    }
?>
