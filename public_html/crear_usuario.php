<?php
    include('db.php');
    $bd= new DB();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    $crear = $bd -> emailExiste($email);
    if ($crear){
        $user_id = $bd -> crearUsuario($username, $email, $password_hash);
        session_start();
        $_SESSION['id'] = $user_id;
        $_SESSION['email'] = $email;
        header("Location: index.php");
        die();
    }
    else{
        echo'<script type="text/javascript">
        alert("El correo ingresado ya ha sido utilizado");
        window.location.href="iniciar_sesion.php";
        </script>';
    }
?>
