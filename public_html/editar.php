<?php
    include('db.php');
    $bd= new DB();
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    $bd -> emailVacio($email);
    $crear = $bd -> emailExiste($email);
    if ($crear){
        $user_id = $bd -> actualizarUsuario($id, $username, $email, $password_hash);
        echo'<script type="text/javascript">
        alert("Usuario actualizado con exito");
        window.location.href="editarUsuario.php";
        </script>';
        die();
    }
    else{
        echo'<script type="text/javascript">
        alert("El correo ingresado ya ha sido utilizado");
        window.location.href="editarUsuario.php";
        </script>';
    }
?>
