<?php
        if ( isset($_REQUEST['login'])) {
          session_start();
          $email = $_REQUEST['email']??'';
          $password = $_REQUEST['password']??'';
          $password_hash = md5($password);
          include_once "../db.php";
          $bd = new DB();
          $ingresar = $bd -> ingresarAdmin($email, $password_hash);
          if ($ingresar){
              $id = $bd -> obtenerIdAdmin($email, $password_hash);
              $nombre = $bd -> obtenerNombreAdmin($email, $password_hash);

              $_SESSION['id'] = $id;
              $_SESSION['email'] = $email;
              $_SESSION['nombre'] = $nombre;
              header("Location: dashboard.php");
              die();
          }
        }
      ?>